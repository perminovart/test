<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Регистрация</title>
	</head>
	<body>
		<h>Регистрация нового пользователя</h>

		<p>Заполните все поля</p> 

		<form method="POST" action="index.php" >
			<input name="operation" type="hidden" value="reg">
			<p><strong>Логин:</strong>
			<input maxlength="25" size="40" name="login"></p>
			<p><strong>Пароль:</strong> 
			<input type="password" maxlength="25" size="40" name="password"></p>
			<p><strong>Имя</strong> 
			<input maxlength="25" size="40" name="name"></p>
			<p><strong>Email</strong> 
			<input maxlength="25" size="40" name="mail"></p>		
			<p><input type="submit" value="Регистрация">
			
		</form>
		<p>Если вы уже зарегестрированы то  <a href="index.php?event=auth">авторизуйтесь</a>
	</body>
</html>