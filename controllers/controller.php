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

        if ($this->_f3->get('SESSION.user') == null) {
            $this->_f3->reroute('/login');
        } else {
            echo $view->render('views/home.html');
        }


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
        $tribe_name = "";
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

            if (isset($_POST['ctclink_id'])) {
                $ctclink_id = $_POST['ctclink_id'];
            }
            if (isset($_POST['first_name'])) {
                $first_name = $_POST['first_name'];
            }
            if (isset($_POST['middle_name'])) {
                $middle_name = $_POST['middle_name'];
            }
            if (isset($_POST['last_name'])) {
                $last_name = $_POST['last_name'];
            }
            if (isset($_POST['pronouns'])) {
                $pronouns = $_POST['pronouns'];
            }
            if (isset($_POST['tribe_name'])) {
                $tribe_name = $_POST['tribe_name'];
            }
            if (isset($_POST['cte_program'])) {
                $cte_program = $_POST['cte_program'];
            }
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            }
            if (isset($_POST['phone'])) {
                $phone = $_POST['phone'];
            }
            if (isset($_POST['clothing_size'])) {
                $clothing_size = $_POST['clothing_size'];
            }
            if (isset($_POST['course_history'])) {
                $course_history = $_POST['course_history'];
            }
            if (isset($_POST['academic_progress'])) {
                $academic_progress = $_POST['academic_progress'];
            }
            if (isset($_POST['finances'])) {
                $finances = $_POST['finances'];
            }
            if (isset($_POST['notes'])) {
                $notes = $_POST['notes'];
            }


            // Validate the data
            // Validate the first name
            if (empty($fName) || !Validation::validName($first_name)) {
                $this->_f3->set('errors["fName]', 'Invalid name entered');
            }

            /* TODO Allow middle name to be blank
            Validate the middle name
            if(empty($mName)) {
            } elseif(!Validation::validName($middle_name)) {
                $this->_f3->set('errors["mName]', 'Invalid name entered');
            }*/

            // Validate the last name
            if (empty($lName) || !Validation::validName($last_name)) {
                $this->_f3->set('errors["lName]', 'Invalid name entered');
            }

            // Validate the pronoun selected

            if (!Validation::validatePronouns($pronouns)) {
                $this->_f3->set('errors["pronouns"]', 'Invalid pronouns selected');
            }

            // Validate the tribe selected
            if (!Validation::validateTribe($tribe_name)) {
                $this->_f3->set('errors["tribe"]', 'Invalid tribe selected');
            }

            // Validate the cte program selected
            if (!Validation::validateCTEProgram($cte_program)) {
                $this->_f3->set('errors["cte_program"]', 'Invalid CTE program selected');
            }

            // Validate the clothing size selected
            if (!Validation::validateClothingSize($clothing_size)) {
                $this->_f3->set('errors["clothing_size"]', 'Invalid clothing size selected');
            }

            // Store data in the F3 framework session
            $this->_f3->set('SESSION.ctclink_id', $ctclink_id);
            $this->_f3->set('SESSION.first_name', $first_name);
            $this->_f3->set('SESSION.middle_name', $middle_name);
            $this->_f3->set('SESSION.last_name', $last_name);
            $this->_f3->set('SESSION.pronouns', $pronouns);
            $this->_f3->set('SESSION.tribe_name', $tribe_name);
            $this->_f3->set('SESSION.cte_program', $cte_program);
            $this->_f3->set('SESSION.email', $email);
            $this->_f3->set('SESSION.phone', $phone);
            $this->_f3->set('SESSION.clothing_size', $clothing_size);
            $this->_f3->set('SESSION.course_history', $course_history);
            $this->_f3->set('SESSION.academic_progress', $academic_progress);
            $this->_f3->set('SESSION.finances', $finances);
            $this->_f3->set('SESSION.notes', $notes);

            //if there are no errors
            //TODO add error array conditional here!

                // Redirect to the confirmation page
                $this->_f3->reroute('/confirm');

        }

        // Set arrays
        $this->_f3->set('programs', $GLOBALS['dataLayer']->getCTEPrograms());
        $this->_f3->set('sizes', $GLOBALS['dataLayer']->getSizes());
        $this->_f3->set('pronouns', $GLOBALS['dataLayer']->getPronouns());
        $this->_f3->set('tribes', $GLOBALS['dataLayer']->getTribes());

        // Set the title of the page
        $this->_f3->set('title', 'Add a Student');

        // Display the form
        $view = new Template();
        echo $view->render('views/student-profile/add-student.html');
    }


    /**
     * Controller for the add-student-confirm route
     */
    function confirm()
    {
        // Set the title of the page
        $this->_f3->set('title', 'Confirm');

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $alert = new Alert('A new student has been added!', 'green');
                $this->_f3->set('SESSION.alert', $alert);
                $this->_f3->reroute('/');
        }

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
        if ($this->_f3->get('SESSION.user') == null) {
            $this->_f3->reroute('/');
        }

        // Destroys session array
        session_destroy();

        /*$alert = new Alert('You logged out successfully!', 'green');
        $this->_f3->set('SESSION.alert', $alert);*/

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


    function case_log()
    {

        // Only if a user is logged in can they add a student
//        if (!Validation::loggedIn($this->_f3)) {
//            $this->_f3->reroute('/login');
//        }


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Get the data
            $sortBy = (isset($_POST['sort'])) ? $_POST['sort'] : '';

            if (Validation::validSortingOptions($sortBy)) {
                $this->_f3->set('SESSION.sort', $sortBy);

                $notes = $GLOBALS['dataLayer']->getSortedCaseNotes($this->_f3->get('SESSION.sort'));
                // Get the data from the model and add to a new card
                $this->_f3->set('SESSION.notes', $notes);
            } else {
                $this->_f3->set('errors["sortBy"]', 'Invalid Selection');
            }
        } else {
            $notes = $GLOBALS['dataLayer']->getAllCaseNotes();

            $this->_f3->set('SESSION.notes', $notes);
        }

        // Set the title of the page

        $this->_f3->set('title', 'Case Log');


        // View page for all cases
        $view = new Template();
        echo $view->render('views/reports/case-log.html');
    }

    function add_note()
    {
        // Only if a user is logged in can they add a student
//        if (!Validation::loggedIn($this->_f3)) {
//            $this->_f3->reroute('/login');
//        }

        // Next Case ID in the Notes table
        $this->_f3->set('case_number', $GLOBALS['dataLayer']->getNextCaseId());


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Get the data
            $student_id = (isset($_POST['ctclink_id'])) ? $_POST['ctclink_id'] : '';
            /*$first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
            $middle_name = (isset($_POST['middle_name'])) ? $_POST['middle_name'] : '';
            $last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';*/
            $due_date = (isset($_POST['due_date'])) ? $_POST['due_date'] : '';
            $subject = (isset($_POST['subject'])) ? $_POST['subject'] : '';
            $note = (isset($_POST['caseNote'])) ? $_POST['caseNote'] : '';
            $emotional_indicator = (isset($_POST['emotional_indicator'])) ? $_POST['emotional_indicator'] : '';

            // Validate Emotional Indicator
            if($emotional_indicator < 0 || $emotional_indicator > 360){
                $this->_f3->set('errors["emotional_indicator"]', 'Invalid Emotion Entered');
            }

            switch ($emotional_indicator) {
                case $emotional_indicator <= 25.7:
                    $emotional_indicator = "peace";
                    break;
                case $emotional_indicator > 25.7 && $emotional_indicator <= 51.4:
                    $emotional_indicator = "gratitude";
                    break;
                case $emotional_indicator > 51.4 && $emotional_indicator <= 77.1:
                    $emotional_indicator = "kindness";
                    break;
                case $emotional_indicator > 77.1 && $emotional_indicator <= 102.8:
                    $emotional_indicator = "enthusiasm";
                    break;
                case $emotional_indicator > 102.8 && $emotional_indicator <= 128.5:
                    $emotional_indicator = "optimism";
                    break;
                case $emotional_indicator > 128.5 && $emotional_indicator <= 154.2:
                    $emotional_indicator = "hope";
                    break;
                case $emotional_indicator > 154.2 && $emotional_indicator <= 179.9:
                    $emotional_indicator = "apathy";
                    break;
                case $emotional_indicator > 179.9 && $emotional_indicator <= 205.6:
                    $emotional_indicator = "annoyance";
                    break;
                case $emotional_indicator > 205.6 && $emotional_indicator <= 231.3:
                    $emotional_indicator = "worry";
                    break;
                case $emotional_indicator > 231.3 && $emotional_indicator <= 257:
                    $emotional_indicator = "anxiety";
                    break;
                case $emotional_indicator > 257 && $emotional_indicator <= 282.7:
                    $emotional_indicator = "sadness";
                    break;
                case $emotional_indicator > 282.7 && $emotional_indicator <= 308.4:
                    $emotional_indicator = "jealousy";
                    break;
                case $emotional_indicator > 308.4 && $emotional_indicator <= 334.1:
                    $emotional_indicator = "hatred";
                    break;
                case $emotional_indicator > 334.1:
                    $emotional_indicator = "fear";
                    break;
            }

            $students = $GLOBALS['dataLayer']->getAllStudents();
            //echo var_dump($students);

            // Validate Student ID
            foreach ($students as $row) {
                if($row->getCtclinkId() == $student_id) {
                    $this->_f3->set('errors["student_id"]', 'Student ID found');
                    $this->_f3->clear('errors["student_id"]');
                    $student = $row;
                    break;
                } else {
                    $this->_f3->set('errors["student_id"]', 'This ID does not exist');
                }
            }

            /*// Validate First Name
            if(!empty($first_name)) {
                if(!Validation::validName($first_name)) {
                    $this->_f3->set('errors["first_name"]', 'Invalid name entered');

                } else {

                }
            }

            // Validate Middle Name
            if(!empty($middle_name)) {
                if(!Validation::validName($middle_name)) {
                    $this->_f3->set('errors["middle_name"]', 'Invalid name entered');
                } else {

                }
            }

            // Validate Last Name
            if(!empty($last_name)) {
                if(!Validation::validName($last_name)) {
                    $this->_f3->set('errors["last_name"]', 'Invalid name entered');
                } else {

                }
            }

            // Validate Due Date
            if(!Validation::($due_date)){
                $this->_f3->set('errors["due_date"]', 'Invalid Date Entered');
            }

            // Validate Subject
            if(!Validation::($subject)){
                $this->_f3->set('errors["subject"]', 'Invalid Subject Entered');
            }

            // Validate Note
            if(!Validation::($note)){
                $this->_f3->set('errors["note"]', 'Invalid Note Entered');
            }*/


            // If there are no errors, create the case note and
            // redirect to the Case Log page
            if(empty($this->_f3->get('errors'))) {
                $case_note = new Case_Note($student_id, $due_date, $subject, $note, $emotional_indicator);
                $case_id = $GLOBALS['dataLayer']->insertNote($student, $case_note);
                $alert = new Alert('Case Note: ' . $case_id .' has been created.', 'green');
                $this->_f3->set('SESSION.alert', $alert);
                $this->_f3->reroute('/');
            }

        }

        // Set the title of the page

        $this->_f3->set('title', 'Add Case Note');


        // View page for all cases
        $view = new Template();
        echo $view->render('views/reports/add-note.html');
    }




    /**
     * Controller for the forgot-password route
     */
    function forgotPassword()
    {
        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

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
                if ($send_email) {
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
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

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

        if (!isset($_GET['uuid'])) {
            //Redirect to the default route
            $this->_f3->reroute('/');
        }

        $uuid = $_GET['uuid'];
        $result = $GLOBALS['dataLayer']->checkUuidExpirationTime($uuid);

        if (!$result) {
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



    /**
     * Controller for the home route
     */
    function customRange()
    {
        // Set the title of the page
        $this->_f3->set('title', 'Custom Range');

        // Define a view page
        $view = new Template();
        echo $view->render('views/reports/custom-range.html');

    }
}

