<html>
<body>

<?php
require_once(__DIR__ . '/../php-console-master/src/PhpConsole/__autoload.php');
// Call debug from PhpConsole\Handler
$handler = PhpConsole\Handler::getInstance();
$handler->start();
?>

<div class="menu">
<?php include 'menu.php';?>
</div>

<h1>Welcome to my home page!</h1>
<p>Some text.</p>
<p>Some more text.</p>

<?php include 'vars.php';
echo "I have a $color $car.";
?>

<?php require 'noFileExists.php';
echo "I have a $color $car.";
?>





<?php include 'footer.php';?>

</body>
</html>