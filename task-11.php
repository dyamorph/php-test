<?php

class Coord
{
    public int $x;
    public int $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
    public function equals($other): bool
    {
        return $this->x === $other->x && $this->y === $other->y;
    }
}

class PathFinder
{
    private array $field;
    private Coord $start;
    private Coord $end;
    private array $visited;
    private array $queue;
    private array $visitedFrom;

    public function __construct($field, $start, $end)
    {
        $this->field = $field;
        $this->start = $start;
        $this->end = $end;
        $this->visited = array_fill(0, count($this->field), array_fill(0, count($this->field[0]), false));
        $this->queue = array();
        $this->visitedFrom = array();
    }

    public function findPath(): ?array {
        $this->visited[$this->start->x][$this->start->y] = true;
        $this->queue[] = $this->start;
        while (!empty($this->queue)) {
            $current = array_shift($this->queue);

            if ($current->equals($this->end)) {
                return $this->getPath($current);
            }
            $neighbors = $this->getNeighbors($current);

            foreach ($neighbors as $neighbor) {
                if (!($this->visited[$neighbor->x][$neighbor->y])) {
                    $this->visited[$neighbor->x][$neighbor->y] = true;
                    $this->visitedFrom[$neighbor->x][$neighbor->y] = $current;
                    $this->queue[] = $neighbor;
                }
            }
        }
        return null;
    }

    private function getNeighbors($coordinate): array
    {
        $neighbors = array();
        $dx = array(0, 0, -1, 1);
        $dy = array(-1, 1, 0, 0);

        for ($i = 0; $i < 4; $i++) {
            $x = $coordinate->x + $dx[$i];
            $y = $coordinate->y + $dy[$i];

            if ($x >= 0 && $x < count($this->field) && $y >= 0 && $y < count($this->field[0])) {
                if ($this->field[$x][$y] === 0) {
                    $neighbors[] = new Coord($x, $y);
                }
            }
        }
        return $neighbors;
    }

    private function getPath($end): ?array
    {
        $path = [];
        $current = $end;
        while (!$current->equals($this->start)) {
            array_unshift($path, $current);
            if (!isset($this->visitedFrom[$current->x][$current->y])) {
                return null;
            }
            $current = $this->visitedFrom[$current->x][$current->y];
        }
        array_unshift($path, $this->start);

        return $path;
    }
}

class Field
{
    private array $data;
    private string $filename;
    public function __construct($filename)
    {
        $this->filename = $filename;
        if (file_exists($filename)) {
            $this->load();
        } else {
            $this->data = array();

            for ($i = 0; $i < 10; $i++) {
                $row = array();

                for ($j = 0; $j < 10; $j++) {
                    $row[] = rand(0, 1);
                }
                $this->data[] = $row;
            }
            $this->save();
        }
    }

    public function save(): void
    {
        $json = json_encode($this->data);
        file_put_contents($this->filename, $json);
    }

    public function load(): void
    {
        $json = file_get_contents($this->filename);
        $this->data = json_decode($json, true);
    }

    public function findPath($start, $end): ?array
    {
        $pathFinder = new PathFinder($this->data, $start, $end);
        return $pathFinder->findPath();
    }

    public function printField(): void
    {
        for ($i = 0; $i < count($this->data); $i++) {
            for ($j = 0; $j < count($this->data[0]); $j++) {
                echo $this->data[$i][$j] . " ";
            }

            echo "\n";
        }
    }
}
function savePathToFile($path, string $fileName): void
{
    $serializedPath = serialize($path);
    file_put_contents($fileName, $serializedPath);
}

function getPathFromFile(string $fileName): void
{
    $serializedData = file_get_contents($fileName);
    $unserializedData = unserialize($serializedData);
    echo "\nPath:\n";
    if ($unserializedData !== null) {
        foreach ($unserializedData as $coordinate) {
            echo "(" . $coordinate->x . ", " . $coordinate->y . ")\n";
        }
    } else {
        echo "No path found.\n";
    }
}
$field = new Field("field.json");
$start = new Coord(0, 0);
$end = new Coord(1, 3);
$path = $field->findPath($start, $end);

echo "Field:\n";
$field->printField();

savePathToFile($path, 'mypath1.txt');
getPathFromFile('mypath1.txt');
