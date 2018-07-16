<?php

	define('DEBUG', true);

	define("DB_HOST", "localhost");
	define("DB_USER", "root");  
	define("DB_PASS", "password"); 
	define("DB_NAME", "webstore");

	define("ROOT_PATH", "/".basename(dirname(__FILE__))."/");

	define("ROOT_URL", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].ROOT_PATH);

	define("MAIN_PAGE", ROOT_URL);
	define("USER_SIGN_IN", ROOT_URL."user/signin");
	define("USER_SIGN_UP", ROOT_URL."user/signup");
	define("USER_SIGN_OUT", ROOT_URL."user/signout");
	define("USER_PROFILE", ROOT_URL."user/profile");
	define("USER_CATEGORIES", ROOT_URL."user/categories");
	define("USER_SEARCH", ROOT_URL."user/search");
	define("USER_UPLOAD", ROOT_URL."user/upload");
	define("USER_CART", ROOT_URL."user/cart");
	define("AJAX", ROOT_URL."user/ajax");
	define("ADDBALANCE", ROOT_URL."user/addBalance");
 