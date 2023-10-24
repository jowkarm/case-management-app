<?php

/**
 * @auther Jo Cichon
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 * @auther Sayed Sadat
 *
 *
 * Created 10/6/2023
 * 355/case-management-app/controllers/controller.php
 * Controllers for Tribal Pathways project
 */
class Controller
{
    //F3 object
    private $_f3;


    /**
     * Constructor for the class.
     * @param Object $f3 The Fat-Free Framework object.
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Controller for the home route
     */
    function home()
    {
        // Define a view page
        $view = new Template();
        echo $view->render('views/home.html');

        // Unset (clear) the session variable
        $this->_f3->set('SESSION.alert', null);
    }

    /**
     * Controller for the form route
     */
    function addStudent()
    {

        // Process the form submission
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Retrieve data from the form fields
            $studentID = $_POST['studentID'];
            $name = $_POST['name'];
            $pronouns = $_POST['pronouns'];
            $tribe = $_POST['tribe'];
            $clothingSize = $_POST['clothingSize'];
            $courseHistory = $_POST['courseHistory'];
            $academics = $_POST['academics'];
            $finances = $_POST['finances'];
            $caseNotes = $_POST['caseNotes'];

            // Store data in the F3 framework session
            $this->_f3->set('SESSION.studentID', $studentID);
            $this->_f3->set('SESSION.name', $name);
            $this->_f3->set('SESSION.pronouns', $pronouns);
            $this->_f3->set('SESSION.tribe', $tribe);
            $this->_f3->set('SESSION.clothingSize', $clothingSize);
            $this->_f3->set('SESSION.courseHistory', $courseHistory);
            $this->_f3->set('SESSION.academics', $academics);
            $this->_f3->set('SESSION.finances', $finances);
            $this->_f3->set('SESSION.caseNotes', $caseNotes);


            // Redirect to the summary page
            $this->_f3->reroute('/summary');
        }

        // Display the form
        $view = new Template();
        echo $view->render('views/student-profile/add-student.html');
    }

    /**
     * Controller for the summary route
     */
    function summary()
    {
        // Display a summary view
        $view = new Template();
        echo $view->render('views/student-profile/summary.html');

        session_destroy();
    }

    /**
     * Controller for the student-list route
     */
    function getStudentList()
    {

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Get the data
            $search = (isset($_POST['search'])) ? $_POST['search'] : '';

            $this->_f3->set('SESSION.search', $search);
            $students = $GLOBALS['dataLayer']->search($this->_f3->get('SESSION.search'));

            $this->_f3->set('SESSION.students', $students);

            // Set the title of the page
            $this->_f3->set('title', "Search Results");

        } else {
            $students = $GLOBALS['dataLayer']->getAllStudents();

            $this->_f3->set('SESSION.students', $students);

            // Set the title of the page
            $this->_f3->set('title', "Students List");
        }

        // Display a student-list view
        $view = new Template();
        echo $view->render('views/student-profile/student-list.html');

        // Unset (clear) the session variable
        $this->_f3->set('SESSION.search', null);
    }

    /**
     * Controller for the signup route
     */
    function signup()
    {

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // Get the data
            $first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
            $last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $password = (isset($_POST['password'])) ? $_POST['password'] : '';
            $confirm_password = (isset($_POST['confirmPassword'])) ? $_POST['confirmPassword'] : '';

            // *** If first name is not valid, set an error variable
            if (!Validation::validName($first_name)) {
                $this->_f3->set('errors["first_name"]', 'Invalid first name entered');
            }

            // *** If last name is not valid, set an error variable
            if (!Validation::validName($last_name)) {
                $this->_f3->set('errors["last_name"]', 'Invalid last name entered');
            }

            // *** If email is not valid, set an error variable
            if (!Validation::validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Invalid email entered');
            }


            // *** If password is not valid, set an error variable
            if (!Validation::validatePassword($password)) {
                $this->_f3->set('errors["password"]', 'Password length should be between 8 and 20 characters and 
                contains at least one uppercase letter, one lowercase letter, one digit, and one special character');
            }

            // *** If confirm_password is not valid, set an error variable
            if (!Validation::validateConfirmPassword($password, $confirm_password)) {
                $this->_f3->set('errors["confirm_password"]', 'The passwords must match');
            }

            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {

                // check if this user exists in the database
                $check_user = $GLOBALS['dataLayer']->getUserByEmail($email);
                if ($check_user !== false) {
                    $alert = new Alert('You have signed up before!', 'yellow');
                    $this->_f3->set('SESSION.alert', $alert);
                } else {
                    $user = new User($first_name, $last_name, $email, $password);
                    $user_id = $GLOBALS['dataLayer']->insertUser($user);
                    $user = $GLOBALS['dataLayer']->getUser($user_id);
                    $to = $user->getEmail();
                    $uuid = $user->getUuid();
                    $send_email = SendEmail::sendConfirmLink($to, 'info@case-management-app.com', $uuid, $this->_f3);
                    if ($send_email) {
                        $alert = new Alert('Confirm your email address!', 'yellow');
                        $this->_f3->set('SESSION.alert', $alert);
                    }

                }
                $this->_f3->reroute('/');
            }
        }



        // Define a view page
        $view = new Template();
        echo $view->render('views/login/signup.html');

        // Unset (clear) the session variable
        $this->_f3->set('SESSION.alert', null);
    }

    /**
     * Controller for the confirm-email route
     */
    function confirmEmail()
    {
        if (!isset($_GET['uuid'])) {
            //Redirect to the default route
            $this->_f3->reroute('/');
        }

        $uuid = $_GET['uuid'];
        $result = $GLOBALS['dataLayer']->confirmEmail($uuid);


        if ($result) {
            $alert = new Alert('Your email address is confirmed.', 'green');
            $this->_f3->set('SESSION.alert', $alert);
        }
        $this->_f3->reroute('/');
    }

    /**
     * Controller for the login route
     */
    function login()
    {

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // Get data
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';
            $raw_password = (isset($_POST['password'])) ? $_POST['password'] : '';
            $email = trim($email);


            // *** If email is not valid, set an error variable
            if (!Validation::validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Invalid email entered');
            }


            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {
                $user = $GLOBALS['dataLayer']->getUserByEmail($email);

                // check if this user exists in the database
                if ($user === false) {
                    $alert = new Alert('You have not signed up yet! Please sign up.', 'red');
                    $this->_f3->set('SESSION.alert', $alert);

                    $this->_f3->reroute('/signup');

                } else {
                    $hashed_password = $user->getPassword();

                    // Verify password
                    if (!password_verify($raw_password, $hashed_password)) {
                        $this->_f3->set('errors["password"]', 'Wrong password entered');
                    } else {
                        $this->_f3->set('SESSION.user', $user);
                        $this->_f3->reroute('/');
                    }
                }
            }
        }

        // Define a view page
        $view = new Template();
        echo $view->render('views/login/login.html');
    }

    /**
     * Controller for the logout route
     */
    function logout()
    {
        session_start();

        // if the user does not log in, do not show alert
        if($this->_f3->get('SESSION.user') == null){
            $this->_f3->reroute('/');
        }

        // Destroys session array
        session_destroy();

        $alert = new Alert('You logged out successfully!', 'green');
        $this->_f3->set('SESSION.alert', $alert);

        $this->_f3->reroute('/');
    }

    /**
     * Controller for the reports route
     */
    function reports()
    {
        // Define a view page
        $view = new Template();
        echo $view->render('views/reports/reports.html');

    }
}