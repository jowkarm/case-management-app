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


    /**
     * Generates an uuid for the provided email address.
     *
     * @param $email The email address of the user requesting the password reset.
     * @return string The generated UUID for the password reset link.
     */
    function passwordResetLink($email)
    {
        $currentDateTime = date("Y-m-d H:i:s");
        $futureDateTime = date("Y-m-d H:i:s", strtotime($currentDateTime . "+15 minutes"));

        // 1. define the query
        $sql = "UPDATE User SET uuid = uuid(), password_timestamp = :time WHERE email = :email";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':email', $email);
        $statement->bindParam(':time', $futureDateTime);

        //4. Execute
        $statement->execute();


        // 1. define the query
        $sql2 = "SELECT uuid FROM User WHERE email = :email";

        // 2. prepare the statement
        $statement2 = $this->_dbh->prepare($sql2);

        //3. bind the parameters
        $statement2->bindParam(':email', $email);

        //4. Execute
        $statement2->execute();

        // 5. Process the result
        $row = $statement2->fetch(PDO::FETCH_ASSOC);


        return $row['uuid'];
    }

    /**
     * Updates the password for the user with the specified UUID.
     *
     * @param $uuid The UUID of the user.
     * @param $password The new password to set.
     * @return bool True if the password was successfully updated, false otherwise.
     */
    function updatePassword($uuid, $password)
    {

        // 1. define the query
        $sql = "UPDATE User SET password = :password WHERE uuid = :uuid";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //3. bind the parameters
        $statement->bindParam(':password', $password);
        $statement->bindParam(':uuid', $uuid);

        //4. Execute
        $statement->execute();

        return true;
    }

    /**
     * Checks if the UUID for password reset has expired.
     *
     * @param $uuid The UUID associated with the password reset.
     * @return bool True if the UUID is still valid, false otherwise.
     */
    function checkUuidExpirationTime($uuid)
    {
        // 1. define the query
        $sql = "SELECT password_timestamp FROM User WHERE uuid = :uuid";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. bind the parameters
        $statement->bindParam(':uuid', $uuid);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        //if the query returns nothing, return false
        if (empty($row)){
            return false;
        }

        $password_timestamp = $row['password_timestamp'];
        $currentDateTime = date("Y-m-d H:i:s");

        if ($password_timestamp >= $currentDateTime){
            return true;
        } else {
            return false;
        }
    }



        function getPronouns()
        {
            return array('they/them', 'she/her', 'he/him', 'other');
        }

        function getCtePrograms()
        {
            return array('Forest Resource Management, BAS',
                'Forestry, AAS', 'Geographic Information Systems, AAS', 'Park Management, AAS',
                'Water Quality, AAS', 'Wildland Fire, AAS');
        }

        function getTribes()
        {
            return array(
                "Muckleshoot Indian Tribe",
                "Cherokee Nation",
                "Choctaw Nation",
                "Choctaw Nation",
                "Confederated Tribe of Colville",
                "Navajo Nation",
                "Quileute Tribe",
                "Suquamish Tribe",
                "Tlingit",
                "Blackfeet",
                "Samish",
                "Snoqualmie",
                "Osage",
                "Potawatomie",
                "Chicksaw",
                "Standing Rock Sioux",
                "Sioux");
        }

        function getSizes()
        {
            return array('xs', 's', 'm', 'l', 'xl', 'xxl');
        }

}