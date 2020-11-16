
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Личный кабинет</title>
	</head>
	<body>
		<h>Личный кабинет</h>
		<p><?php print ("Hello ". $_SESSION["user_data"][1]);?></p> 
		<a href="index.php?event=upload">Загрузить файл</a>
		<p>Нажмите для выхода</p> 
		<form method="GET" action="index.php">
			<input hidden="login" name="event" value="exit">
			<input type="submit" value="Выйти">
		</form>
	</body>
</html>