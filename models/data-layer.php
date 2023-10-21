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
 * The DataLayer class for Tribal Pathways project
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

    /**
     * The insertUser method insert a new User into database
     * @param User A User object
     * @return user_id of the new User object
     */
    function insertUser($User)
    {
        //PDO - Using Prepared Statements
        //1. Define the query (test first!)
        $sql = "INSERT INTO User (first_name, last_name, role, email, password, uuid)
            VALUES (:first_name, :last_name, :role, :email, :password, uuid())";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $first_name = $User->getFirstName();
        $last_name = $User->getLastName();
        $role = $User->getRole();
        $email = $User->getEmail();
        // Hash the password
        $password = password_hash($User->getPassword(), PASSWORD_DEFAULT);

        $statement->bindParam(':first_name', $first_name);
        $statement->bindParam(':last_name', $last_name);
        $statement->bindParam(':role', $role);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);


        //4. Execute
        $statement->execute();

        //5. Process the result, if there is one
        $id = $this->_dbh->lastInsertId();
        return $id;
    }

    /**
     * This function returns a user
     * based on user_id
     * @param $user_id
     * @return User
     */
    function getUser($user_id)
    {
        // 1. define the query
        $sql = "SELECT *
                FROM User
                WHERE user_id = :user_id";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':user_id', $user_id);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $user = new User($row['first_name'], $row['last_name'],
                $row['email'], $row['password'], $row['role']);
        $user->setUuid($row['uuid']);
        return $user;
    }

    /**
     * This function checks if a user exists in the database
     * based on user email
     * @param $user_email
     * @return false or a user
     */
    function getUserByEmail($user_email)
    {
        // 1. define the query
        $sql = "SELECT *
                FROM User
                WHERE email = :email
                LIMIT 1";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':email', $user_email);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row !== false){
            $user = new User($row['first_name'], $row['last_name'],
                $row['email'], $row['password'], $row['role']);
            $user->setIsActive($row['is_active']);
            $user->setUserId($row['user_id']);

            return $user;
        } else {
            return false;
        }
    }

    /**
     * This function activates a user by uuid that
     * has sent to the user's email
     * @param $uuid
     * @return boolean  true if updated successfully or otherwise false
     */
    function confirmEmail($uuid)
    {

        // 1. define the query
        $sql = "UPDATE User SET is_active = 1 WHERE uuid = :uuid";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':uuid', $uuid);

        // 4. Execute the update and return the execution status
        return $statement->execute();
    }


}