<?php
require __DIR__ . '/student.php';

class Undergrad extends Student {
    protected $course;
    protected $year;

    public function __construct ($name, $num, $course, $year){
        parent::__construct($name, $num);
        $this->course = $course;
        $this->year = $year;
    }
    public function getCourse(): string {
        return $this->course;
    }
    public function getYear(): string {
        return $this->year;
    }
}
?>