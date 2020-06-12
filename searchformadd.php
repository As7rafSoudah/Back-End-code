<?php

echo"<html lang='en'>";
echo"<head>";
    echo"<meta charset='UTF-8'>";
    echo"<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo"<title>search Id</title>";
echo"</head>"; 
echo"<body>";
    echo"<h1>Serach</h1>";
    echo " <form action='searchaddresult.php' method='POST'>";
    echo "<label>Type the ID number</label>";
    echo"<input type='text' name='id'>";
    echo"<input type='submit'>";
echo"</form>";
echo"</body>";
echo"</html>";
?>