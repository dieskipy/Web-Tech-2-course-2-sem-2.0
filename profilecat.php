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
if (($_GET['num']>6) or ($_GET['num']<1) )
{
    header('Location: 404.php');
    exit();
}
$stmt = $pdo->prepare('SELECT name,img,info,num FROM `info_cats` WHERE num=:num');
$stmt->bindParam(':num', $_GET['num'], PDO::PARAM_INT);
$stmt->execute();
$database = $stmt->fetch(PDO::FETCH_LAZY);

$template = $twig->load('cat1.html');
echo $twig->render('cat1.html', ['mydata'=>$database]);