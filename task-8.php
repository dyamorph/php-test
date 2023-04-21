<?php

class Matrix {
    public array $matrix;
    public int $rows;
    public int $cols;

    public function __construct($rows, $cols) {
        $this->rows = $rows;
        $this->cols = $cols;
        $this->matrix = [];
        for ($i = 0; $i < $this->rows; $i++) {
            $row = [];
            for ($j = 0; $j < $this->cols; $j++) {
                $row[] = rand(0, 9);
            }
            $this->matrix[] = $row;
        }
    }

    public function add(Matrix $secondMatrix): Matrix
    {
        if ($this->rows == $secondMatrix->rows && $this->cols == $secondMatrix->cols) {
            $result = new Matrix($this->rows, $this->cols);
            for ($i = 0; $i < $this->rows; ++$i) {
                for ($j = 0; $j < $this->cols; ++$j) {
                    $result->matrix[$i][$j] = $this->matrix[$i][$j] + $secondMatrix->matrix[$i][$j];
                }
            }
            return $result;
        } else {
            throw new Exception("Matrices must have the same dimensions");
        }
    }

    public function multiplyByNumber(int $number): Matrix
    {
        $result = new Matrix($this->rows, $this->cols);
        for ($i = 0; $i < $this->rows; ++$i) {
            for ($j = 0; $j < $this->cols; ++$j) {
                $result->matrix[$i][$j] = $this->matrix[$i][$j] * $number;
            }
        }
        return $result;
    }

    public function multiplyByMatrix(Matrix $secondMatrix): Matrix
    {
        if ($this->cols == $secondMatrix->rows) {
            $result = new Matrix($this->rows, $secondMatrix->cols);
            for ($i = 0; $i < $this->rows; ++$i) {
                for ($j = 0; $j < $secondMatrix->cols; ++$j) {
                    $result->matrix[$i][$j] = 0;
                    for ($k = 0; $k < $this->cols; ++$k) {
                        $result->matrix[$i][$j] += $this->matrix[$i][$k] * $secondMatrix->matrix[$k][$j];
                    }
                }
            }
            return $result;
        } else {
            throw new Exception("Number of columns in first matrix must equal number of rows in second matrix");
        }
    }

    public function printMatrix(): void
    {
        for ($i = 0; $i < $this->rows; ++$i) {
            $row = implode("\t", $this->matrix[$i]);
            echo $row . "\n";
        }
    }
}
$myMatrix = new Matrix(2,4);
$myMatrix1 = new Matrix(4,2);
$myMatrix->printMatrix();
echo "\n";
$myMatrix1->printMatrix();
echo "\n";
$result = $myMatrix->multiplyByMatrix($myMatrix1);
$result->printMatrix();
