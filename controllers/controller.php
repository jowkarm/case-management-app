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

    function home()
    {
        // Define a view page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function studentForm()
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
        echo $view->render('views/studentForm.html');
    }

    function summary()
    {
        // Display a summary view
        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }

    function getStudentList()
    {
        //If the form has been posted
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            // Get the data
            $search = (isset($_POST['search'])) ? $_POST['search'] : '';

            $this->_f3->set('SESSION.search', $search);
            $students = $GLOBALS['dataLayer']->search($this->_f3->get('SESSION.search'));

            $this->_f3->set('SESSION.students', $students);

            // Set the title of the page
            $this->_f3->set('title', "Search Results");

            // Display a student-list view
            $view = new Template();
            echo $view->render('views/student-list.html');

            session_destroy();
        }

        $students = $GLOBALS['dataLayer']->getAllStudents();

        $this->_f3->set('SESSION.students', $students);

        // Set the title of the page
        $this->_f3->set('title', "Students List");

        // Display a student-list view
        $view = new Template();
        echo $view->render('views/student-list.html');
    }
}