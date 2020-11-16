
<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Загрузка файла</title>
 </head>
 <body>
<h>Загрузка файла на сервер</h>

<p>Выберите файл для загрузки</p> 

<form method="POST" action="index.php" enctype="multipart/form-data">
	<input name="operation" type="hidden" value="upload">	
	<input type="file" name="image"/>
	<input type="submit" value="Загрузить"/>	
</form>
<p><a href="index.php">Вернуться на главную</a>
 </body>
</html>