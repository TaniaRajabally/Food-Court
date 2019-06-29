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
    $add1=testInput($_POST['add1']);
    $add2=testInput($_POST['add2']);
    $add3=testInput($_POST['add3']);
    $pincode=testInput($_POST['pincode']);

    $newentry = true;

    //Verify if account already exists or not
    $check_sql = "SELECT email FROM user_details where email = ?";
    $check_stmt = $db_connect->prepare($check_sql);
    $check_stmt->execute([$email]);
    $number_of_rows = $check_stmt->rowCount();
    if($number_of_rows == 1) {
        $newentry = false;
    }

    if($newentry){
        $add_sql = "INSERT INTO user_details(email,password,add1,add2,add3,pincode) VALUES (?,?,?,?,?,?)";
        $add_stmt = $db_connect->prepare($add_sql);
        $add_stmt->execute([$email,$password,$add1,$add2,$add3,$pincode]);

        $id_sql = "SELECT uid FROM user_details WHERE email= ?";
        $id_stmt = $db_connect->prepare($id_sql);
        $id_stmt->execute([$email]);
        $_SESSION['uid']=$id_stmt->fetch()->uid;

        $db_connect = null;
        header('Location: Order.html');
        exit;
    } else {
        $db_connect = null;
        header('Location: SignIn.html');
        exit;
    }

}
