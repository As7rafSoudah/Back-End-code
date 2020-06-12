<?php
/*
Filename = overview.php
Author   = Ashraf Soudah
Date     = 18-03-2020
*/

// include files
include("database/config.php");
include("database/opendb.php");
include("function.php");

// Build query
// compose the SQL command
$query  = "SELECT id, firstname, lastname,email, password, hobbies, pillows, description ";
$query .= "FROM persons ";

// prepare the statement, bind parameters and execute the SQL command
$preparedquery = $dbaselink->prepare($query);

// Execute the command
$preparedquery->execute();

// Check for errors
if ($preparedquery->errno) {
    echo "Error executing command";
} else {
    // Read result
    $result = $preparedquery->get_result();
    // Check for no rows
    if($result->num_rows === 0) {
        echo "Geen rijen gevonden";
    } else {
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $password = $row['password'];
            $hobbies = $row['hobbies'];
            $pillows = $row['pillows'];
            $description = $row['description'];

                echo"<html lang=\"en\">";
                    echo"<head>";
                        echo"<meta charset=\"UTF-8\">";
                        echo"<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
                        echo "<link href='../school/stylesheet/formstyle.css' rel='stylesheet'>";

                        
                    echo"</head>";
                        echo "<body>";
                                echo "<table class='tableOver' border='3px solid'>";
                                echo "<tr>";
                                        echo "<th>";
                                            echo "<a href=\"details.php?id=" . $id . "\">" .getname($row['firstname'], $row['lastname']) . "</a>";
                                        echo "</th>";
                                echo "</tr>";
                                echo "<tr>";
                                        echo "<td class='tdOver'>";
                                            echo "<a href=\"deleteconfirm.php?id=" . $id . "\"> Delete</a>";
                                        echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                        echo "<td class='tdOver'>";
                                            echo "<a href=\"updateform.php.?id=".$id."\"> Update</a>";
                                        echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                        echo "<td class='tdOver'>";
                                            if ($row['hobbies']>= 3) {   // If there are 3 or more hobbies
                                                echo" * ";
                                            }
                                            if ($row['pillows']== 0) { // If there are no pillows
                                                echo" * ";
                                            }
                                        echo "</td>";
                                echo "<tr>";
                                echo "</table>";
                                echo "<br>";
                        echo "</body>";
                echo "</html>";
        }
    }
}

// close the statement
$preparedquery->close();
include("database/closedb.php");

// go to the index
echo "<br>";
echo "<div class='linkGo'>";
echo "<a href=\"index.html\">Go Back To Index=> </a>";
echo "</div>";
