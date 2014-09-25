<?php
        /*** if a user is logged in ***/
        if(isset($_SESSION['access_level']))
        {
                $log_link = 'logout.php';
                $log_link_name = 'Log Out';
        }
        else
        {
                $log_link = 'login.php';
                $log_link_name = 'Log In';
        }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PHPRO.ORG BLOG</title>
<style type="text/css">
.menu ul{
        color: green;
        list-style: none;
}
.menu ul li{
        padding:
        display: inline;
        float: left;
        padding: 2px 8px;
}

hr{
        clear: both;
}

</style>
</head>
<body>
<div class="menu">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="<?php echo $log_link; ?>"><?php echo $log_link_name; ?></a></li>
</ul>
<hr />