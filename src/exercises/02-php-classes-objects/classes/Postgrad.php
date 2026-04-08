<?php
require_once __DIR__ . '/Student.php';

class Postgrad extends Student {
    protected $supervisor;
    protected $topic;

    public function __construct($name, $num, $supervisor, $topic) {
        parent::__construct($name, $num);
        $this->supervisor = $supervisor;
        $this->topic = $topic;
    }

    public function getSupervisor(): string {
        return $this->supervisor;
    }

    public function getTopic(): string {
        return $this->topic;
    }

    public function __toString() {
        return "Postgrad: {$this->name} ({$this->number}), Supervisor: {$this->supervisor}, Topic: {$this->topic}";
    }
}
?>