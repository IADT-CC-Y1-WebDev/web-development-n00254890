<?php
class Student {
    protected $name;
    protected $number;

    public function __construct($name, $num) {
        if ($num == "") {
            throw new Exception("Number cannot be empty");
        }
        $this->name = $name;
        $this->number = $num;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getNumber(): string {
        return $this->number;
    }
}
?>