<?php
session_start();
ini_set('display_errors','off');

$data_url = "mysql";
$server = "localhost";
$username = "root";
$password = "";
$dbname = "cms";
$dbcharset = "utf8";
try {
    $conn = new PDO("$data_url:host=$server;dbname=$dbname;charset=$dbcharset", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //   echo "Bağlantı başarılı";
}
catch(PDOException $e)
{
    echo "Bağlantı hatası: " . $e->getMessage();
}

ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
?>