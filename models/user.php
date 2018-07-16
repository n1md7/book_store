<?php
class userModel extends Model{
	
	/*
		public method for user/admin login
	
	*/
	public function signin(){
		/* sanitization of POST input */
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		
		/* Checking whether parameters are passed*/
		if(isset($post['signin'])):

			if(	!isset($post['username']) || !isset($post['password']) ):
				Messages::setMsg('Empty fields detected!', 'error');
				return;
			endif;
		
		else:
			return;
		endif;


		/* hash password */
		$password = Generate::sha1($post['password']);

		$this->query('SELECT * FROM users WHERE username = :user AND password = :passwd');
		$this->bind(':user', $post['username']);
		$this->bind(':passwd', $password);

			if( $this->rowCount() > 0 ):
				/* if there is at least one row matching those password and username*/
				/* successfull login*/
				$row = $this->single();
				$_SESSION['is_loggedin'] = true;
				$_SESSION['user_data'] = array(
					"user_id"     => $row['user_id'],
					"email"	      => $row['email'],
					"username"    => $row['username'],
					"is_admin"    => $row['is_admin']
				);

				/* redirect to main page*/
				header('Location: '.MAIN_PAGE);
				return;
			else:
				Messages::setMsg('Wrong credentials!', 'error');
			endif;

		return;
	}


