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

    /**
     * @param $_first_name
     * @param $_middle_name
     * @param $_last_name
     * @param $_ctclink_id
     */
    public function __construct($_first_name, $_middle_name, $_last_name, $_ctclink_id)
    {
        $this->_first_name = $_first_name;
        $this->_middle_name = $_middle_name;
        $this->_last_name = $_last_name;
        $this->_ctclink_id = $_ctclink_id;
    }

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

}