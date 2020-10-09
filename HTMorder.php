<?php
require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

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
$stmt= $pdo->query('SELECT header,content,img FROM `pageinfo` WHERE num_info=5');
$promodata = $stmt->fetch(PDO::FETCH_LAZY);
$stmt= $pdo->query('SELECT str FROM `data` WHERE num<5');
$data = $stmt->fetchALL();

$template = $twig->load('HTMorder.html');
echo $twig->render('HTMorder.html', ['promodata'=>$promodata, 'data'=>$data]);