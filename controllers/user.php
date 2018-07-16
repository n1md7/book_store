
<?php
class user extends Controller{
	/*
		private function check authentication
	*/
	private function isloggedin(){
		return !isset($_SESSION["is_loggedin"])?false:true;
	}

	private function isAdmin(){
		if (isset($_SESSION["is_loggedin"]) &&
			(int) $_SESSION["user_data"]['is_admin'] == 1){
			return true;
		}
		return false;
	}

	/* 
		!public function for userinfo
	*/
	protected function signup(){
		$viewmodel = new userModel();
		$this->returnView($viewmodel->signup(), true);
	}

	protected function signin(){
		if($this->isloggedin()){
			header('location: '.MAIN_PAGE);
		}

		$viewmodel = new userModel();
		$this->returnView($viewmodel->signin(), true);
	}

	protected function profile(){
		if(!$this->isloggedin()){
			header('location: '.USER_SIGN_IN);
		}

		$viewmodel = new userModel();
		$this->returnView($viewmodel->profile(), true);
	}

	protected function categories(){
		if(!$this->isloggedin() || !$this->isAdmin()){
			header('location: '.USER_SIGN_IN);
		}

		$viewmodel = new userModel();
		$this->returnView($viewmodel->categories(), true);
	}

	protected function search(){
		if(!$this->isloggedin() || !$this->isAdmin()){
			header('location: '.USER_SIGN_IN);
		}

		$viewmodel = new userModel();
		$this->returnView($viewmodel->search(), true);
	}

	protected function upload(){
		if(!$this->isloggedin() || !$this->isAdmin()){
			header('location: '.USER_SIGN_IN);
		}

		$viewmodel = new userModel();
		$this->returnView($viewmodel->upload(), true);
	}

	protected function cart(){
		if(!$this->isloggedin()){
			header('location: '.USER_SIGN_IN);
		}

		$viewmodel = new userModel();
		$this->returnView($viewmodel->cart(), true);
	}

	/*only for xmlhttp requests*/
	protected function ajax(){
		/*if(!$this->isloggedin()){
			return;
		}*/

		$viewmodel = new userModel();
		$this->returnView($viewmodel->ajax(), false);
	}

	protected function addBalance(){
		if(!$this->isloggedin()){
			return;
		}

		$viewmodel = new userModel();
		$this->returnView($viewmodel->addBalance(), true);
	}

	/* 
		!public function for signout
	*/
	protected function signout(){
		if(isset($_SESSION['is_loggedin'])):
			unset($_SESSION['is_loggedin']);
			unset($_SESSION['user_data']);
			session_destroy();
		endif;
		/*
			Redirect
		*/
			header('Location: '.USER_SIGN_IN);

		return;
	}
}
