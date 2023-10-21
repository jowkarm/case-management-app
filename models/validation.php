<?php

/**
 * @auther Jo Cichon
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 * @auther Sayed Sadat
 *
 *
 * Created 10/20/2023
 * 355/case-management-app/models/validation.php
 * The Validation class for Tribal Pathways project
 */

class Validation
{
    /**
     * This function checks to see that a
     * string is all alphabetic (no numbers)
     * and not empty
     */
    static function validName($name)
    {
        $name = trim($name);

        if (empty($name)) {
            return false;
        }

        return preg_match('/^[A-Za-z\s]+$/', $name);
    }

    /**
     * This function checks to see
     * that an email address is valid.
     */
    static function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * This function validate the password
     * @param $password password
     * @return bool true if password is valid
     */
    static function validatePassword($password)
    {
        // Password length should be between 8 and 20 characters
        if (strlen($password) < 8 || strlen($password) > 20) {
            return false;
        }

        // Password should contain at least one uppercase letter,
        // one lowercase letter, one digit, and one special character
        if (!preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/\d/', $password) ||
            !preg_match('/[\W_]/', $password)) {
            return false;
        }

        // Password is valid
        return true;
    }

    /**
     * This function checks if the second password equals password
     * @param $password password
     * @param $confirmPassword second password
     * @return bool true is password equals confirmed password
     */
    static function validateConfirmPassword($password, $confirmPassword)
    {
        // Check if the password and confirm password match
        if ($password !== $confirmPassword) {
            return false;
        }

        // Confirm password is valid
        return true;
    }



}