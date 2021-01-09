<!--
    Author : RishavMz
    Host presently set to localhost
    Name of database     : db1
    Username             : root
    password             :  -     
    
    This php file is just for establishing conection between the PHP and MYSQL and is included in every other php file.
-->    

<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=SHOPPINGPORTAL",'root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>