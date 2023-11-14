<?php

/**
 * @auther Jo Cichon
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 * @auther Sayed Sadat
 *
 *
 * Created 10/20/2023
 * 355/case-management-app/models/send-email.php
 * The SendEmail class for Tribal Pathways project
 * contains methods for sending different types of emails
 */
class SendEmail
{
    /**
     * This function email the confirmation link for new users
     *
     * @param $to destenation address
     * @param $from sender email
     * @param $uuid uuid
     * @param $f3 fat free instance
     * @return true if email has sent
     */
    static function sendConfirmLink($to, $from, $uuid, $f3)
    {
        $baseDomain = $f3->get('BASE');
        $approve_link = 'https://' . $_SERVER['HTTP_HOST'] . $baseDomain . '/confirm-email?uuid=' .  $uuid;


        // Send as an email
        $subject = "Confirm your email address" ;

        $message = "
        <html>
        <head>
        <title>Confirm your email address</title>
        </head>
        <body>
        <p>You have registered in the Tribal Pathways Case Management website.</p>

        <br>
        <br>
        <p>To confirm your email address click on the link below:</p>
        <p><a href='" . $approve_link . "'>" . $approve_link . "</a></p>
        </body>
        </html>";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <' . $from . '>' . "\r\n";


        mail($to,$subject,$message,$headers);

        return true;
    }


    /**
     * This function email the password reset link.
     *
     * @param $to destenation address
     * @param $from sender email
     * @param $uuid uuid
     * @param $f3 fat free instance
     * @return true if email has sent
     */
    static function sendPasswordResetLink($to, $from, $uuid, $f3)
    {
        $baseDomain = $f3->get('BASE');
        $approve_link = 'https://' . $_SERVER['HTTP_HOST'] . $baseDomain . '/reset-password?uuid=' .  $uuid;


        // Send as an email
        $subject = "Password reset link" ;

        $message = "
        <html>
        <head>
        <title>Password reset link</title>
        </head>
        <body>
        <p>You have requested the password reset link.</p>

        <br>
        <br>
        <p>To reset your password click on the link below:</p>
        <p><a href='" . $approve_link . "'>" . $approve_link . "</a></p>
        </body>
        </html>";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <' . $from . '>' . "\r\n";


        mail($to,$subject,$message,$headers);

        return true;
    }
}