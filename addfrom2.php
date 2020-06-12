<?php
/*
 * Filename: updateform.php
 * Date: 11-04-2019
 * Author: Ashraf Soudah
 */

echo"<html lang=\"en\">";
echo"<head>";
echo"<meta charset=\"UTF-8\">";
echo"<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
echo"<title>search</title>";
echo"</head>";
echo"<body>";
echo"<h1>Update</h1>";
echo " <form action=\"addresult.php\" method=\"POST\">";
echo "<table>";
echo"<tr>";
echo "<td><label >Update id </label></td>";
echo"<td><input type=\"text\" name=\"ID\"> </td>";  // bel me tamam
echo"</tr>";  
echo"<tr>";
echo "<td><label >type your firstname</label>  </td>";
echo"<td><input type=\"text\" name=\"firstname\"></td>";   
echo"</tr>"; 
echo"<tr>";
echo "<td><label >type your lastname</label></td> ";
echo"<td><input type=\"text\" name=\"lastname\"> </td>";
echo"</tr>";
echo"<tr>";
echo "<td><label >type your email</label></td> ";
echo"<td><input type=\"text\" name=\"email\"> </td>";
echo"</tr>";
echo"<tr>";
echo "<td><label >type your password</label></td> ";
echo"<td><input type=\"text\" name=\"password\"> </td>";
echo"</tr>";
echo"<tr>";
echo "<td><label >type your hobbies</label></td>";
echo"<td><input type=\"text\" name=\"hobbies\"> </td>";
echo"</tr>";
echo"<tr>";
echo "<td><label >type your pillows</label></td>";
echo"<td><input type=\"text\" name=\"pillows\"></td>";
echo"</tr>";
echo"<tr>";
echo " <td><label >type your desc</label></td>";
echo"<td><input type=\"text\" name=\"description\"> </td>";
echo"</tr>";
echo"<tr>";
echo"<td>&nbsp;</td>";
echo"<td><input type=\"submit\" value=\"send\"> </td>";
echo"</tr>";
echo"</form>";
echo"</tabel>";
echo"</body>";
echo"</html>";
