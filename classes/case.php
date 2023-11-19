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
 * Case note class for the Tribal Pathways project
 */

class Case_Note
{
    private $_case_id; // primary key in table
    private $_student_id; // foreign key in table
    private $_status;
    private $_date_opened;
    private $_due_date;
    private $_subject;
    private $_note;
    private $_emotional_indicator;// Needs to be one of these:
                                  // peace, gratitude, kindness, enthusiasm,
                                  // optimism, hope, apathy, annoyance, worry, anxiety,
                                  // sadness, jealousy, hatred, fear, no comment

    /**
     * @param $_student
     * @param $_due_date
     * @param $_subject
     * @param $_note
     * @param $_emotional_indicator
     */
    public function __construct($_student, $_due_date, $_subject, $_note, $_emotional_indicator)
    {
        $this->_student_id = $_student;
        $this->_due_date = $_due_date;
        $this->_subject = $_subject;
        $this->_note = $_note;
        $this->_emotional_indicator = $_emotional_indicator;
    }

    /**
     * @return mixed
     */
    public function getCaseId()
    {
        return $this->_case_id;
    }

    /**
     * @param mixed $case_id
     */
    public function setCaseId($case_id)
    {
        $this->_case_id = $case_id;
    }

    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->_student_id;
    }

    /**
     * @param mixed $student
     */
    public function setStudentId($student)
    {
        $this->_student_id = $student;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @return mixed
     */
    public function getDateOpened()
    {
        return $this->_date_opened;
    }

    /**
     * @param mixed $date_opened
     */
    public function setDateOpened($date_opened)
    {
        $this->_date_opened = $date_opened;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->_due_date;
    }

    /**
     * @param mixed $due_date
     */
    public function setDueDate($due_date)
    {
        $this->_due_date = $due_date;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->_note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->_note = $note;
    }

    /**
     * @return mixed
     */
    public function getEmotionalIndicator()
    {
        return $this->_emotional_indicator;
    }

    /**
     * @param mixed $emotional_indicator
     */
    public function setEmotionalIndicator($emotional_indicator)
    {
        $this->_emotional_indicator = $emotional_indicator;
    }


}
