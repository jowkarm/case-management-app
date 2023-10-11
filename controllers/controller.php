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
require_once('classes/form.php');
class Controller
{
    //F3 object
    private $f3;


    /**
     * Constructor for the class.
     * @param Object $f3 The Fat-Free Framework object.
     */
    function __construct($f3)
    {
        $this->f3 = $f3;
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
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
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
            $this->f3->set('studentID', $studentID);
            $this->f3->set('name', $name);
            $this->f3->set('pronouns', $pronouns);
            $this->f3->set('tribe', $tribe);
            $this->f3->set('clothingSize', $clothingSize);
            $this->f3->set('courseHistory', $courseHistory);
            $this->f3->set('academics', $academics);
            $this->f3->set('finances', $finances);
            $this->f3->set('caseNotes', $caseNotes);

            // Redirect to the summary page
            $this->f3->reroute('/summary');
        }

        // Display the form
        $view = new Template();
        echo $view->render('studentForm.html');
    }

    function summary()
    {
        // Display a summary view
        $view = new Template();
        echo $view->render('summary.html');
    }
}