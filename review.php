<?php
require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if(isset($_GET['bool']))
    $bool = $_GET['bool'];
    else
    {
        $bool=0;
    }

if (($bool>1) or ($bool<0))
{
    header('Location: 404.php');
    exit();
}

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

$stmt = $pdo->query('SELECT a.killed,a.name_index,a.myimg,b.name FROM `info_dead` as a, `info_cats` as b WHERE a.name_index = b.num');
$data = $stmt->fetchAll();

$stmt = $pdo->query('SELECT name,text FROM `feedback`');
$feedback = $stmt->fetchAll();
$i=count($feedback);

$template = $twig->load('review.html');
echo $twig->render('review.html', ['database'=>$data,'i'=>$i, 'reviews'=>$feedback, 'bool'=>$bool]);


