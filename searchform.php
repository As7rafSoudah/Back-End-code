<?php
/* 
Filename = searchform.php 
Author   = Ashraf Soudah
Date     = 19-03-2020
*/ 

echo"<html lang='en'>";
echo"<head>";
    echo"<meta charset='UTF-8'>";
    echo"<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo"<title>search</title>";
echo"</head>"; 
echo"<body>";
    echo"<h1>Serach</h1>";
    echo " <form action='searchresult.php' method='POST'>";
    echo "<label>Type the hobby number</label>";
    echo"<input type='text' name='hobbies'>";
    echo"<input type='submit'>";
echo"</form>";
echo"</body>";
echo"</html>";
?>