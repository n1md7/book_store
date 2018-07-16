<?php
class HomeModel extends Model{
	public function Index(){

		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$search = null;

		if( 
			isset($post['search']) && isset($post['cat']) &&
			isset($post['sub_cat']) && isset($post['text']) )
		{
			/* join aris dasamatebeli cat filtristvis*/
			$this->query("
				SELECT book_id, title, description, author, cover, price 
				FROM books WHERE title like :search OR author like :search1 LIMIT 30
			");
			$this->bind(':search', '%'.$post['text'].'%');
			$this->bind(':search1', '%'.$post['text'].'%');
			$search = $this->resultSet();
		}

		$this->query("
				SELECT book_id, title, description, author, cover, price FROM books
				ORDER BY sold_count, 1 DESC LIMIT 3
			");
		/* featured books last 4 row*/
		$books = $this->resultSet();
		$this->query("
				SELECT book_id, title, description, author, cover, price FROM books
				ORDER BY 1 ASC LIMIT 3
			");
		$lastAdded = $this->resultSet();
		return array(
				'search' => $search,
				'books' => $books,
				'lastAdded' => $lastAdded,
			);
	}
	
}