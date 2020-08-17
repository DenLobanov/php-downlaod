<html>
<head>
  <title>Загрузка файлов на сервер</title>
</head>
<body>
<table border="1">
   <caption>Таблица загруженных файлов</caption>
   <tr>
    <th>Имя файла</th>
    <th>Расширение</th>
    <th>Размер</th>
    <th>Дата создания</th>
    <th>Удалить</th>
   </tr>
  

<?php
	foreach(glob(__DIR__.'/files/*.*') as $file) 
	{
		$array_info = explode('/', $file); //это массив, содержит все директории, разделяет строку (/var/www/html...) по слешу 
		$singleFileName = array_pop($array_info); //имя файла с префиксом времени загрузки
		$info_file_name = explode('_', $singleFileName); // fileName_time => array ([filename, time_created])
		
		if(count($info_file_name) < 3) {
			$filename = $info_file_name[0]; //Это имя файла, 0 потому что оно идет первым в массиве (т.к. стоит до слеша)
			$time = $info_file_name[1]; //Время загрузки, 1 потому что он идет вторым в массиве (т.к. после слеша стоит)
		} else {
			$keyOfArrayForTime = count($info_file_name) - 1;
			$time = $info_file_name[$keyOfArrayForTime];
			unset($info_file_name[$keyOfArrayForTime]);
			$filename = implode('_',$info_file_name);
		}
		
		$info_file_name = explode('.', $singleFileName); //разделить имя файла на массив (array (имя файла, расширение))
		
		$ext = array_pop($info_file_name); //выбрать последний элемент из массива информации из имени файла, т.е. расширение
?>

	<tr><td><a href="/files/<?=$singleFileName?>"><?=$filename?></a></td><td><?=$ext?></td><td><?=filesize($file)?></td><td><?=date('d.M.Y H:i:s', $time)?></td><td><a href="delete_file.php?filename=<?=$singleFileName?>">Удалить</a></td></tr>

<?php
	}
?>
</table>
      <h2><p><b> Форма для загрузки файлов </b></p></h2>
      <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="filename"><br> 
      <input type="submit" value="Загрузить"><br>
      </form>
</body>
</html>