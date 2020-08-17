<?php
   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
     $info_file_name = explode('.', $_FILES["filename"]["name"]); //разделяем строку имени файла по точке, чтобы получить расширение
     $ext = array_pop($info_file_name); //получаем расширение файла
     //$filename = str_replace('_', '', $info_file_name[0]);
     $filename = $info_file_name[0];
     
     $filename = $filename."_".time().".".$ext;
     move_uploaded_file($_FILES["filename"]["tmp_name"], __DIR__."/files/".$filename);
     
	 if( ! headers_sent()) {
		 header("Location: /index.php");
	 } else {
		 exit("<script type='text/javascript'>window.location.href = 'index.php';</script>");
	 }
	 
   } else {
      echo("Ошибка загрузки файла");
   }
?>