<?php
error_reporting(E_ALL);

/*** begin session ***/
session_start();

/*** include the header file ***/
include 'includes/header.php'; 

/*** an array to hold errors ***/
$errors = array();

/*** check the form has been posted and the session variable is set ***/
if(!isset($_SESSION['form_token']))
{
    $errors[] = 'Invalid Form Token';
}
/*** check all fields have been posted ***/
elseif(!isset($_POST['form_token'], $_POST['blog_user_name'], $_POST['blog_user_password'], $_POST['blog_user_password2'], $_POST['blog_user_email']))
{
    $errors[] = 'All fields must be completed';
}
/*** check the form token is valid ***/
elseif($_SESSION['form_token'] != $_POST['form_token'])
{
    $errors[] = 'You may only post once';
}
/*** check the length of the user name ***/
elseif(strlen($_POST['blog_user_name']) < 2 || strlen($_POST['blog_user_name']) > 25)
{
    $errors[] = 'Invalid User Name';
}
/*** check the length of the password ***/
elseif(strlen($_POST['blog_user_password']) <= 8 || strlen($_POST['blog_user_password']) > 25)
{
    $errors[] = 'Invalid Password';
}
/*** check the length of the users email ***/
elseif(strlen($_POST['blog_user_email']) < 4 || strlen($_POST['blog_user_email']) > 254)
{
    $errors[] = 'Invalid Email';
}
/*** check for email valid email address ***/
elseif(!preg_match("/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU", $_POST['blog_user_email']))
{
    $errors[] = 'Email Invalid';
}
else
{
    /*** escape all vars for database use ***/
    $blog_user_name = mysql_real_escape_string($_POST['blog_user_name']);
    /*** encrypt the password ***/
    $blog_user_password = sha1($_POST['blog_user_password']);
    $blog_user_password = mysql_real_escape_string($blog_user_password);
    /*** strip injection chars from email ***/
    $blog_user_email =  preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' , '', $_POST['blog_user_email'] );
    $blog_user_email = mysql_real_escape_string($blog_user_email);

    /*** if we are here, include the db connection ***/
    include 'includes/conn.php';

    /*** test for db connection ***/
    if($db)
    {
        /*** check for existing username and email ***/
        $sql = "SELECT
            blog_user_name,
            blog_user_email
            FROM
            blog_users
            WHERE
            blog_user_name = '{$blog_user_name}'
            OR
            blog_user_email = '{$blog_user_email}'";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
        if($row[0] == $blog_user_name)
        {
            $errors[] = 'User name is already in use';
        }
        elseif($row[1] == $blog_user_email)
        {
            $errors[] = 'Email address already subscribed';
        }
        else
        {

            /*** create a verification code ***/
            $verification_code = uniqid();

            /*** the sql query ***/
            $sql = "INSERT
                INTO
                blog_users(
                blog_user_name,
                blog_user_password,
                blog_user_email,
                blog_user_access_level,
                blog_user_status)
                VALUES (
                '{$blog_user_name}',
                '{$blog_user_password}',
                '{$blog_user_email}',
                1,
                '{$verification_code}')";

            /*** run the query ***/
            if(mysql_query($sql))
            {
                /*** unset the session token ***/
                unset($_SESSION[\form_token']);

                /*** email subject ***/
                $subject = 'Verification code';

                /*** email from ***/
                $from = 'test@phpro.org';

                /*** the message ***/
                $path = dirname($_SERVER['REQUEST_URI']);
                $message = "Click the link below to verify your subscription\n\n";
                $message .= 'http://'.$_SERVER['HTTP_HOST'].$path.'/verify.php?vc='.$verification_code;

                /*** set some headers ***/
                $headers = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHPRO MAIL';

                /*** send the email ***/
                if(!mail($blog_user_email, $subject, $message, $headers))
                {
                    $errors = 'Unable to send verification';
                }

                /*** unset the form token ***/
                unset($_SESSION['form_token']);
            }
            else
            {
                $errors[] = 'User Not Added';
            }
        }
    }
    else
    {
        $errors[] = 'Unable to process form';
    }
}

/*** check if there are any errors in the errors array ***/
if(sizeof($errors) > 0)
{
    foreach($errors as $err)
    {
        echo $err,'<br />';
    }
}
else
{
    echo 'Sign up complete<br />';
    echo 'A verification email has been sent to '.$blog_user_email;
}

/*** include the footer file ***/
include 'includes/footer.php';

?>