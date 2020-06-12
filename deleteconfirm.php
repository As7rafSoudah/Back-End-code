<?php
/* 
Filename = deleteconfirm.php 
Author   = Ashraf Soudah
Date     = 3-04-2020
*/ 
include("database/config.php");    
include("database/opendb.php");
include("function.php");
    
if (isset($_GET['id'])) {
        $row = $_GET['id'];
    if ($row === "") {
        echo "Programma fout, verwerking afgeboken";
        exit;
    }
} else {
        echo "Programma fout, verwerking afgeboken";
        exit;
}

// HTML code 
// connect HTML with CSS
echo"<html lang=\"en\">";
    echo"<head>";
        echo"<meta charset=\"UTF-8\">";
        echo"<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
        echo "<link href='../school/stylesheet/style2.css' rel='stylesheet'>";
    echo"</head>";
        echo "<body>";
            echo "<div class='div1'>Are you sure you want to delete number $row?";
                echo "<div class='div2'>";
                    echo "<a href=\"deleteresult.php?id=$row \">";
                    echo "Yes</a>";
                echo "</div>";
                echo "<div class='div2'>";
                    echo "<a href='overview.php'>";
                    echo "Nee</a>";
                echo "</div>";
            echo "</div>";
        echo "</body>";
echo "</html>";

// fetch the full name
$query = "SELECT firstname,lastname ";
$query .= "FROM persons ";
$query .= "Where id = ?";
// prepare the statement and link to ID number
$preparedstatement = $dbaselink->prepare($query);
$preparedstatement->bind_param("i", $id);
$preparedstatement->execute();
// check for errors
if($preparedstatement->errno){
    echo "Program error, user not found.";

$preparedstatement->close();
exit;

} else {
    // get results
    $result = $preparedstatement->get_result();
    // put results in array with names
    while($row = $result->fetch_assoc()){
    // get the firstname
    $fullname = getname($row["firstname"], $row['lastname']);
    }
}

// close the database
include("database/closedb.php");

?>
