<?php
require __DIR__ . '/student.php';

class Undergrad extends Student {
    protected $course;
    protected $year;

    public function __construct ($name, $number, $course, $year){
    }
}
?>