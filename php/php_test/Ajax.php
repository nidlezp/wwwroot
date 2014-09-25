<!DOCTYPE html>
<html>
<head>
<title>ASP Demo</title>
<link href="Site.css" rel="stylesheet">
</head>
<body>
<?php include("Header.php"); ?>
<div id="main">
<h1>Customers</h1>
<div id="t01"></div>
</div>

<script>
var xmlhttp;
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("t01").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","getCustomers.php",true);
xmlhttp.send();
</script>

</body>
</html>