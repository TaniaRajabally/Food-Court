<?php

session_start();

$host="localhost";
$db="foodcourt";
$dsn="mysql:host=".$host.";dbname=".$db;    //data source name

try{
    $db_connect = new PDO($dsn,"root","A13m5a1999N");
    $db_connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $db_connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}catch (PDOException $e){
    die("Connection error: ".$e->getMessage());
}

function testInput($in){
    $in=trim($in);
    $in=stripslashes($in);
    $in=htmlspecialchars($in);
    return $in;
}

if(isset($_POST['submit'])){
    $email=testInput($_POST['email']);
    $password=testInput($_POST['password']);

    $userExists = false;

    $sql = "SELECT uid FROM user_details WHERE email = ? AND password = ?";
    $stmt=$db_connect->prepare($sql);
    $stmt->execute([$email,$password]);

    $number_of_rows = $stmt->rowCount();

    if($number_of_rows == 1){
        $userExists = true;
    }

    if($userExists){
        $_SESSION['uid']=$stmt->fetch()->uid;

        $db_connect = null;
        header('Location: Order.html');
        exit;
    }else{
        $db_connect = null;
        header('Location: SignIn.html');
        exit;
    }
}
