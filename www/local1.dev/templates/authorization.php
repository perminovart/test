

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Авторизация</title>
	</head>
	<body>
		<h>Авторизация</h>

		<p>Введите логин и пароль</p> 

		<form method="POST" action="index.php" >
			<input name="operation" type="hidden" value="auth">
			<p><strong>Логин:</strong>
			<input maxlength="25" size="40" name="login"></p>
			<p><strong>Пароль:</strong> 
			<input type="password" maxlength="25" size="40" name="password"></p>
			<p><strong>Запомнить меня</strong> 
			<input type="checkbox" name="remember_my">			
			<p><input type="submit" value="Авторизоваться">
			
		</form>
		<a href="index.php?event=reg">Регистрация</a>
	</body>
</html>