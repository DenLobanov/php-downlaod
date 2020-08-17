<?php
$filename = $_GET['filename'];
$fileLink = __DIR__ . '/files/' . $filename;

if(file_exists($fileLink)) {
    unlink($fileLink);
    header("Location:/index.php");
} else {
    exit("Файл $fileLink не найден");
}

?>