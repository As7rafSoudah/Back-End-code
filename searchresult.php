<?php
/* 
Filename = searchresult.php 
Author   = Ashraf Soudah
Date     = 19-03-2020
*/ 
echo"<html lang=\"en\">";
                        echo"<head>";
                            echo"<meta charset=\"UTF-8\">";
                            echo"<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
                            echo "<link href='../school/stylesheet/formstyle.css' rel='stylesheet'>";
                        echo"</head>";
                        


include("database/config.php"); // 1-stap   include files  
include("database/opendb.php");
if(isset($_POST["hobbies"])){ 
       $hobbies = $_POST["hobbies"]; 
}
$break="<br>";
$query = "SELECT id, firstname, lastname ";
$query .= "FROM persons ";
$query .= "WHERE hobbies = ? ";
//echo $query."<br>";
$preparedquery = $dbaselink->prepare($query);
$preparedquery->bind_param("i", $hobbies);
$preparedquery->execute();
if($preparedquery->errno){
    echo "error found";
} else {
    // get results   
      $result = $preparedquery->get_result();
    while($row = $result->fetch_assoc()){        
        // loop through the rows 
        echo "<table class='tableOver' border = 4px solid>"; 
        echo "<tr>";   
        echo "<td>";   
        echo "<a href=\"details.php?id=".$row['id']."\">"; echo $row['firstname'] . " " . $row['lastname']; echo "</a><br>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
    } 
}
$preparedquery->close();
include("database/closedb.php");
echo"<br>";
echo"<a href=\"index.html\">go back to index </a>";
    
?>
   

