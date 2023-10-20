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

// Create an instance of the DataLayer
$dataLayer = new DataLayer();

// Create an instance for f3 object
$f3 = Base::instance();
$con = new Controller($f3);

// Define a default route for home
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});

// Define a home route for home
$f3->route('GET /home', function() {
    $GLOBALS['con']->home();
});

// Define a route to handle the form submission and summary display
$f3->route('GET|POST /form', function () {
    $GLOBALS['con']->studentForm();
});

$f3->route('GET|POST /summary', function () {
    $GLOBALS['con']->summary();
});

// Define a student-list route for student list
$f3->route('GET|POST /student-list', function() {
    $GLOBALS['con']->getStudentList();
});


// Run Fat-Free
$f3 -> run();

//this is a test to see if branching is working
