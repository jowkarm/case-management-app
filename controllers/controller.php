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
        // Set the title of the page
        $this->_f3->set('title', 'Home');

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
//        // Only if a user is logged in can they add a student
//        if (!Validation::loggedIn($this->_f3)) {
//            $this->_f3->reroute('/login');
//        }

        //Initialize the variables
        $ctclink_id = "";
        $first_name = "";
        $middle_name = "";
        $last_name = "";
        $pronouns = "";
        $tribe = "";
        $cte_program = "";
        $email = "";
        $phone = "";
        $clothing_size = "";
        $course_history = "";
        $academic_progress = "";
        $finances = "";
        $notes = "";


        //If the form has posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // Retrieve data from the form fields
            if(isset($_POST['ctclink_id'])) {$ctclink_id = $_POST['ctclink_id'];}
            if(isset($_POST['first_name'])) {$first_name = $_POST['first_name'];}
            if(isset($_POST['middle_name'])) {$middle_name = $_POST['middle_name'];}
            if(isset($_POST['last_name'])) {$last_name = $_POST['last_name'];}
            if(isset($_POST['pronouns'])) {$pronouns = $_POST['pronouns'];}
            if(isset($_POST['tribe'])) {$tribe = $_POST['tribe'];}
            if(isset($_POST['cte_program'])) {$cte_program = $_POST['cte_program'];}
            if(isset($_POST['email'])) {$email = $_POST['email'];}
            if(isset($_POST['phone'])) {$phone = $_POST['phone'];}
            if(isset($_POST['clothing_size'])) {$clothing_size = $_POST['clothing_size'];}
            if(isset($_POST['course_history'])) {$course_history = $_POST['course_history'];}
            if(isset($_POST['academic_progress'])) {$academic_progress = $_POST['academic_progress'];}
            if(isset($_POST['finances'])) {$finances = $_POST['finances'];}
            if(isset($_POST['notes'])) {$notes = $_POST['notes'];}

            // Validate the data
            // Validate the first name
            if(empty($fName) || !Validation::validName($first_name)) {
                $this->_f3->set('errors["fName]', 'Invalid name entered');
            }

            /* TODO Allow middle name to be blank
            Validate the middle name
            if(empty($mName)) {
            } elseif(!Validation::validName($middle_name)) {
                $this->_f3->set('errors["mName]', 'Invalid name entered');
            }*/

            // Validate the last name
            if(empty($lName) || !Validation::validName($last_name)) {
                $this->_f3->set('errors["lName]', 'Invalid name entered');
            }

            // Validate the pronoun selected
            if(!Validation::validatePronouns($pronouns)) {
                $this->_f3->set('errors["pronouns"]', 'Invalid pronouns selected');
            }

            // Validate the tribe selected
            if(!Validation::validateTribe($tribe)) {
            $this->_f3->set('errors["tribe"]', 'Invalid tribe selected');
            }

            // Validate the cte program selected
            if(!Validation::validateCTEProgram($cte_program)) {
            $this->_f3->set('errors["cte_program"]', 'Invalid CTE program selected');
            }

            // Validate the clothing size selected
            if(!Validation::validateClothingSize($clothing_size)) {
                $this->_f3->set('errors["clothing_size"]', 'Invalid clothing size selected');
            }

            // Store data in the F3 framework session
            $this->_f3->set('SESSION.ctclink_id', $ctclink_id);
            $this->_f3->set('SESSION.first_name', $first_name);
            $this->_f3->set('SESSION.middle_name', $middle_name);
            $this->_f3->set('SESSION.last_name', $last_name);
            $this->_f3->set('SESSION.pronouns', $pronouns);
            $this->_f3->set('SESSION.tribe', $tribe);
            $this->_f3->set('SESSION.cte_program', $cte_program);
            $this->_f3->set('SESSION.email', $email);
            $this->_f3->set('SESSION.phone', $phone);
            $this->_f3->set('SESSION.clothing_size', $clothing_size);
            $this->_f3->set('SESSION.course_history', $course_history);
            $this->_f3->set('SESSION.academic_progress', $academic_progress);
            $this->_f3->set('SESSION.finances', $finances);
            $this->_f3->set('SESSION.notes', $notes);

            // Redirect to the confirmation page
            $this->_f3->reroute('/confirm');
        }

        // Set the title of the page
        $this->_f3->set('title', 'Add a Student');

        // Display the form
        $view = new Template();
        echo $view->render('views/student-profile/add-student.html');
    }

    /**
     * Controller for the summary route
     */
    function summary()
    {
        // Set the title of the page
        $this->_f3->set('title', 'Summary');

        // Display a summary view
        $view = new Template();
        echo $view->render('views/student-profile/summary.html');

        session_destroy();
    }

    /**
     * Controller for the add-student-confirm route
     */
    function confirm()
    {
        // Set the title of the page
        $this->_f3->set('title', 'Confirm');

        // Display add-student-confirmation view
        $view = new Template();
        echo $view->render('views/student-profile/add-student-confirm.html');

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

        // Set the title of the page
        $this->_f3->set('title', 'Students List');

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

        // Set the title of the page
        $this->_f3->set('title', 'Signup');

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

        // Set the title of the page
        $this->_f3->set('title', 'Login');


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
        // Set the title of the page
        $this->_f3->set('title', 'Reports');

        // Define a view page
        $view = new Template();
        echo $view->render('views/reports/reports.html');

    }

    /**
     * Controller for the forgot-password route
     */

    function forgotPassword()
    {
        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get the data
            $email = (isset($_POST['email'])) ? $_POST['email'] : '';

            // *** If email is not valid, set an error variable
            if (!Validation::validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Invalid email entered');
            }


            // Redirect to home route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {

                $uuid = $GLOBALS['dataLayer']->passwordResetLink($email);
                $send_email = SendEmail::sendPasswordResetLink($email, 'info@case-management-app.com', $uuid, $this->_f3);
                if($send_email){
                    $alert = new Alert('Check your email for password reset link.', 'yellow');
                    $this->_f3->set('SESSION.alert', $alert);
                }

                $this->_f3->reroute('/');
            }

        }

        // Set the title of the page
        $this->_f3->set('title', 'Forgot Password');


        // Define a view page
        $view = new Template();
        echo $view->render('views/login/forgot-password.html');
    }

    /**
     * Controller for the reset-password route
     */
    function resetPassword()
    {
        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            // Get data
            $password = (isset($_POST['password'])) ? $_POST['password'] : '';
            $confirm_password = (isset($_POST['confirmPassword'])) ? $_POST['confirmPassword'] : '';

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

                $GLOBALS['dataLayer']->updatePassword($_POST['uuid'], $password);

                $alert = new Alert('Your password is updated successfully.', 'green');
                $this->_f3->set('SESSION.alert', $alert);

                $this->_f3->reroute('/');
            }

        }

        if(!isset($_GET['uuid'])){
            //Redirect to the default route
            $this->_f3->reroute('/');
        }

        $uuid = $_GET['uuid'];
        $result = $GLOBALS['dataLayer']->checkUuidExpirationTime($uuid);

        if(!$result){
            $alert = new Alert('Your password reset link is expired.', 'red');
            $this->_f3->set('SESSION.alert', $alert);
        } else {
            $this->_f3->set('uuid', $uuid);
        }

        // Set the title of the page
        $this->_f3->set('title', 'Reset Password');


        // Define a view page
        $view = new Template();
        echo $view->render('views/login/reset-password.html');

        // Unset (clear) the session variable
        $this->_f3->set('SESSION.alert', null);
    }

    /**
     * ToDo: Complete this controller
     * Controller for the student route
     */
    function student()
    {
        // Set the title of the page
        $this->_f3->set('title', 'Student');

        // Define a view page
        $view = new Template();
        echo $view->render('views/student-profile/student.html');


    }
}