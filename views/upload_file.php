<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Страница загрузки файла</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	<form enctype="multipart/form-data" method="POST">
		<input type="hidden" name="uploadfile"></p>
		<p class="test">Загрузите файл на сервер</p>
		<p><input type="file" name="text_file" accept=".txt">
		<input type="submit" value="Отправить"></p>
	</form>
	<button id="btn">Кнопка для скрытия элемента</button>
	<? if (isset($file_name)) { ?>
		<p><?=$file_name?></p>
	<? } ?>
</body>
</html>
