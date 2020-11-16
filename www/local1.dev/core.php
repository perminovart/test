<?php
class core{
	private $event;
	private $operation;
	public $operationresult;
	public function __construct(){
		require_once (ROOT_PATH."/user.php");
		$event=isset($_GET["event"])&&!empty($_GET["event"])
			? $_GET["event"]
			: NULL;
		
		$operation=isset($_REQUEST["operation"])&&!empty($_REQUEST["operation"])
			? $_REQUEST["operation"]
			: NULL;	

		$this->user=new user($this);
		if($event=="exit"){
			$this->user->destroy_auth();
		}
		$this->event=$event;
		$this->operation=$operation;
		$this->operationresult=$this->getOperationResult();
		

	}
	public function getOperationResult(){ //возвращает результат выполненной операции
		$result=array(-1, "Введите логин и пароль!");
		switch ($this->operation){
			case ("auth"): {
				$login = isset($_POST["login"])&&!empty($_POST["login"])
					? $_POST["login"]
					: NULL;
				$password = isset($_POST["password"])&&!empty($_POST["password"])
					? $_POST["password"]
					: NULL;
				$remember_my = isset($_POST["remember_my"])&&!empty($_POST["remember_my"])
					? $_POST["remember_my"]
					: NULL;
				$result=$this->user->auth($login, $password, $remember_my);
			} break;
			case("reg"):{
				$login = isset($_POST["login"])&&!empty($_POST["login"])
					? $_POST["login"]
					: NULL;
				$password = isset($_POST["password"])&&!empty($_POST["password"])
					? $_POST["password"]
					: NULL;
				$name = isset($_POST["name"])&&!empty($_POST["name"])
					? $_POST["name"]
					: NULL;
				$mail = isset($_POST["mail"])&&!empty($_POST["mail"])
					? $_POST["mail"]
					: NULL;
				$result=$this->user->reg($login, $password, $name, $mail);
			} break;
			case ("upload"): {
				$file = isset($_FILES["image"])&&!empty($_FILES["image"])
				? $_FILES["image"]
				: NULL;	
				$result=$this->user->upload($file);
			} break;
		}
		return $result;
	}
	
	
	private function getContent($tmp=""){ //возвращяет шаблоны по запросу
		$tmp_path=ROOT_PATH."/templates/".$tmp.".php";
		if(file_exists($tmp_path)){
			include ($tmp_path);
		} else print("шаблон" .$tmp."не найден");

	}
	private function getAuth(){ //возвращает выполненна ли авторизация пользователя	
		
		if(isset($_SESSION["user_data"])&&!empty($_SESSION["user_data"])){
			$id=$_SESSION["user_data"][0];
			$query="SELECT `id`, `login` FROM `users` WHERE `id`= '$id' ";
			$a=$this->connect_SQL($query);
			if($a){
				$user=mysqli_fetch_assoc($a);
				if($_SESSION["user_data"][1]==$user["login"]){
					return TRUE;
				}
				
			} 
		} else {
			if(isset($_COOKIE["user_data"])&&!empty($_COOKIE["user_data"])){
				$b=$_COOKIE["user_data"];
				$query="SELECT `id`, `login`, `cookie_token` FROM `users` WHERE `cookie_token`= '$b' ";
				$a=$this->connect_SQL($query);
				if($a){
					$user=mysqli_fetch_assoc($a);
					$_SESSION["user_data"]=$user["login"];
					return TRUE;
				}
			}
			
		}	 
			 return FALSE;
			 
	}
		
	public function getHTMLtemplates(){ //возвращяет шаблоны в index.php
		$auth=$this->getAuth();
				if($auth){
					if($this->event=="upload"){
						$this->getContent("upload_file");
					} else $this->getContent("user_cabinet");
					
				} 
				if(!$auth) {
					if($this->event=="reg"){
						$this->getContent("registration");
					} else $this->getContent("authorization");
				}
		

	}
	public function connect_SQL($query){  //приконектимся к БД 
		include("config.php");
		if(!empty($query)){
			$link=mysqli_connect($host, $user, $password);
			if (!$link) {
				die("Ошибка соединения: ". mysqli_connect_errno());
			}	
		mysqli_select_db( $link, $database);
			$result= mysqli_query($link, $query);
			mysqli_close($link);
			return $result;
		}

	}
}


?>