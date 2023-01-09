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
		<? if (isset($res)) { ?>
			<p class="<?= $res == true ? 'circle-green' : 'circle-red'?>">
				Статус загрузки файла: 
			</p>
		<? } ?>
	</form>
	<? if (!empty($count_digital)) { ?>
		<h3>Count digit in files strings:</h3>
		<? foreach ($count_digital as $file_name => $strings) { ?>
			<div>
				<?= $file_name; ?>
				<a href="?<?= "del={$file_name}" ?>">Delete file</a>
				<ul>
					<? foreach ($strings as $num_str => $amount_digits) { ?>
						<li><?= 'string number ' . $num_str . ' = amount digits '. $amount_digits; ?></li>
					<? } ?>
				</ul>
			</div>
		<? } ?>
	<? } ?>
</body>
</html>