	/*
		public method for register new user
	*/
	public function signup(){
		/* sanitization of POST input */
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		/* Checking whether parameters are passed*/
		if(isset($post['signup'])):

			if(
					!isset($post['email'])      ||
					!isset($post['username'])   || 
					!isset($post['first_name']) || 
					!isset($post['last_name'])  || 
					!isset($post['birth_date']) || 
					!isset($post['password1'])  ||
					!isset($post['password2'])
				):
					Messages::setMsg('Empty fields detected!', 'error');
					$captcha = new Captcha();
					$captcha->genereate();
					$_SESSION['captcha']['key'] = $captcha->getQuestion();
					$_SESSION['captcha']['value'] = $captcha->getAnswer();

					return $captcha->getQuestion();
			endif;

		else:
			$captcha = new Captcha();
			$captcha->genereate();
			$_SESSION['captcha']['key'] = $captcha->getQuestion();
			$_SESSION['captcha']['value'] = $captcha->getAnswer();

			return $captcha->getQuestion();
		endif;

		
		/* Checking whether parameters are empty*/
		if(
			empty($post['username'])  || 
			empty($post['email'])     ||
			empty($post['first_name'])||
			empty($post['last_name']) ||
			empty($post['birth_date'])||
			empty($post['password1']) ||
			empty($post['password2'])
			):
				Messages::setMsg('Empty fields detected!', 'error');
				$captcha = new Captcha();
				$captcha->genereate();
				$_SESSION['captcha']['key'] = $captcha->getQuestion();
				$_SESSION['captcha']['value'] = $captcha->getAnswer();

				return $captcha->getQuestion();
		endif;

		/* Checking whether passwords match*/
		if(	$post['password2'] != $post['password1'] ):
				Messages::setMsg('Passwords didn\'t match!', 'error');
				$captcha = new Captcha();
				$captcha->genereate();
				$_SESSION['captcha']['key'] = $captcha->getQuestion();
				$_SESSION['captcha']['value'] = $captcha->getAnswer();

				return $captcha->getQuestion();
		endif;

		/* check whether already registered */
		$this->query('SELECT username FROM users WHERE username = :user');
		$this->bind(':user', $post['username']);

		/* same username exists*/
		if( $this->rowCount() > 0 ):
			Messages::setMsg("Username {$post['username']} already taken!", 'error');
			$captcha = new Captcha();
			$captcha->genereate();
			$_SESSION['captcha']['key'] = $captcha->getQuestion();
			$_SESSION['captcha']['value'] = $captcha->getAnswer();

			return $captcha->getQuestion();
		endif;

		if(
			!isset($post['captcha']) ||
			!isset($_SESSION['captcha']) || 
			$_SESSION['captcha']['value'] != $post['captcha'] 
			):
			Messages::setMsg("Invalid CAPTCHA!", 'error');
			$captcha = new Captcha();
			$captcha->genereate();
			$_SESSION['captcha']['key'] = $captcha->getQuestion();
			$_SESSION['captcha']['value'] = $captcha->getAnswer();

			return $captcha->getQuestion();
		endif;

		/* hash password */
		$password = Generate::sha1($post['password1']);

		/* save user data in DB*/
		$this->query('
				INSERT INTO users 
				(username, password, first_name, last_name, birth_date, balance, email)
				VALUES (:user, :passwd, :first, :last, :bdate, :balance, :email)
			');

		$this->bind(':user',   $post['username']);
		$this->bind(':email',  $post['email']);
		$this->bind(':first',  $post['first_name']);
		$this->bind(':last',   $post['last_name']);
		$this->bind(':bdate',  $post['birth_date']);
		$this->bind(':balance',  0.00);
		$this->bind(':passwd', $password);

		$this->execute();
		/* check whether record really created */
			if( $this->lastInsertId() ):
				Messages::setMsg("User <b>{$post['username']}</b> has been successfully registered!", '');
			else:
				Messages::setMsg("Something went wrong!", 'error');
			endif;

		$captcha = new Captcha();
		$captcha->genereate();
		$_SESSION['captcha']['key'] = $captcha->getQuestion();
		$_SESSION['captcha']['value'] = $captcha->getAnswer();

		return $captcha->getQuestion();

	}

	/* public function for user/admin profile*/
	public function profile(){
		$this->query("
				SELECT user_id, first_name, last_name, email, birth_date
				FROM users WHERE user_id = :user_id
			");
		$this->bind(':user_id', $_SESSION['user_data']['user_id']);
		$user = $this->single();
		


		return array(
				'user' => $user
			);

	}

	/* public function for user/admin profile*/
	public function ajax(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		
		header('Content-Type: application/json');



	/* get  all categories*/
		if( 
			isset($post['gimme_all_cats'])
			):

				$this->query("SELECT * FROM categories");
				
				echo json_encode(array('categories' => $this->resultSet()));
			return;
		endif;


		/* get  all sub cats by  categorie id*/
		if( 
			isset($post['gimme_all_sub_cats']) &&
			isset($post['sub_cat_id']) &&
			!empty($post['sub_cat_id'])
			):

				$this->query("SELECT * FROM sub_categories WHERE cat_id = :cat_id");
				$this->bind(':cat_id', $post['sub_cat_id']);
				
				echo json_encode(array('sub_categories' => $this->resultSet()));
			return;
		endif;














		if( !isset($_SESSION["is_loggedin"]) ){
			echo json_encode(array('error' => 'unauthorized'));

			return;
		}

		/*after that unauthorized user cannt send anythign*/

		if( 
			isset($post['Add_category']) &&
			isset($post['cat_name']) &&
			!empty($post['cat_name']) 
			):


				$this->query("SELECT name from categories WHERE name = :name");
				$this->bind(':name', $post['cat_name']);
				$this->execute();
				if( $this->rowCount() > 0){
					echo json_encode(array("id" => 0, 'error' => 'Already In DB!'));
					return;
				}

				$this->query("INSERT INTO categories (name) VALUES (:cat_name)");
				$this->bind(':cat_name', $post['cat_name']);
				$this->execute();


				if( $this->lastInsertId() > 0){
					echo json_encode(array("id" => $this->lastInsertId()));
				}else{
					echo json_encode(array("id" => 0));
				}
			return;
		endif;

		if( 
			isset($post['Delete_category']) &&
			isset($post['cat_id']) &&
			!empty($post['cat_id']) 
			):

				$this->query("DELETE FROM categories WHERE cat_id = :cat_id");
				$this->bind(':cat_id', $post['cat_id']);
				$this->execute();
				/*delete all from sub categories*/
				$this->query("DELETE FROM sub_categories WHERE cat_id = :cat_id");
				$this->bind(':cat_id', $post['cat_id']);
				$this->execute();

				echo json_encode(array("deleted" => true));
			return;
		endif;


		/*********sub gategory part*************/
		if( 
			isset($post['Add_sub_category']) &&
			isset($post['sub_cat_name']) && !empty($post['sub_cat_name']) && 
			isset($post['cat_id']) && !empty($post['cat_id']) 
			):


				$this->query("SELECT name from sub_categories WHERE name = :name AND cat_id = :cat_id");
				$this->bind(':name', $post['sub_cat_name']);
				$this->bind(':cat_id', $post['cat_id']);
				$this->execute();
				if( $this->rowCount() > 0){
					echo json_encode(array('error' => $post['sub_cat_name'].' Already In DB!'));
					return;
				}

				$this->query("INSERT INTO sub_categories (name, cat_id) VALUES (:name, :cat_id)");
				$this->bind(':name', $post['sub_cat_name']);
				$this->bind(':cat_id', $post['cat_id']);
				$this->execute();


				if( $this->lastInsertId() > 0){
					echo json_encode(array(
							"sub_cat_id" => $this->lastInsertId(),
							"sub_name" => $post['sub_cat_name']
						));
				}else{
					echo json_encode(array("error" => 'Something went wrong!'));
				}
			return;
		endif;


		if( 
			isset($post['Delete_sub_category']) &&
			isset($post['sub_cat_id']) &&
			!empty($post['sub_cat_id']) 
			):

				$this->query("DELETE FROM sub_categories WHERE sub_cat_id = :sub_cat_id");
				$this->bind(':sub_cat_id', $post['sub_cat_id']);
				$this->execute();
				/*delete all from sub categories*/
				$this->query("DELETE FROM sub_categories WHERE sub_cat_id = :sub_cat_id");
				$this->bind(':sub_cat_id', $post['sub_cat_id']);
				$this->execute();

				echo json_encode(array("deleted" => true));
			return;
		endif;



		
		if( 
			isset($post['search_user']) &&
			isset($post['username'])&&
			!empty($post['username']) 
			):
				$where = ''; $username = $post['username'];
				switch (true) {
					case strpos($username, ':active') !== false:
						$where = 'active = 1';
						$username = str_replace(':active', '', $username);
						break;
					case strpos($username, ':disabled') !== false:
						$where = 'active = 0';
						$username = str_replace(':disabled', '', $username);
						break;
					case strpos($username, ':isadmin') !== false:
						$where = 'is_admin = 1';
						$username = str_replace(':isadmin', '', $username);
						break;
					case strpos($username, ':user') !== false:
						$where = 'is_admin = 0';
						$username = str_replace(':user', '', $username);
						break;
					default:
						$where = '1 = 1';
						break;
				}

				/* remove whitespaces */
				$username = preg_replace('/\s+/', '', $username);
				$this->query("
						SELECT user_id, username, first_name, last_name, email, is_admin, balance, active
						FROM users 
						WHERE (username LIKE :username 
						OR first_name LIKE :username
						OR last_name LIKE :username
						OR email LIKE :username)
						AND $where
					");
				$this->bind(':username', "%".$username."%");
				$users=$this->resultSet();

				echo json_encode(array(
						"users" => $users,
						"keyword" => $username
					));
			return;
		endif;


		if( 
			isset($post['toogle_admin']) &&
			isset($post['user_id'])&&
			!empty($post['user_id']) 
			):

				$this->query("UPDATE users SET is_admin = IF(is_admin = 1,0,1) WHERE user_id = :id");
				$this->bind(':id', $post['user_id']);
				$this->execute();
				echo json_encode(array("done" => true));
			return;
		endif;



		if( 
			isset($post['toogle_admin_activate']) &&
			isset($post['user_id'])&&
			!empty($post['user_id']) 
			):

				$this->query("UPDATE users SET active = IF(active = 1,0,1) WHERE user_id = :id");
				$this->bind(':id', $post['user_id']);
				$this->execute();
				echo json_encode(array("done" => true));
			return;
		endif;



		if(
			isset($_FILES['file']) && 
			isset($post['book_author']) &&
			isset($post['book_cover']) &&
			isset($post['book_description']) &&
			isset($post['book_title']) &&
			isset($post['book_price']) &&
			isset($post['book_category']) &&
			isset($post['book_sub_cat']) &&
			isset($post['upload_file'])){

			$errors     = array();
			$file_name  = $_FILES['file']['name'];
			$file_size  = $_FILES['file']['size'];
			$file_tmp   = $_FILES['file']['tmp_name'];
			$file_type  = $_FILES['file']['type'];
			$tmp = explode('.',$_FILES['file']['name']);
			$file_ext   = strtolower(end($tmp));
			$expensions = array("pdf");

			if(in_array($file_ext, $expensions) === false){
				$errors[] = "extension not allowed, please choose a PDF file.";
			}
			
			if($file_size > 500 * 2097152){
				$errors[]='File size must be under 500 MB';
			}

			if(empty($errors)==true){
				$new_file_name = Generate::csrf().rand(0,99999999).'.'.$file_ext;
				$success = move_uploaded_file($file_tmp,"uploads/".$new_file_name);
				if($success){
					$this->query("
							INSERT INTO `books`(`title`, `author`, `cover`, `file_name`, `description`, `price`, `cat_id`, `sub_cat_id`) 
							VALUES (:title, :author, :cover, :file_name, :description, :price, :cat_id, :sub_cat_id)
						");
					$this->bind(':title', $post['book_title']);
					$this->bind(':author', $post['book_author']);
					$this->bind(':cover', $post['book_cover']);
					$this->bind(':price', $post['book_price']);
					$this->bind(':cat_id', $post['book_category']);
					$this->bind(':sub_cat_id', $post['book_sub_cat']);
					$this->bind(':file_name', $new_file_name);
					$this->bind(':description', $post['book_description']);
					$this->execute();
					if( $this->lastInsertId() > 0){
						echo json_encode(array("success" => true, 'post' => $_POST));
					}else{
						echo json_encode(array("error" => true));
					}
				}else{
					echo json_encode(array("error" => true));
				}
			}else{
				echo json_encode(array("error" => $errors));
			}

			return;
		}



		if( 
			isset($post['add_item_to_cart']) &&
			isset($post['book_id'])&&!empty($post['book_id']) 
			):

				$this->query("INSERT INTO cart (user_id, book_id, paid) VALUES (:user_id, :book_id, 0)");
				$this->bind(':user_id', $_SESSION['user_data']['user_id']);
				$this->bind(':book_id', $post['book_id']);
				$this->execute();
				if($this->lastInsertId() > 0){
					echo json_encode(array("success" => true));
				}else{
					echo json_encode(array("error" => 'saving problem!'));
				}
			return;
		endif;

	
		/* get user money amount */
		if( 
			isset($post['gmmemoney'])
			):

				$this->query("SELECT balance from users WHERE user_id = :user_id");
				$this->bind(':user_id', $_SESSION['user_data']['user_id']);
				$balance = $this->single();

				$this->query("SELECT COUNT(*) as items FROM cart WHERE user_id = :user_id AND paid = 0");
				$this->bind(':user_id', $_SESSION['user_data']['user_id']);
				
				echo json_encode(array(
						"balance" => $balance,
						"items" => $this->single()
					));
			return;
		endif;

		/* remove item from cart*/
		if( 
			isset($post['remove_this_item']) &&
			isset($post['cart_id']) && !empty($post['cart_id']) 
			):

				$this->query("DELETE FROM cart WHERE cart_id = :cart_id AND user_id = :user_id");
				$this->bind(':user_id', $_SESSION['user_data']['user_id']);
				$this->bind(':cart_id', $post['cart_id']);
				$this->execute();
				echo json_encode(array('deleted' => 'true'));
			return;
		endif;







		/* all the function goes above*/
		/*************************************************************************/
		/* if there is no proper data passed it comes to here and returns error json necode value*/		
		echo json_encode(array("error" => 'Empty value!'));
		return;

	}

	/*public function categories*/
	public function categories(){
		$this->query("SELECT * FROM categories");
		$categories = $this->resultSet();

		$this->query("
				SELECT sub_categories.name as sub_name, sub_categories.sub_cat_id, categories.name, categories.cat_id FROM sub_categories 
				RIGHT JOIN categories
				ON sub_categories.cat_id = categories.cat_id
			");
		$sub_categories = $this->resultSet();
		

		return array(
				'categories' => $categories,
				'sub_categories' => $sub_categories
			);
	}


	/* 
		public function for suer search adn other actions
		like activeate deactivare promote as admin or demote as basic user
	*/
	public function search(){
		$this->query("
				SELECT user_id, username, first_name, last_name, email, is_admin, balance, active
				FROM users WHERE 1 ORDER BY 1 DESC LIMIT 10
			");
		$users = $this->resultSet();

		return array(
				'users' => $users
			);
	}


	/* public function for uploading books*/
	public function upload(){
		return;
	}

	/* public function for cart items*/
	public function cart(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post['checkout'])){
			//aq checkouti unda vqnaa

			$this->query("SELECT SUM(books.price) as sum
						FROM books
						JOIN cart
						ON cart.book_id = books.book_id
						WHERE cart.user_id = :usr AND cart.paid = 0
						ORDER BY books.book_id
					");
			$this->bind(':usr', $_SESSION['user_data']['user_id']);
			$sum = $this->single();
			$this->query("SELECT balance FROM users WHERE user_id = :usr");
			$this->bind(':usr', $_SESSION['user_data']['user_id']);
			$user_money = $this->single();

			// user buys a book otherwise no enough money
			if( $sum['sum'] < $user_money['balance'] ){
				// marke items as bought
				$this->query("UPDATE cart SET paid = 1 WHERE cart.user_id = :usr");
				$this->bind(':usr', $_SESSION['user_data']['user_id']);
				$this->execute();
				
				// substract ussers money cost of books
				$this->query("UPDATE users SET balance = :balance WHERE users.user_id = :usr");
				$this->bind(':balance', (float)$user_money['balance'] - (float)$sum['sum'] );
				$this->bind(':usr', $_SESSION['user_data']['user_id']);
				$this->execute();
				Messages::setMsg('You have successfully bought It!', 'success');
			}else{
				Messages::setMsg('You don\'t have enough money!', 'error');
			}


		}
		$this->query("
				SELECT cart.cart_id, cart.book_id, cart.paid, books.title, cart.date_modified, 
				books.author, books.description, books.cover, books.file_name, books.price 
				FROM cart
				INNER JOIN books
				ON books.book_id = cart.book_id
				WHERE user_id = :myid ORDER BY 1 DESC
			");
		$this->bind(':myid', $_SESSION['user_data']['user_id']);
		
		$items = $this->resultSet();

		return array(
				'items' => $items,
				// 'history' => $this->resultSet()
			);
	}



	public function addBalance() {
		/* sanitization of POST input */
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if(isset($post['addbalance'])){
			$this->query("SELECT balance FROM users WHERE user_id = :user_id");
			$this->bind(':user_id', $_SESSION['user_data']['user_id']);
			$balance = $this->single();

			$this->query("UPDATE users SET balance = :balance WHERE user_id = :user_id");
			$this->bind(':balance', (int)$post['addbalance'] + $balance['balance']);
			$this->bind(':user_id', $_SESSION['user_data']['user_id']);
			$this->execute();
			Messages::setMsg('Balance added successfully!', 'success');
		}

		return;
	}

}
