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
    
<table >
    <tr style="font-weight:bold;">
        <h3>
        <td>Registration Number</td>
        <td>Name</td>
        <td>Colour</td>
        <td>Size</td>
        <td>State</td>
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
    echo("</td></tr>\n");
}
?>
</table>
</div>
<style>
    body{

        margin-top: 100px;
        background-image: linear-gradient(to right bottom,white,white,wheat,wheat);
    }
    #t{
        margin-left: 250px;
    }
    #G{
        box-shadow: 0 0 30px rgba(0,0,0,0.5);
        background-color:white;
    }
     th , td
    {
        padding: 5px;
         border: 2px groove ;
          background-color: ghostwhite;
           color: black;
           font-style: italic;
            text-align: center;
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
        
    }
    table
    {  text-align: center;
        padding: 5px;
         border: 2px groove ;
          background-color: ghostwhite;
           color: black;
           font-style: italic;
            text-align: center;
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
             margin-left:100px;
        
    }
    #link2{
        text-decoration-line: none;
        color:GREEN;
        font-size: 1.8em;
        position:absolute;
        top: 15px;
        right:250px;
        box-shadow: 0 0 30px rgba(0,0,0,0.5);
        background-color:white;
        padding: 5px;
    }
    #img_nav{
        height:120px;
        width:120px;
        position: absolute;
        left:30px;
        top: 5px;
    }
    
    #regno{
        text-decoration-line: none;
        color:darkblue;
        font-size: 1.8em;
        position:absolute;
        top: 25px;
        left:350px;
        box-shadow: 0 0 30px rgba(0,0,0,0.5);
        background-color:white;
    }
    </style>