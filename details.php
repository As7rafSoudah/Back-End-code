<?php
/* 
Filename = details.php 
Author   = Ashraf Soudah
Date     = 19-03-2020
*/ 

// step 1 include files
include("database/config.php");
include("database/opendb.php");

if(isset($_GET["id"])){ 
    $ID = $_GET["id"]; 
}

// Step 2 Build query
$query ="SELECT id, firstname, lastname, hobbies, pillows, description, email ";
$query .= "FROM persons "; 
$query .= "WHERE id = ? ";

// Step 3 Prepare
$preparedquery = $dbaselink->prepare($query);
$preparedquery->bind_param("i",$ID);

// Step 4 Run
$preparedquery->execute();

// Step 5 - check for errors
if ($preparedquery->errno) {
    echo "Fout bij uitvoeren commando";
    echo "probeer het later nogmaals.";
} else {
       
// Step 6 - Read result
$result = $preparedquery->get_result();
if($result->num_rows === 0) {
    echo "Geen rijen gevonden";
} else {
    while($row = $result->fetch_assoc()) {  
        echo"<html lang=\"en\">";
            echo"<head>";
                echo"<meta charset=\"UTF-8\">";
                echo"<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
                echo "<link href='../school/stylesheet/style2.css' rel='stylesheet'>";
            echo"</head>";
                echo "<body>";
                    echo "<table class='tableDatails'; border = 1px solid>";
                    echo "<caption>The Person Information</caption>";
                        echo "<tr>";
                            echo "<th>Id</th>";
                            echo "<th>FirstName";
                            echo "<th>LastName</th>";
                            echo "<th>Email</th>";
                            echo "<th>Hobbies</th>";
                            echo "<th>Pillows</th>";
                            echo "<th>Description</th>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>";
                                echo $row['id'];
                            echo "</td>";
                            echo "<td>";
                                echo $row['firstname'];
                            echo "</td>";
                            echo "<td>";
                                echo $row['lastname'];
                            echo "</td>";
                            echo "<td>";
                                echo $row['email'];
                            echo "</td>";
                            echo "<td>";
                                echo $row['hobbies'];
                            echo "</td>";
                            echo "<td>";
                                echo $row['pillows'];
                            echo "</td>";
                            echo "<td>";
                                echo $row['description'];
                            echo "</td>";
                    echo "</table>"; 
                echo "</body>";
        echo "</html>";
    };
}
}
// Step7 - exit
$preparedquery->close();
include("database/closedb.php");

echo "<div class='linkGo'>";
echo "<a href=\"index.html\">Go Back To Index=> </a>";
echo "</div>";
echo "<br>";
echo "<div class='linkGo'>";
echo "<a href='overview.php'>Go Back=>";
echo "</div>";
    

