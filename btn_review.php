<?php
//кодуля к поиску и замене ссылок
$name='';
$text ='';

$host = 'assassin.cats';
$db   = 'info_str';
$user = 'root';
$pass = '1312';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

if(isset($_POST['name'])) $name = $_POST['name'];
if (isset($_POST['text'])) $text = $_POST['text'];

$regexp = '~(https?:\/\/(?!assassin\.cats)(?:[\w]*\.)(?!assassin\.cats)[\w.\-\=\?\/\&]*)~';
$text = preg_replace($regexp, '#Внешние ссылки запрещены#',$text);


$stmt = $pdo->prepare('INSERT INTO `feedback` (`num`, `name`, `text`) VALUES (NULL, :name, :text)');
$stmt->bindParam(':name', $name, PDO::PARAM_STR, 15);
$stmt->bindParam(':text', $text, PDO::PARAM_STR, 250);
$stmt->execute();


header('Location: review.php?bool=1');
exit();