<?php 
/* 
  Filename = closedb.php 
  Author   = Ashraf Soudah
  Date     = 18-03-2020
*/

if (is_bool($result) === false) {
    mysqli_free_result($result);
}


mysqli_close($dbaselink);