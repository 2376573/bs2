<!--connect할 서버 지정-->
<?php
if($_SERVER['HTTP_HOST'] == "a2376573.dothome.co.kr"){
    $host = "localhost";
$dbuser = "a2376573";
$dbpw = "a23765kl!!";
$dbname = "a2376573";
}else{
    $host = "localhost";
    $dbuser = "teayeon";
    $dbpw = "[,9!L]5D]([SHt/";
    $dbname = "teayeon";
}
$connect = new mysqli($host, $dbuser,$dbpw , $dbname) or die("죽어라");