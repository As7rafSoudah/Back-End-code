<?php
/*
Filename = loader.php
Author   = Ashraf Soudah
Date     = 19-04-2020
*/

// include files
include("database/config.php");
include("database/opendb.php");


// create the table cities when necessary
$query = "CREATE TABLE IF NOT EXISTS cities (";
$query .= "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
$query .= "place VARCHAR(40), ";
$query .= "township VARCHAR(40), ";
$query .= "nickname VARCHAR(80) ";
$query .= ") ";

// prepare the query and execute it
$preparedquery = $dbaselink->prepare($query);
$preparedquery->execute();

// check for errors
if ($preparedquery->errno) {
echo "Aanmaken tabel mislukt";
} else {
echo "Tabel bestaat";
}
exit;

// release prepared statement
$preparedquery->close();
include("database/closedb.php");
