<?php
/*
Filename = list.php
Author   = Ashraf Soudah
Date     = 20-04-2020
*/

// include files
include("database/config.php");
include("database/opendb.php");

// HTML code
// // connect HTML with CSS
echo "<html lang=\"en\">";
echo "<head>";
    echo "<meta charset=\"UTF-8\">";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    echo "<link href=\"../school/stylesheet/style2.css\" rel='stylesheet'>";
echo"</head>";

// get the start
$start = 0;

if (isset($_GET["start"])) {
$start = $_GET["start"];
}
 if ($start == "") {
 $start = 0;
 }

// compose the SQL command
$query  = "SELECT id, place, township, nickname ";
$query .= "FROM cities ";
$query .= "LIMIT 10 OFFSET ? ";

// prepare the statement, bind parameters and execute the SQL command
$preparedquery = $dbaselink->prepare($query);
$preparedquery->bind_param("i",$start);

// Execute the command
$preparedquery->execute();

// Check for errors
if ($preparedquery->errno) {
    echo "Error executing command";
} else {
    // Read result
    $result = $preparedquery->get_result();
    echo "<body>";
    echo "<table border = 1px sloid>";

    // fetch a row and put it in an associative array
    while($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['place'] . "</td>";
        echo "<td>" . $row['township'] . "</td>";
        echo "<td>" . $row['nickname'] . "</td>";

        echo "</tr>";
    }
};
echo "</table>";
echo "<br>";

// close the statement
$preparedquery->close();

// calculate the count(total):
// compose the SQL command
$query = "SELECT COUNT(id) AS amount ";
$query .= "FROM cities ";

// prepare the statement, bind parameters and execute the SQL command
$preparedquery = $dbaselink->prepare($query);

// Execute the command
$preparedquery->execute();

// Check for errors
if ($preparedquery->errno) {
    echo "user  name  doesn't exist";
} else {
    $result = $preparedquery->get_result();
    if ($result->num_rows === 0) {
        echo "no rows found. " . "<br>";
    } else {
        while($row = $result->fetch_assoc()) {
            $count=$row['amount'] ;
            echo "Er zijn ($count) rijen gevonden.<br><br> ";
        }
    };
}

// close the statement
$preparedquery->close();

// variables
$next = $start+10;
$previous = $start-10;
// $End = $count-4;
$End = $count - ($count % 10);


// condition
if ($next > $count ) {
    echo "[\"Finish, you can not continue\"].";
    echo "<div class='linkGo'>";
    echo "<br><a href=\"list.php?start=" . $previous ."\"><=Previous </a><br><br>";
    echo "<a href=\"list.php?start=0\">Back To The Beginning</a>";
    echo "</div>";
} else {

    if ($start > 0) {
        echo "<div class='linkGo'>";
        echo "<a href=\"list.php?start=" . $previous . "\"><=Previous </a>";
        echo "<a href=\"list.php?start=" . $next . "\"> =>Next </a>";
        echo "</div>";
    } else {
        echo "<div class='linkGo'>";
        echo "<a href=\"list.php?start=" . $next . "\"> =>Next </a><br><br>";
        echo "<a href=\"list.php?start=$End\">Go To The End</a>";
        echo "</div>";
    }
}

// close the database
include("database/closedb.php");

// go to the index
echo "<br>";
echo "<div class='linkGo'>";
echo "<a href=\"index.html\">Go Back To Index</a>";
echo "</div>";
