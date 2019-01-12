<?php
	/**
	* 
	*/
	class Session
	{
		
		public static function init(){
			session_start();
		}

		public static function set($key, $value){
			$_SESSION[$key]=$value;
		}

		public static function get($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key];
			}
			else{
				return false;
			}
		}

		public static function checksession(){
			self::init();
			if(Session::get('login')==false){
				self::destroy();
			}
		}

		public static function checklogin(){
			self::init();
			if(Session::get('login')==true){
				header("Location:index.php");
			}
		}

		public static function destroy(){
			session_destroy();
			header("Location:login.php");
		}
	}

?>