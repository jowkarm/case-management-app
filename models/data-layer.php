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
     * @param $search_phrase the phrase to search for.
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


    function getSortOptions()
    {
        return array("case_id", "ctclink_id", "is_closed", "date_opened", "due_date", "subject", "emotional_indicator");
    }


    static function getPronouns()
    {
        return array('they/them', 'she/her', 'he/him', 'other');
    }

    static function getSizes()
    {
        return array('xs', 's', 'm', 'l', 'xl', 'xxl');
    }

    static function getTribes()
    {
        return array('Muckleshoot Indian Tribe', 'Cherokee Nation', 'Choctaw Nation',
            'Turtle Mountain Band of Chippewa', 'Confederated Tribe of Colville',
            'Navajo Nation', 'Quileute Tribe', 'Suquamish Tribe', 'Tlighit',
            'Blackfeet', 'Samish', 'Snoqualmie', 'Osage', 'Potawatomie', 'Chicksaw',
            'Standing Rock Sioux', 'Sioux');
    }

    static function getCTEprograms()
    {
        return array('Forest Resource Management, BAS',
            'Forestry', 'Geographic Information Systems, AAS',
            'Park Management, AAS', 'Water Quality, AAS',
            'Wildland Fire, AAS', 'AAS-T');
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


    function insertNote($student, $case)
    {
        /* Search for the student using their ctclink ID and get their student ID */
        // 1. define the query
        $sql = "SELECT student_id FROM Student
                WHERE ctclink_id = :ctclink_id";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $ctclink_id = $student->getCtclinkId();

        $statement->bindParam(':ctclink_id', $ctclink_id);
        //4. Execute
        $statement->execute();

        // Save the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Use the result as a field for Insert statement

        /* Insert the note and use the student ID taken from the student*/
        // 1. define the query
        $sql = "INSERT INTO Notes (student_id, due_date, subject, note, emotional_indicator)
                VALUES (:student_id, :due_date, :subject, :note, :emotional_indicator)";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $student_id = $result['student_id'];
        $due_date = $case->getDueDate();
        $subject = $case->getSubject();
        $note = $case->getNote();
        $emotional_indicator = $case->getEmotionalIndicator();

        $statement->bindParam(':student_id', $student_id);
        $statement->bindParam(':due_date', $due_date);
        $statement->bindParam(':subject', $subject);
        $statement->bindParam(':note', $note);
        $statement->bindParam(':emotional_indicator', $emotional_indicator);

        //4. Execute
        $statement->execute();

        //5. Process the result, if there is one
        $id = $this->_dbh->lastInsertId();
        return $id;
    }

    function getNote($case_id)
    {
        $sql = "SELECT *
                FROM Notes INNER JOIN Student 
                ON Notes.student_id = Student.student_id
                WHERE Notes.case_id = :case_id";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':case_id', $case_id);

        //4. Execute
        $statement->execute();

        // 5. Process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if($row !== false){
            $note = new Case_Note($row['ctclink_id'],
                $row['due_date'],
                $row['subject'],
                $row['note'],
                $row['emotional_indicator']);;
            $note->setCaseId($row['case_id']);
            $note->setFirstName($row['first_name']);
            $note->setMiddleName($row['middle_name']);
            $note->setLastName($row['last_name']);
            $note->setStatus($row['is_closed']);
            $note->setDateOpened($row['date_opened']);

            return $note;
        } else {
            return false;
        }
    }
    function getAllCaseNotes() // change to case log
    {
        $sql = "SELECT *
                FROM Notes INNER JOIN Student 
                ON Notes.student_id = Student.student_id
                ORDER BY is_closed ASC, due_date";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Execute
        $statement->execute();

        // 4. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $notes = array();

        foreach ($result as $row){
            $note = new Case_Note($row['ctclink_id'],
                $row['due_date'],
                $row['subject'],
                $row['note'],
                $row['emotional_indicator']);
            $note->setCaseId($row['case_id']);
            $note->setFirstName($row['first_name']);
            $note->setMiddleName($row['middle_name']);
            $note->setLastName($row['last_name']);
            $note->setStatus($row['is_closed']);
            $note->setDateOpened($row['date_opened']);
            $notes[] = $note;
        }
        return $notes;
    }

    function getSortedCaseNotes($sortType)
    {

        // SELECT Statements (different cases)
        // 1. define the query
        if ($sortType == "is_closed")
        {
            $sql = "SELECT * 
                    FROM Notes INNER JOIN Student 
                    ON Notes.student_id = Student.student_id
                    ORDER BY " . $sortType . " ASC, Notes.student_id";
        }
        else
        {
            $sql = "SELECT * 
                    FROM Notes INNER JOIN Student 
                    ON Notes.student_id = Student.student_id
                    ORDER BY " . $sortType . ", Notes.student_id";
        }

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Execute
        $statement->execute();

        // 4. Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $notes = array();

        foreach ($result as $row){
            $note = new Case_Note($row['ctclink_id'],
                $row['due_date'],
                $row['subject'],
                $row['note'],
                $row['emotional_indicator']);
            $note->setCaseId($row['case_id']);
            $note->setFirstName($row['first_name']);
            $note->setMiddleName($row['middle_name']);
            $note->setLastName($row['last_name']);
            $note->setStatus($row['is_closed']);
            $note->setDateOpened($row['date_opened']);
            $notes[] = $note;
        }
        return $notes;
    }

    function getNextCaseId()
    {
        // 1. define the query
        $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_NAME ='Notes';";

        // 2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Execute
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['AUTO_INCREMENT'];
    }


    function insertStudent($student){

        // Insert into the Student table
        $sqlStudent = "INSERT INTO Student (first_name, middle_name, last_name, ctclink_id, pronouns, tribe_name, email, phone, cte_program, clothing_size, profile_photo, course_history, academic_progress, financial_needs, cases, file_name)
               VALUES (:first_name, :middle_name, :last_name, :ctclink_id, :pronouns, :tribe_name, :email, :phone, :cte_program, :clothing_size, :profile_photo, :course_history, :academic_progress, :financial_needs, :cases, :file_name)";

        $statementStudent = $this->_dbh->prepare($sqlStudent);

        // Bind parameters
        $first_name = $student->getFirstName();
        $middle_name = $student->getMiddleName();
        $last_name = $student->getLastName();
        $ctclink_id = $student->getCtclinkId();
        $pronouns = $student->getPronouns();
        $tribe_name = $student->getTribeName();
        $email = $student->getEmail();
        $phone = $student->getPhone();
        $cte_program = $student->getCteProgram();
        $clothing_size = $student->getClothingSize();
        $profile_photo = $student->getProfilePhoto();
        $course_history = $student->getCourseHistory();
        $academic_progress = $student->getAcademicProgress();
        $financial_needs = $student->getFinancialNeeds();
        $cases = $student->getCases();
        $file_name = $student->getFileName();




        $statementStudent->bindParam(':first_name', $first_name);
        $statementStudent->bindParam(':middle_name', $middle_name);
        $statementStudent->bindParam(':last_name', $last_name);
        $statementStudent->bindParam(':ctclink_id', $ctclink_id);
        $statementStudent->bindParam(':pronouns', $pronouns);
        $statementStudent->bindParam(':tribe_name', $tribe_name);
        $statementStudent->bindParam(':email', $email);
        $statementStudent->bindParam(':phone', $phone);
        $statementStudent->bindParam(':cte_program', $cte_program);
        $statementStudent->bindParam(':clothing_size', $clothing_size);
        $statementStudent->bindParam(':profile_photo', $profile_photo);
        $statementStudent->bindParam(':course_history', $course_history);
        $statementStudent->bindParam(':academic_progress', $academic_progress);
        $statementStudent->bindParam(':financial_needs', $financial_needs);
        $statementStudent->bindParam(':cases', $cases);
        $statementStudent->bindParam(':file_name', $file_name);

        // Execute the statement
        return $statementStudent->execute();
    }

    function updateStudent($student){

        // Insert into the Student table
        $sqlStudent = "UPDATE Student
                        SET first_name = :first_name, 
                            middle_name = :middle_name, 
                            last_name = :last_name, 
                            pronouns = :pronouns, 
                            tribe_name = :tribe_name, 
                            ctclink_id = :ctclink_id, 
                            email = :email, 
                            phone = :phone, 
                            cte_program = :cte_program, 
                            clothing_size = :clothing_size, 
                            profile_photo = :profile_photo, 
                            course_history = :course_history, 
                            academic_progress = :academic_progress, 
                            financial_needs = :financial_needs, 
                            cases = :cases, 
                            file_name = :file_name
                        WHERE student_id = :student_id";


        $statementStudent = $this->_dbh->prepare($sqlStudent);

        // Bind parameters
        $first_name = $student->getFirstName();
        $middle_name = $student->getMiddleName();
        $last_name = $student->getLastName();
        $ctclink_id = $student->getCtclinkId();
        $pronouns = $student->getPronouns();
        $tribe_name = $student->getTribeName();
        $email = $student->getEmail();
        $phone = $student->getPhone();
        $cte_program = $student->getCteProgram();
        $clothing_size = $student->getClothingSize();
        $profile_photo = $student->getProfilePhoto();
        $course_history = $student->getCourseHistory();
        $academic_progress = $student->getAcademicProgress();
        $financial_needs = $student->getFinancialNeeds();
        $cases = $student->getCases();
        $file_name = $student->getFileName();
        $student_id = $student->getStudentId();




        $statementStudent->bindParam(':first_name', $first_name);
        $statementStudent->bindParam(':middle_name', $middle_name);
        $statementStudent->bindParam(':last_name', $last_name);
        $statementStudent->bindParam(':ctclink_id', $ctclink_id);
        $statementStudent->bindParam(':pronouns', $pronouns);
        $statementStudent->bindParam(':tribe_name', $tribe_name);
        $statementStudent->bindParam(':email', $email);
        $statementStudent->bindParam(':phone', $phone);
        $statementStudent->bindParam(':cte_program', $cte_program);
        $statementStudent->bindParam(':clothing_size', $clothing_size);
        $statementStudent->bindParam(':profile_photo', $profile_photo);
        $statementStudent->bindParam(':course_history', $course_history);
        $statementStudent->bindParam(':academic_progress', $academic_progress);
        $statementStudent->bindParam(':financial_needs', $financial_needs);
        $statementStudent->bindParam(':cases', $cases);
        $statementStudent->bindParam(':file_name', $file_name);
        $statementStudent->bindParam(':student_id', $student_id);

        // Execute the statement
        return $statementStudent->execute();
    }

    function getStudent($student_id){
        // Define the query
        $sqlRetrieveStudent = "SELECT * FROM Student WHERE student_id = :student_id";

        // Prepare the statement
        $statementRetrieveStudent = $this->_dbh->prepare($sqlRetrieveStudent);

        // Bind the parameter
        $statementRetrieveStudent->bindParam(':student_id', $student_id);

        // Execute the statement
        $statementRetrieveStudent->execute();

        // Fetch the student data
        $row = $statementRetrieveStudent->fetch(PDO::FETCH_ASSOC);

        $student = new Student($row['first_name'], $row['middle_name'], $row['last_name'], $row['ctclink_id']);

        $student->setStudentId($row['student_id']);
        $student->setCteProgram($row['cte_program']);
        $student->setPronouns($row['pronouns']);
        $student->setTribeName($row['tribe_name']);
        $student->setEmail($row['email']);
        $student->setClothingSize($row['clothing_size']);
        $student->setCourseHistory($row['first_name']);
        $student->setAcademicProgress($row['academic_progress']);
        $student->setFinancialNeeds($row['financial_needs']);
        $student->setCases($row['cases']);
        $student->setPhone($row['phone']);
        $student->setProfilePhoto($row['profile_photo']);
        $student->setFileName($row['file_name']);

        return $student;
    }


    function deleteStudent($student_id){
        // Define the query
        $sqlRetrieveStudent = "DELETE FROM Student WHERE student_id = :student_id";

        // Prepare the statement
        $statementRetrieveStudent = $this->_dbh->prepare($sqlRetrieveStudent);

        // Bind the parameter
        $statementRetrieveStudent->bindParam(':student_id', $student_id);

        // Execute the statement
        return $statementRetrieveStudent->execute();

    }
}