<?php
/* 
Filename = searchaddresult.php 
Author   = Ashraf Soudah
Date     = 27-03-2020
*/ 

include("database/config.php"); 
include("database/opendb.php");

 if (!isset($_POST["id"])) {
      echo"geen vaules";
 }else{ 
      $x=$_POST["id"];
 }

// Step 2 Build query
$query = "SELECT firstname,lastname,hobbies ";
$query .= "FROM persons ";
$query .= "WHERE id= ? ";

// Step 3 Prepare
$preparedquery = $dbaselink->prepare($query);
$preparedquery->bind_param("i", $x);

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
                $firstname = $row['firstname'];
                $lastname = $row['lastname']; 
                $hobbies = $row['hobbies'];
                    echo"<a href=\"details.php?id1='$firstname'&id2=''\"> $firstname  $lastname</a>";
                    echo "<br>";
            };
        }

    }

    // Step7 - exit
    $preparedquery->close();
    include("database/closedb.php");

    echo"<br>";
    echo"<a href='index.html'>Go Back To ndex </a>";