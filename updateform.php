<?php
/*
 * Filename: updateform.php
 * Date: 11-04-2019
 * Author: Ashraf Soudah
 */

//  include files
include("database/config.php"); 
include("database/opendb.php");

// fetch and check that the id isset
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // check that the id is filled
    if ($id === "") {
        echo "Id parameter is empty";
        exit;
    }
} else {
    echo "Id parameter was not passed";
    exit;
}

// Step 2 Build query
// compose the SQL command
$query  = "SELECT id, firstname, lastname,email, password, hobbies, pillows, description ";
$query .= "FROM persons ";
$query.="WHERE id=? ";

// prepare the statement, bind parameters and execute the SQL command  
$preparedquery = $dbaselink->prepare($query);                           
$preparedquery->bind_param("i",$id); 

// Step 4 Run
$preparedquery->execute();

// Step 5 - check for errors
if ($preparedquery->errno) {
    echo "Error requesting data";
    exit;
} else {
        // Step 6 - Read result
        $result = $preparedquery->get_result();
     
        // Fetch each row into an associative array
        while($row = $result->fetch_assoc()) {

            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $password = $row['password'];
            $hobbies = $row['hobbies'];
            $pillows = $row['pillows'];
            $description = $row['description'];      
        };            
}
// Step7 - exit
// close the statement 
$preparedquery->close();

// include  closedb
// close the database
include("database/closedb.php");
     
echo"<html lang=\"en\">";
echo"<head>";
echo"<meta charset=\"UTF-8\">";
echo"<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
echo "<link href='../school/stylesheet/formstyle.css' rel='stylesheet'>";

echo"<title>Update</title>";
echo"</head>";

echo"<body>";
echo"<h1 style='text-align: center;'>Update Page</h1>";
echo "<div class='form-style-5'>";
echo " <form action=\"updateresult.php\" method=\"POST\">";

echo "<table>";

echo"<tr>";
 echo "<td><label >Update Id </label></td>";
 echo"<td><input type=\"hidden\" name=\"id\" value=\"$id\"> </td>";  
echo"</tr>"; 

echo"<tr>";
echo "<td><label >Update Your Firstname</label>  </td>";
echo"<td><input type=\"text\" name=\"firstname\"  value=\"$firstname\"></td>";   
echo"</tr>";
                                                                                    
echo"<tr>";
echo "<td><label >Update Your Lastname</label></td> ";
echo"<td><input type=\"text\" name=\"lastname\" value=\"$lastname\" ></td>";
echo"</tr>";

echo"<tr>";
echo "<td><label >Update Your Email</label></td> ";
echo"<td><input type=\"text\" name=\"email\"value=\"$email\"> </td>";
echo"</tr>";

echo"<tr>";
echo "<td><label >Update Your Password</label></td> ";
echo"<td><input type=\"text\" name=\"password\" value=\"$password\"> </td>";
echo"</tr>";

echo"<tr>";
echo "<td><label >Update Your Hobbies</label></td>";
echo"<td><input type=\"text\" name=\"hobbies\"value=\"$hobbies\"> </td>";
echo"</tr>";

echo"<tr>";
echo "<td><label >Update Your Pillows</label></td>";
echo"<td><input type=\"text\" name=\"pillows\"value=\"$pillows\"></td>";
echo"</tr>";

echo"<tr>";
echo " <td><label >Update Your Description</label></td>";
echo"<td><input type=\"text\" name=\"description\" value=\"$description\"> </td>";
echo"</tr>";

echo"<tr>";
echo"<td>&nbsp;</td>";
echo"<td><input type=\"submit\" value=\"send\"> </td>";
echo"</tr>";

echo"</form>";
echo"</tabel>";
echo "</div>";

echo"</body>";
echo"</html>";



