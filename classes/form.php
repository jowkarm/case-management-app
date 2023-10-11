<?php


class Application
{
    private $_studentID;
    private $_fname;
    private $_lname;
    private $_pronounce;
    private $_tribe;
    private $_clothingSize ;
    private $_courseHistory;
    private $_academics;
    private $_finances;
    private $caseNotes;


    /**
     * Default constructor for Application
     */
    function __construct($studentID, $fname, $lname, $pronounce, $tribe)
    {
        $this->_studentID = $studentID;
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_pronounce = $pronounce;
        $this->_tribe = $tribe;

    }

    /**
     * @return mixed
     */
    public function getStudentID()
    {
        return $this->_studentID;
    }

    /**
     * @param mixed $studentID
     */
    public function setStudentID($studentID)
    {
        $this->_studentID = $studentID;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed
     */
    public function getPronounce()
    {
        return $this->_pronounce;
    }

    /**
     * @param mixed $pronounce
     */
    public function setPronounce($pronounce)
    {
        $this->_pronounce = $pronounce;
    }

    /**
     * @return mixed
     */
    public function getTribe()
    {
        return $this->_tribe;
    }

    /**
     * @param mixed $tribe
     */
    public function setTribe($tribe)
    {
        $this->_tribe = $tribe;
    }

    /**
     * @return mixed
     */
    public function getClothingSize()
    {
        return $this->_clothingSize;
    }

    /**
     * @param mixed $clothingSize
     */
    public function setClothingSize($clothingSize)
    {
        $this->_clothingSize = $clothingSize;
    }

    /**
     * @return mixed
     */
    public function getCourseHistory()
    {
        return $this->_courseHistory;
    }

    /**
     * @param mixed $courseHistory
     */
    public function setCourseHistory($courseHistory)
    {
        $this->_courseHistory = $courseHistory;
    }

    /**
     * @return mixed
     */
    public function getAcademics()
    {
        return $this->_academics;
    }

    /**
     * @param mixed $academics
     */
    public function setAcademics($academics)
    {
        $this->_academics = $academics;
    }

    /**
     * @return mixed
     */
    public function getFinances()
    {
        return $this->_finances;
    }

    /**
     * @param mixed $finances
     */
    public function setFinances($finances)
    {
        $this->_finances = $finances;
    }

    /**
     * @return mixed
     */
    public function getCaseNotes()
    {
        return $this->caseNotes;
    }

    /**
     * @param mixed $caseNotes
     */
    public function setCaseNotes($caseNotes)
    {
        $this->caseNotes = $caseNotes;
    }




}//end of class