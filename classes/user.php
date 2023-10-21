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
 * User class for the Tribal Pathways project
 */
class User
{
    private $_user_id;
    private $_first_name;
    private $_last_name;
    private $_email;
    private $_password;
    private $_role;
    private $_is_active;
    private $_uuid;
    private $_password_timestamp;


    /**
     * Constructor for the User class.
     *
     * @param $_first_name
     * @param $_last_name
     * @param $_email
     * @param $_password
     * @param $_role
     */
    public function __construct($_first_name, $_last_name, $_email, $_password, $_role = "restricted")
    {
        $this->_first_name = $_first_name;
        $this->_last_name = $_last_name;
        $this->_email = $_email;
        $this->_password = $_password;
        $this->_role = $_role;
    }

    /**
     * Gets user_id
     * @return integer user_id
     */
    public function getUserId()
    {
        return $this->_user_id;
    }

    /**
     * @param integer $user_id
     */
    public function setUserId($user_id)
    {
        $this->_user_id = $user_id;
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
     * Sets first name
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->_first_name = $first_name;
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
     * Sets last name
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->_last_name = $last_name;
    }

    /**
     * Gets email
     * @return string email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets email
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Gets password
     * @return string password
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Sets hashed password
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * Gets role
     * @return string role
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * Sets role, roles can be admin, viewer, and restricted
     * @param string $role
     */
    public function setRole($role)
    {
        $this->_role = $role;
    }

    /**
     * Gets is_active, which is true or false
     * @return string is_active
     */
    public function getIsActive()
    {
        return $this->_is_active;
    }

    /**
     * Sets is_active, which is true for confirmed emails
     * and false for confirmed emails
     * @param boolean $is_active
     */
    public function setIsActive($is_active)
    {
        $this->_is_active = $is_active;
    }

    /**
     * Gets the Universally Unique Identifier
     * @return string uuid
     */
    public function getUuid()
    {
        return $this->_uuid;
    }

    /**
     * Sets the Universally Unique Identifier
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->_uuid = $uuid;
    }

    /**
     * Gets password timestamp
     * @return datetime password timestamp
     */
    public function getPasswordTimestamp()
    {
        return $this->_password_timestamp;
    }

    /**
     * Sets a timestamp for password change
     * @param datetime $password_timestamp
     */
    public function setPasswordTimestamp($password_timestamp)
    {
        $this->_password_timestamp = $password_timestamp;
    }
}