<?php

class Calculator
{
    public int $value1;
    public int $value2;
    public string $result;

    public function __construct($value1, $value2)
    {
        $this->value1 = $value1;
        $this->value2 = $value2;
    }
    public function __toString() {
        return $this->result;
    }

    public function add(): static
    {
        $this->result = $this->value1 + $this->value2;
        return $this;
    }

    public function subtract(): static
    {
        $this->result = $this->value1 - $this->value2;
        return $this;
    }

    public function multiply(): static
    {
        $this->result = $this->value1 * $this->value2;
        return $this;
    }

    public function divide(): static
    {
        if ($this->value2 == 0) {
            throw new Exception('Division by zero');
        }
        $this->result = $this->value1 / $this->value2;
        return $this;
    }

    public function addBy(int $value): static
    {

        $this->result += $value;
        return $this;
    }

    public function subtractBy(int $value): static
    {
        $this->result -= $value;
        return $this;
    }

    public function multiplyBy(int $value): static
    {
        $this->result *= $value;
        return $this;
    }

    public function divideBy(int $value): static
    {
        if ($value == 0) {
            throw new Exception('Division by zero');
        }
        $this->result /= $value;
        return $this;
    }
}

$calc = new Calculator(12, 6);
echo $calc->add() . "\n";
echo $calc->multiply() . "\n";
echo $calc->add()->divideBy(9);
