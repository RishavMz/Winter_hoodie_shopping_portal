<!--
    Author : RishavMz
    This page is just for redirection  during the login for admin view 
    of the data from students table.

<?php
require_once "pdo.php";
session_start();
if(! isset($_POST['admi'])){
    header("Location:GoAway.html");
    return;
}
echo($_POST['admi']);

    $_SESSION['admi'] = htmlentities($_POST['admi']);
    $sql = "SELECT count(*) FROM ADMINS WHERE admi = (:admi) AND PASS=(:pass);";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute(array(':admi' => htmlentities($_POST['admi']), ':pass' => htmlentities($_POST['password'])));
    $rows = $stmt->fetchColumn();
    if ($rows ==0) {
        header("Location:GoAway.html");
        return;
    }
    else{
        header("Location:admin.php");
        return;
    }         
?>