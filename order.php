<?php
require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$num=$_GET['num'];
$bool = $_GET['bool'];

if (($num>6) or($num<1) or ($bool>1) or ($bool<0))
{
    header('Location: 404.php');
    exit();
}
$template = $twig->load('order.html');
echo $twig->render('order.html', ['bool'=>$bool,'num'=>$num]);