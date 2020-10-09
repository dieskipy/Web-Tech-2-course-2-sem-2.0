<?php
//кодуля к поиску и замене ссылок
$number ='';
$city ='';

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

if(isset($_POST['number'])) $number = $_POST['number'];
if (isset($_POST['city'])) $city = $_POST['city'];
$catindex=$_GET['num'];
if (($catindex>6) or ($catindex<1))
{
    header('Location: 404.php');
    exit();
}

$stmt = $pdo->prepare('INSERT INTO `ordertable` (`num`, `number`, `city`,`cat_index`) VALUES (NULL, :number, :city, :mynum)');
$stmt->bindParam(':number', $number, PDO::PARAM_STR, 20);
$stmt->bindParam(':city', $city, PDO::PARAM_STR, 20);
$stmt->bindParam(':mynum', $catindex, PDO::PARAM_INT);
$stmt->execute();


header('Location: order.php?num='.$catindex.'&bool=1');
exit();