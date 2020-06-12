<?php
/*
Filename = addresult.php
Author   = Ashraf Soudah
Date     = 26-03-2020
Update : 16-05-2020
*/
include("database/config.php"); // 1-stap   include files
include("database/opendb.php");

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
} else {
        echo "Verplichte velden ontbreken, verwerking gestopt.";
        include("database/closedb.php");
        exit;
    }
    if ($id === "") {
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

// START TRANSACTION;
mysqli_autocommit($dbaselink, FALSE);

// select Maxid from persons
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

if ($currentId > 10) {
      mysqli_rollback($dbaselink);
      echo "Sorry, we zitten vol";
      exit;
} else {
    $query = "INSERT INTO persons ";
    $query .= "(id, firstname, lastname, email, password, hobbies, pillows,
    description) ";
    $query .= "VALUES(?, ?, ?, ?, ?, ?, ?, ?) ";

    // Prepare the statement
    $preparedquery = $dbaselink->prepare($query);
    // Bind the variables, types and position questionmarks

    $preparedquery->bind_param("isssssss", $id, $firstname, $lastname,
    $email, $password, $hobbies, $pillows, $description);

    // Execute the command
    $preparedquery->execute();

    // Check for errors
    if ($preparedquery->errno){  //  control
        echo "Er is een fout opgetreden. Verwerking afgebroken."; // wrong   echo wrong
    } else {
        echo "Toegevoegd gebruiker met nummer ";
        echo "<a href=\"details.php?id=". $currentId. "\">"; echo $id; echo "</a><br>";
    }     // good  echo  Added user number

    // close the statement
    $preparedquery->close();
    }

// END TRANSACTION;
mysqli_commit($dbaselink);

// close the database
include("database/closedb.php");// include  closedb










































// if (isset($_POST)) {
//     $firstname=$_POST['fn'];
//     $lastname=$_POST['ln'];
//     $email=$_POST['em'];
//     $password=$_POST['pas'];
//     $hobbies=$_POST['hobby'];
//     $pillows=$_POST['pill'];
//    $description=$_POST['desc'];

//    if ($description == NULL) {
//        echo "";
//    }
//    else {
//        echo $description;
//    }
// }

// // 1- stap include files
// include("database/config.php");
// include("database/opendb.php");




// $query="SELECT MAX(ID) AS maxid ";
// $query.="FROM persons ";

// //  give the prepare to database
// $preparedquery = $dbaselink->prepare($query);
// $preparedquery->execute();

// // control value
// if ($preparedquery->errno) {

//     //  wrong  print   Error executing command
//     echo "Fout bij het uitvoeren commando";
//     echo "probeer het later nogmaals<br>";
// } else {
//     $result = $preparedquery->get_result();
//     if ($result->num_rows === 0) {
//         //if the result is empty echo no rows
//         echo "no rows found. " . "<br>";
//     } else {
//         // else   echo  de  result in assoc array
//         while($row = $result->fetch_assoc()) {
//             $maxId=$row['maxid'] ;
//         };
//     }
// };
// //add one to   maxid
// $currentId = $maxId + 1;
// $preparedquery->close();

//  // make query  to insert into datanbase
// $queryadd = "INSERT INTO persons ";

// //it's the value that I want to toevogen database
// $queryadd .= "(id, firstname, lastname, email,password,hobbies,pillows,description) ";
// $queryadd .= "VALUES(?, ?, ?, ?, ?, ?, ?,?) ";

// // Execute the prepared statement
// $preparedquery = $dbaselink->prepare($queryadd);

//  //put the  vaules in de variables
// $preparedquery->bind_param("issssiis", $currentId, $firstname,$lastname,$email,$password,$hobbies,$pillows,$description );
// $preparedquery->execute();

// // Check for errors
// if ($preparedquery->errno){  //  check
//  echo "Er is een fout opgetreden. Verwerking afgebroken.";
// } else {
// echo "Toegevoegd gebruiker met nummer " . $currentId;
// }
// $preparedquery->close();

// // include  closedb
// include("database/closedb.php");
