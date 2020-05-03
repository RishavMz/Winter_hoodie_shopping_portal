<!--Author: RishavMz
    This page is visible only after a successful login from login_admin.php.
    This page shows details from the students table.
    This page is meant for admin view of entries by the students.
-->

<?php
require_once "pdo.php";
session_start();
if(! isset($_SESSION['admi'])){
    header("Location:GoAway.html");
    return;
}
$stmt = $pdo->query("SELECT * from students");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <title>Admin view</title>
        <link rel = "stylesheet" type= "text/css" href = "..\CSS\admin.css">
</head>
<body>
<a id="link2" href="login_admin.php" ><b>LOG OUT</b></a>
<img id="img_nav"src="https://upload.wikimedia.org/wikipedia/en/f/fa/Indian_Institute_of_Information_Technology_Ranchi_Logo.svg" alt="N0 Internet">
<span id="regno"><b>Welcome <?php echo htmlentities($_SESSION["admi"]) ?></b></span>
<center>
    <h1>
        <span id="G">Student Entry Details</span>
</h1>
</center>
<br>
<div id="t">
   <center> 
<table >
    <tr style="font-weight:bold;">
        <h3>
        <td>Registration Number</td>
        <td>Name</td>
        <td>Colour</td>
        <td>Size</td>
        <td>State</td>
        <td>Paid</td>
</h3>
    </tr>
<?php
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['ID']);
    echo("</td><td>");
    echo($row['NAME']);
    echo("</td><td>");
    echo($row['COLOUR']);
    echo("</td><td>");
    echo($row['SIZE']);
    echo("</td><td>");
    echo($row['STATE']);
    echo("</td><td>");
    echo($row['paid']);
    echo("</td></tr>\n");
}
?>
</table>
</div>
</center>
<br><br><br>
<center>

<a id= "add" href="add.php" >Click here to update details  of students who paid the amount.</a>
<br><br>
<span id="RM" style="color:black;font-style:italic;">------------Made by Rishav Mazumdar-------------</span>
</center>
</body>
</html>

<!-- Initially for testing using the given the database, use username 'person1' and password '12345678'  (without quotes)-->
