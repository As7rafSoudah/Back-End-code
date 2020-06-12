<?php
/*
Filename = deleteconfirm.php
Author   = Ashraf Soudah
Date     = 4-04-2020
Update : 16-05-2020
*/

// include files
include("database/config.php");
include("database/opendb.php");

// HTML code
// connect HTML with CSS
echo"<html lang=\"en\">";
    echo"<head>";
        echo"<meta charset=\"UTF-8\">";
        echo"<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
        echo "<link href='../school/stylesheet/style2.css' rel='stylesheet'>";
    echo"</head>";
        echo "<body>";
        echo "</body>";
echo "</html>";

// Get id
$id=$_GET['id'];

// START TRANSACTION;
mysqli_autocommit($dbaselink, FALSE);

// compose the SQL command
$query="SELECT MAX(ID) AS maxid ,firstname, lastname,email, password,hobbies,pillows,description ";  // get the  max id
$query.="FROM persons ";
// Prepare and execute the query
$preparedquery = $dbaselink->prepare($query);
$preparedquery->execute();
// Check for errors
if ($preparedquery->errno) {
echo "Fout bij uitvoeren commando, probeer het later nogmaals.";
} else {
    $result = $preparedquery->get_result();  //good   yhen get the reslult
    if ($result->num_rows === 0) {
        echo "no rows found. " . "<br>"; //if the result is empty echo no rows
    } else {
        while($row = $result->fetch_assoc()) {
            $maxId=$row['maxid'] ; // else   echo  de  result in assoc array
            // Display the first+lastname in a ahref.
            $currentId = $maxId + 1;
        }
    };
}
$preparedquery->close();

if ($maxId == $id) {
  // rollback
  mysqli_rollback($dbaselink);
  echo "Sorry kan niet verwijderen";
  exit;
} else {

    $query="DELETE FROM persons ";
    $query.="WHERE id = ?  ";
    $query.="LIMIT 1";

    // prepare the statement, bind parameters and execute the SQL command
    $preparedquery=$dbaselink->prepare($query);
    $preparedquery->bind_param("i",$id);

    // Execute the command
    $result=$preparedquery->execute();

    // Check for errors
    if(($preparedquery->errno)or($result===false)){
        echo " user  name  doesn't exist";
    } else {
        echo "<div class='div1'>";
        echo "Id number $id  was deleted successfully. "."<br>";
        echo "</div><br>";
        echo "<div class='linkGo'>";
        echo "<a href=\"overview.php\">Verder=></a><br><br>";
        echo"<a href=\"index.html\">Go Back To Index=> </a>";
        echo "</div>";
    }

// close the statement
$preparedquery->close(); // exit
}

// END TRANSACTION;
mysqli_commit($dbaselink);

// close the database
include("database/closedb.php");

?>
