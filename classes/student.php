<?php
/**
 * @auther Jo Cichon
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 * @auther Sayed Sadat
 *
 *
 * Created 10/19/2023
 * 355/case-management-app/classes/user.php
 * Student class for the Tribal Pathways project
 */

class Student
{
    private $_student_id;
    private $_first_name;
    private $_middle_name;
    private $_last_name;
    private $_ctclink_id;
    private $_pronouns;
    private $_tribeName;
    private $_email;
    private $_phoneNumber;
    private $_clothingSize;
    private $_courseHistory;
    private $_academicProgress;
    private $_financialNeeds;
    private $_caseNotes;

    /**
     * Default constructor for a student object
     *
     * @param $_student_id
     * @param $_first_name
     * @param $_middle_name
     * @param $_last_name
     * @param $_ctclink_id
     * @param $_pronouns
     * @param $_tribeName
     * @param $_email
     * @param $_phoneNumber
     * @param $_clothingSize
     * @param $_academicProgress
     * @param $_financialNeeds
     */
    public function __construct($_student_id, $_first_name, $_middle_name, $_last_name, $_ctclink_id, $_pronouns, $_tribeName, $_email, $_phoneNumber, $_clothingSize, $_academicProgress, $_financialNeeds)
    {
        $this->_student_id = $_student_id;
        $this->_first_name = $_first_name;
        $this->_middle_name = $_middle_name;
        $this->_last_name = $_last_name;
        $this->_ctclink_id = $_ctclink_id;
        $this->_pronouns = $_pronouns;
        $this->_tribeName = $_tribeName;
        $this->_email = $_email;
        $this->_phoneNumber = $_phoneNumber;
        $this->_clothingSize = $_clothingSize;
        $this->_courseHistory = array();
        $this->_academicProgress = $_academicProgress;
        $this->_financialNeeds = $_financialNeeds;
        // case notes will be a separate class that contains the student ID
        //$this->_caseNotes = array();
    }

    // Getters

    /**
     * Gets student_id
     * @return integer student_id
     */
    public function getStudentId()
    {
        return $this->_student_id;
    }

    /**
     * Gets first name
     * @return string first name
     */
    public function getFirstName()
    {
        return $this->_first_name;
    }

    /**
     * Gets middle name
     * @return string middle name
     */
    public function getMiddleName()
    {
        return $this->_middle_name;
    }

    /**
     * Gets last name
     * @return string last name
     */
    public function getLastName()
    {
        return $this->_last_name;
    }

    /**
     * Gets ctclink_id
     * @return integer CtcLink_id
     */
    public function getCtclinkId()
    {
        return $this->_ctclink_id;
    }

    /**
     * @return String
     */
    public function getPronouns()
    {
        return $this->_pronouns;
    }

    /**
     * @return String
     */
    public function getTribeName()
    {
        return $this->_tribeName;
    }

    /**
     * @return String
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return String
     */
    public function getPhoneNumber()
    {
        return $this->_phoneNumber;
    }

    /**
     * @return String
     */
    public function getClothingSize()
    {
        return $this->_clothingSize;
    }

    /**
     * @return array
     */
    public function getCourseHistory()
    {
        return $this->_courseHistory;
    }

    /**
     * @return String
     */
    public function getAcademicProgress()
    {
        return $this->_academicProgress;
    }

    /**
     * @return String
     */
    public function getFinancialNeeds()
    {
        return $this->_financialNeeds;
    }

    /**
     * @return array
     */
    public function getCaseNotes()
    {
        return $this->_caseNotes;
    }

    // Setters

    /**
     * Sets first name
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->_first_name = $first_name;
    }

    /**
     * Sets middle name
     * @param string $middle_name
     */
    public function setMiddleName($middle_name)
    {
        $this->_middle_name = $middle_name;
    }

    /**
     * Sets last name
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->_last_name = $last_name;
    }

    /**
     * Sets ctclink_id
     * @param integer $ctclink_id
     */
    public function setCtclinkId($ctclink_id)
    {
        $this->_ctclink_id = $ctclink_id;
    }

    /**
     * Sets student_id
     * @param integer $student_id
     */
    public function setStudentId($student_id)
    {
        $this->_student_id = $student_id;
    }

    /**
     * @param String $pronouns
     */
    public function setPronouns($pronouns)
    {
        $this->_pronouns = $pronouns;
    }

    /**
     * @param String $tribeName
     */
    public function setTribeName($tribeName)
    {
        $this->_tribeName = $tribeName;
    }

    /**
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @param String $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->_phoneNumber = $phoneNumber;
    }

    /**
     * @param String $clothingSize
     */
    public function setClothingSize($clothingSize)
    {
        $this->_clothingSize = $clothingSize;
    }

    public function setCourseHistory(array $courseHistory)
    {
        $this->_courseHistory = $courseHistory;
    }

    /**
     * @param String $academicProgress
     */
    public function setAcademicProgress($academicProgress)
    {
        $this->_academicProgress = $academicProgress;
    }

    /**
     * @param String $financialNeeds
     */
    public function setFinancialNeeds($financialNeeds)
    {
        $this->_financialNeeds = $financialNeeds;
    }

    public function setCaseNotes(array $caseNotes)
    {
        $this->_caseNotes = $caseNotes;
    }


}