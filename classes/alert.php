<?php

/**
 * @auther Jo Cichon
 * @author Anthony Gutierrez
 * @auther Mehdi Jokar
 * @auther Sayed Sadat
 *
 *
 * Created 10/20/2023
 * 355/case-management-app/classes/alert.php
 * The Alert class for the Tribal Pathways project
 */
class Alert
{
    private $_text;
    private $_color;

    /**
     * @param $_text string text of the alert
     * @param $_color string it can be red, green or yellow
     */
    public function __construct($_text, $_color)
    {
        $this->_text = $_text;
        $this->_color = $_color;
    }

    /**
     * @return string text of the alert
     */
    public function getText()
    {
        return $this->_text;
    }

    /**
     * @return string the bootstrap class for
     * a red,green, or yellow alert
     */
    public function getColor()
    {
        if(strtolower($this->_color) == 'red'){
            return 'alert alert-danger';

        } elseif (strtolower($this->_color) == 'green'){
            return 'alert alert-success';

        } else {
            return 'alert alert-warning';
        }
    }




}