<?php
class user{
	public $core;
	public function __construct($core){
		$this->core=$core;
	}
	public function destroy_auth(){ //деавторизует пользователя 
		setcookie("user_data", NULL, time()-10000);  //удаляет куки	
		if(isset($_SESSION["user_data"][0])&&!empty($_SESSION["user_data"][0])){
			$id=$_SESSION['user_data'][0];
			$query="UPDATE `users` SET `cookie_token`= NULL WHERE `id`= '$id'";
			$this->core->connect_SQL($query);
		}
		unset ($_SESSION["user_data"]);  //удаляет данные сессии
		session_destroy();
		
	}
	public function auth($login, $password, $remember_my){//авторизует пользователя
		if ($login==NULL&&$password==NULL){
			goto jump;
		}
		$query="SELECT `id`, `login`, `password`, `name` FROM `users` WHERE `login`='$login'";
		$a=$this->core->connect_SQL($query);
		if($a){
			$user=mysqli_fetch_assoc($a);
			if($user["password"]==$password){
				$_SESSION["user_data"]=array($user["id"], $user["login"]);
				if($remember_my=="on"){
					$cookie_token=md5($login.$user["id"]);
					$query="UPDATE `users` SET `cookie_token`='$cookie_token' WHERE `login`='$login' ";
					$a=$this->core->connect_SQL($query);
					
					if($a){
						setcookie("user_data", $cookie_token, time()+3600);
					}
					
				}
				return array(1, "<p>Успешная авторизация</p>") ;
			}
		}
		jump:
		return  array(0, "<p>Авторизация не удалась, введите снова логин и пароль</p>");
	}	
	public function reg( $login, $password, $name, $email){//регистрация пользователя
		
		$query="INSERT INTO `users`(`name`, `login`, `password`,`email`) VALUES ('$name', '$login', '$password', '$email')"; 
		if($this->core->connect_SQL($query)){
			return array(2, "<p>Регистрация успешно проведена</p>");
		} else return array(2, "<p>Регистрация не прошла</p>", );
		
		
	}	
	public function upload($file){ //загрузка файла
		if($file["name"]==NULL){
			return array(3, "<p>Файл не загружен</p>");
		}
		if ($file["size"]>500000000){
			trigger_error("Превышен разрешенный размер файла в байт. "  , E_USER_NOTICE);
		}
		else {
			move_uploaded_file($file["tmp_name"], dirname(__FILE__)."/tmp_files/".$file["name"]);
			}
		
		print "<pre>";
		if($file["error"]!="0"){ 
			print "Ошибка при отправке файла на сервер. Код ошибки ". $file["error"];
		}
		print "</pre>";	
		if( file_exists (dirname(__FILE__)."/tmp_files/".$file["name"])){
			return array(3, "<p>Файл загружен</p>");
		}		
	}

}

?>