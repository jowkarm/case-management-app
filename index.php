<?php
/**
 * @auther Jo Cichon
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 * @auther Sayed Sadat
 *
 *
 * Created 10/6/2023
 * 355/case-management-app/index.php
 * Index Controller for Tribal Pathways project
 */


// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

// Create an instance for f3 object
$f3 = Base::instance();
$con = new Controller($f3);

// Define a default route for home
$f3->route('GET /home', function() {
    $GLOBALS['con']->home();
});

// Define a route to handle the form submission and summary display
$f3->route('GET|POST /studentForm', function ($f3) {
    $GLOBALS['con']->studentForm();
});

$f3->route('GET /summary', function () {
    $GLOBALS['con']->summary();
});


// Run Fat-Free
$f3 -> run();

//this is a test to see if branching is working
