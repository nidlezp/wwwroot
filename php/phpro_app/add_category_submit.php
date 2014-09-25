<?php
    error_reporting(E_ALL);

        /*** begin output buffering ***/
        ob_start();

        /*** include the header file ***/
        include 'includes/header.php';

        /*** check access level ***/
        if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] != 5)
        {
                header("Location: index.php");
                exit;
        }
        else
        {
        /*** check the form has been posted and the session variable is set ***/
        if(isset($_SESSION['form_token'], $_POST['form_token'], $_POST['blog_category_name']) && preg_match('/^[a-z][a-z\d_ ,]{2,49}$/i', $_POST['blog_category_name']) !== 0)
        {
            /*** if we are here, include the db connection ***/
            include 'includes/conn.php';

            /*** test for db connection ***/
            if($db)
            {
                /*** excape the string ***/
                $blog_category_name = mysql_real_escape_string($_POST['blog_category_name']);

                /*** the sql query ***/
                $sql = "INSERT INTO blog_categories (blog_category_name) VALUES ('{$blog_category_name}')";

                /*** run the query ***/
                if(mysql_query($sql))
                {
                    /*** unset the session token ***/
                    unset($_SESSION['form_token']);

                    echo 'Category Added';
                }
                else
                {
                    echo 'Category Not Added';
                }
            }
            else
            {
                echo 'Unable to process form';
            }
        }
        else
        {
            echo 'Invalid Submission';
        }
    }

    /*** flush the buffer ***/
    ob_end_flush();
?>