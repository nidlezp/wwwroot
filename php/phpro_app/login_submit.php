<?php

    /*** begin output buffering ***/
    ob_start();

    /*** begin session ***/
    session_start();

    /*** check the form has been posted and the session variable is set ***/
    if(!isset($_SESSION['form_token']))
    {
        $location = 'login.php';
    }
    /*** check all fields have been posted ***/
    elseif(!isset($_POST['form_token'], $_POST['blog_user_name'], $_POST['blog_user_password']))
    {
        $location = 'login.php';
    }
    /*** check the form token is valid ***/
    elseif($_SESSION['form_token'] != $_POST['form_token'])
    {
        $location = 'login.php';
    }
    /*** check the length of the user name ***/
    elseif(strlen($_POST['blog_user_name']) < 2 || strlen($_POST['blog_user_name']) > 25)
    {
        $location = 'login.php';
    }
    /*** check the length of the password ***/
    elseif(strlen($_POST['blog_user_password']) < 8 || strlen($_POST['blog_user_password']) > 25)
    {
        $location = 'login.php';
    }
    else
    {
        /*** escape all vars for database use ***/
        $blog_user_name = mysql_real_escape_string($_POST['blog_user_name']);

        /*** encrypt the password ***/
        $blog_user_password = sha1($_POST['blog_user_password']);
        $blog_user_password = mysql_real_escape_string($blog_user_password);

        /*** if we are here, include the db connection ***/
        include 'includes/conn.php';

        /*** test for db connection ***/
        if($db)
        {
            /*** check for existing username and password ***/
            $sql = "SELECT
            blog_user_name,
            blog_user_password,
            blog_user_access_level
            FROM
            blog_users
            WHERE
            blog_user_name = '{$blog_user_name}'
            AND
            blog_user_password = '{$blog_user_password}'
            AND
            blog_user_status=1";
            $result = mysql_query($sql);
            if(mysql_num_rows($result) != 1)
            {
                $location = 'login.php';
            }
            else
            {
                /*** fetch result row ***/
                $row = mysql_fetch_row($result);

                /*** set the access level ***/
                $_SESSION['access_level'] = $row[2];

                /*** unset the form token ***/
                unset($_SESSION['form_token']);

                /*** send user to index page ***/
                $location = 'index.php';
            }
        }
    }

    /*** redirect ***/
    header("Location: $location");

    /*** flush the buffer ***/
    ob_end_flush();

?>