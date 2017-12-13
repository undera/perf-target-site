<?php

namespace Demo;

use PWE\Core\PWELogger;

class RTimeFactorial extends AbstractTextOutput
{
    protected function getTextOutput()
    {
        $input = max(intval($_REQUEST['input']), 1);
        $cached = intval($_REQUEST['cached']);
        $recursive = intval($_REQUEST['recursive']);

        $memc = new \Memcached();
        $key = $_SERVER['REQUEST_URI'] . '-' . $input;

        $result = 0;
        if ($cached) {
            $result = intval($memc->get($key));
        }

        if (!$result) {
            $result = $recursive ? $this->getFactorialRecursive($input) : $this->getFactorialCycled($input);
            if ($cached) {
                PWELogger::warn("Cache miss for %s", $input);
                $memc->set($key, $result);
            }
        } else {
            PWELogger::warn("Cache hit for %s", $input);
        }

        return sprintf("Factorial of %d is %s", $input, $result);
    }

    private function getFactorialCycled($input)
    {
        $result = 1;
        for ($x = 1; $x <= $input; $x++) {
            $result *= $x;
        }
        return $result;
    }

    private function getFactorialRecursive($input)
    {
        if ($input <= 1) {
            return $input;
        } else {
            return $input * $this->getFactorialRecursive($input - 1);
        }
    }
}