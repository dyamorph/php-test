<?php
class Student {
    public string $firstName;
    public string $lastName;
    public string $group;
    public float $averageMark;

    public function __construct($firstName, $lastName, $group, $averageMark) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->group = $group;
        $this->averageMark = $averageMark;
    }

    public function getScholarship():int {
        return ($this->averageMark == 5) ? 100 : 80;
    }
}
class Aspirant extends Student {
    public string $researchTopic;

    public function __construct($firstName, $lastName, $group, $averageMark, $researchTopic) {
        parent::__construct($firstName, $lastName, $group, $averageMark);
        $this->researchTopic = $researchTopic;
    }

    public function getScholarship():int {
        return ($this->averageMark == 5) ? 200 : 180;
    }
}
$aspirant = new Aspirant("John", "Doe", "G1", 5.0, "ML");
$students = [
    new Student("Alice", "Smith", "B2", 4.5),
    new Student("Bob", "Johnson", "C3", 5.0),
    $aspirant,
    new Aspirant("Frank", "K", "R1", 4.0, "Backend"),
    new Aspirant("Billy", "Herrington", "A5", 5.0, "Frontend"),
];
foreach ($students as $student) {
    echo $student->getScholarship() . " USD\n";
}
