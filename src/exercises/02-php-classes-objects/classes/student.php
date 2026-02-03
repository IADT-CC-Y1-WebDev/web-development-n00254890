<?php
class Student {
    protected $name;
    protected $number;

    public function __construct($name, $num) {
       
        $this->name = $name;
         echo "Creating student... {$this->name}<br>";
        $this->number = $num;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getNumber(): string {
        return $this->number;
    }

     public function __toString() {
        return "Student: {$this->name} {$this->number}";
  }
}
?>