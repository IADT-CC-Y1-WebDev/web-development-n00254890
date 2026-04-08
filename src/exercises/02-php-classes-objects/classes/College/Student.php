<?php

namespace College;

class Student {
    protected $name;
    protected $number;

    private static $students = [];

    public function __construct($name, $num) {
        $this->name = $name;
        $this->number = $num;

        echo "Creating student... {$this->name}<br>";

        // register student
        self::$students[$this->number] = $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public static function getCount() {
        return count(self::$students);
    }

    public static function findAll() {
        return self::$students;
    }

    public static function findByNumber($num) {
        return self::$students[$num] ?? null;
    }

    public function leave() {
        unset(self::$students[$this->number]);
    }

    public function __destruct() {
        echo "Student {$this->name} has been destroyed<br>";
    }

    public function __toString() {
        return "Student: {$this->name} ({$this->number})";
    }
}
?>