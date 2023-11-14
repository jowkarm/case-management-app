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
        $name = strip_tags($name);

        /*if (empty($name)) {
            return false;
        }*/ // does not work with middle name validation since middle name should be optional

        return preg_match('/^[A-Za-z\s\-]+$/', $name);
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

    /**
     * Checks to ensure a user is logged into the webpage
     */
    static function loggedIn($f3)
    {
        return !empty($f3->get('SESSION.user'));
    }

    static function validPronoun($pronoun)
    {
        return (!empty($pronoun) && in_array($pronoun, DataLayer::getPrononoun()));
    }

    static function validSortingOptions($sortType)
    {
        return (in_array($sortType, (new DataLayer)->getSortOptions()));
    }
}