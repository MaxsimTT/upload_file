<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Страница загрузки файла</title>
</head>
<body>
	<form enctype="multipart/form-data" method="POST">
		<p>Загрузите файл на сервер</p>
		<p><input type="file" name="main_file" accept=".txt">
		<input type="submit" value="Отправить"></p>
	</form>
	<? if (isset($file_name)) { ?>
		<p><?=$file_name?></p>
	<? } ?>
</body>
</html>