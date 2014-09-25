<?php
        /*** check if verification code is present ***/
    if(!isset($_GET['vc']))
    {
        $error = 'Invalid Verification Code';
    }
        /*** check verification code is a string of 13 chars ***/
    elseif(strlen($_GET['vc']) != 13)
    {
        $error = 'Verification Code Invalid';
    }
    else
    {
        /*** escape the code ***/
        $blog_verification_code = mysql_real_escape_string($_GET['vc']);

        /*** include the database connection ***/
        include 'includes/conn.php';

        /*** check for a valid connection ***/
        if($db)
        {
            /*** the update SQL ***/
            $sql = "UPDATE
                blog_users
                SET
                blog_user_status=1
                WHERE
                blog_user_status='{$blog_verification_code}'";

            /*** run the query ***/
            $result = mysql_query($sql);

                        /*** check for affected rows ***/
            if(mysql_affected_rows($link) != 1)
            {
                $message = 'Unable to verify';
            }
            else
            {
                $message = 'Verification Complete, please log in to submit blog';
            }    
        }
    }
?>
<h1>Verification</h1>

<p><?php echo $message; ?></p>