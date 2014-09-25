<html>
<body>

<?php
//error handler function
function customError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr";
}

//set error handler
set_error_handler("customError");

//trigger error
echo($test);
?>

<br>

<?php
$test=2;
if ($test>1) {
  trigger_error("Value must be 1 or below");
}
?>

<br>

<?php
if(!file_exists("welcome.txt")) {
  die("File not found");
} else {
  $file=fopen("welcome.txt","r");
}
?>


</body>
</html>