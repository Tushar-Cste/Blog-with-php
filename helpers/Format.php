<?php
	/**
	* 
	*/
	class Format 
	{
		
		public function dateformat($date){
			return date('F j, Y, g:i a', strtotime($date));
		}

		public function shorten($str, $limit= 200){
			$text = substr($str,0,$limit);
			return substr($text,0,strrpos($text,' '));
		}

		public function validation($str){
			$str = trim($str);
			$str = stripcslashes($str);
			$str = htmlspecialchars($str);
			return $str;
		}
		public function title(){
			$path = $_SERVER['SCRIPT_FILENAME'];
			$title = basename($path,'.php');
			if($title == 'index'){
				$title = 'Home';
			}
			return $title = ucwords($title);
		}
	}
?>