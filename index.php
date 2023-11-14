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
$f3->route('GET|POST /add-student', function () {
    $GLOBALS['con']->addStudent();
});

//Route to add-student-confirmation form
$f3->route('GET|POST /confirm', function () {
    $GLOBALS['con']->confirm();
});

$f3->route('GET|POST /summary', function () {
    $GLOBALS['con']->summary();
});

// Define a student-list route for student list
$f3->route('GET|POST /student-list', function() {
    $GLOBALS['con']->getStudentList();
});

// Define a signup route
$f3->route('GET|POST /signup', function() {
    $GLOBALS['con']->signup();
});

// Define a confirm-email route
$f3->route('GET /confirm-email', function() {
    $GLOBALS['con']->confirmEmail();
});

// Define a login route
$f3->route('GET|POST /login', function() {
    $GLOBALS['con']->login();
});

// Define a logout route
$f3->route('GET /logout', function() {
    $GLOBALS['con']->logout();
});

// Define a reports route
$f3->route('GET /reports', function() {
    $GLOBALS['con']->reports();
});

// Define a forgot-password route
$f3->route('GET|POST /forgot-password', function() {
    $GLOBALS['con']->forgotPassword();
});

// Define a reset-password route
$f3->route('GET|POST /reset-password', function() {
    $GLOBALS['con']->resetPassword();
});

// Define a student route
$f3->route('GET|POST /student', function() {
    $GLOBALS['con']->student();
});

// Define a student route
$f3->route('GET /confirm', function() {
    $GLOBALS['con']->confirm();
});


// Run Fat-Free
$f3 -> run();

