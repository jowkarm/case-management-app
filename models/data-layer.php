<?php
/**
 * @auther Jo Cichon
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 * @auther Sayed Sadat
 *
 *
 * Created 10/19/2023
 * 355/case-management-app/models/data-layer.php
 * Data Layer for Tribal Pathways project
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/../pdo-config.php');
class DataLayer
{
    /**
     * @var PDO The database connection object
     */
    private $_dbh;

    /**
     * DataLayer Constructor
     */
    function __construct()
    {
        try{
            //Instantiate a database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);

            // For testing the database connection
            //echo "Connected to database!";
        }
        catch(PDOException $e){
            echo $e->getMessage();

        }
    }


    /**
     * This method returns all students information
     * @return array of all students
     */
    function getAllStudents()
    {

        // SELECT Statement - multiple rows
        // 1. define the query
        $sql = "SELECT * FROM Student";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Execute
        $statement->execute();

        // 4. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $students = array();

        foreach ($result as $row){
            $middle_name = (empty($row['middle_name']) ? '' : $row['middle_name']);
            $student = new Student($row['first_name'], $middle_name, $row['last_name'], $row['ctclink_id']);
            $student->setStudentId($row['student_id']);
            $students[] = $student;
        }

        return $students;
    }

    /**
     * Searches for students based on a search phrase.
     *
     * @param $search_phrase The phrase to search for.
     * @return array An array of Student objects matching the search.
     */
    function search($search_phrase)
    {


        // 1. define the query
        $sql = "SELECT * FROM Student
                        WHERE first_name LIKE :keyword
                        OR middle_name LIKE :keyword
                        OR last_name LIKE :keyword
                        OR ctclink_id LIKE :keyword";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $str = '%' . $search_phrase . '%';
        $statement->bindParam(':keyword', $str);


        //4. Execute
        $statement->execute();

        // 5. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $students = array();

        foreach ($result as $row){
            $middle_name = (empty($row['middle_name']) ? '' : $row['middle_name']);
            $student = new Student($row['first_name'], $middle_name, $row['last_name'], $row['ctclink_id']);
            $student->setStudentId($row['student_id']);
            $students[] = $student;
        }

        return $students;
    }

}