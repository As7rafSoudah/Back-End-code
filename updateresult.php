<?php
/*
 * Filename: updateresult.php
 * Date: 11-04-2019
 * Author: Ashraf Soudah
 */
include("database/config.php"); //  include files
include("database/opendb.php");

// HTML code..
// connect with CSS
echo "<!DOCTYPE html>";
echo "<html>";
         echo "<head>";
         echo "<link href=\"../school/stylesheet/style.css\" rel=\"stylesheet\">";
         echo "</head>";
echo "</html>";


if ((isset($_POST['id'])) &&(isset($_POST['firstname'])) && (isset($_POST['lastname'])) &&
   (isset($_POST['email'])) && (isset($_POST['password'])) &&
   (isset($_POST['hobbies'])) && (isset($_POST['pillows'])) &&
   (isset($_POST['description']))) {

       $id = $_POST['id'];
       $firstname = $_POST['firstname'];
       $lastname = $_POST['lastname'];
       $email = $_POST['email'];
       $password = $_POST['password'];
       $hobbies = $_POST['hobbies'];
       $pillows = $_POST['pillows'];
       $description = $_POST['description'];
}   if ($id === "") {
       echo "Er is geen id ingegeven";
       include("database/closedb.php");
       exit;
    }
    if ($firstname === "") {
       echo "Er is geen voornaam ingegeven";
       include("database/closedb.php");
       exit;
    }
    if ($lastname === "") {
       echo "Er is geen achternaam ingegeven";
       include("database/closedb.php");
       exit;
    }
    if ($email === "") {
       echo "Er is geen email ingegeven";
       include("database/closedb.php");
       exit;
    }
    if ($password === "") {
       echo "Er is geen password ingegeven";
       include("database/closedb.php");
       exit;
    }
    if ($hobbies === "") {
       echo "Er is geen hobbies ingegeven";
       include("database/closedb.php");
       exit;
    }
    if ($pillows === "") {
       echo "Er is geen pillows ingegeven";
       include("database/closedb.php");
       exit;
    }
    if ($description === "") {
       echo "Er is geen description ingegeven";
       include("database/closedb.php");
       exit;
    }



// compose the SQL command
$query ="UPDATE persons ";
$query .= "SET firstname=?, lastname=? ,email=? ,password=? ,hobbies=? ,pillows=? ,description=? ";
$query .= "WHERE id=? ";

// prepare the statement, bind parameters and execute the SQL command
$preparedquery = $dbaselink->prepare($query);
$preparedquery->bind_param("ssssiisi", $firstname, $lastname, $email, $password, $hobbies, $pillows, $description, $id);

// Execute the command
$preparedquery->execute();


// Check for errors
if ($preparedquery->errno) {  //  Check
      echo "Program error, processing aborted."; // error
} else {
      echo "<div class='div1'>";
      echo "The information has been updated to id number "; echo "<a href=\"details.php?id=". $id. "\">";echo $id." <br>"; // The result
      echo "</div>";
}
      echo "<div class='linkGo'>";
      echo "<a href=\"overview.php\">Verder=></a><br><br>"; //  echo   this  the user name deleted
      echo"<a href=\"index.html\">Go Back To Index=> </a>";
      echo "</div>";
      exit;

// close the statement
$preparedquery->close(); // exit

// close the database
include("database/closedb.php");// include  closedb
