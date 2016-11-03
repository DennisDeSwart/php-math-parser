<?php

/*
 * The PHP Math Parser library
 *
 * @author     Anthony Ferrara <ircmaxell@ircmaxell.com>
 * @copyright  2011 The Authors
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    Build @@version@@
 */
namespace PHPMathParser;

use PHPMathParser\Expressions\Addition;
use PHPMathParser\Expressions\ComparisonGreaterThan;
use PHPMathParser\Expressions\ComparisonLessThan;
use PHPMathParser\Expressions\Division;
use PHPMathParser\Expressions\Multiplication;
use PHPMathParser\Expressions\Boolean;
use PHPMathParser\Expressions\Number;
use PHPMathParser\Expressions\Parenthesis;
use PHPMathParser\Expressions\Power;
use PHPMathParser\Expressions\Subtraction;
use PHPMathParser\Expressions\Unary;

abstract class TerminalExpression
{
    protected $value = '';

    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function factory($value)
    {
        if (is_object($value) && $value instanceof self) {
            return $value;
        } elseif (is_bool($value)) {
            return new Boolean($value);
        } elseif (is_numeric($value)) {
            return new Number($value);
        } elseif ($value == 'u') {
            return new Unary($value);
        } elseif ($value == '+') {
            return new Addition($value);
        } elseif ($value == '-') {
            return new Subtraction($value);
        } elseif ($value == '*') {
            return new Multiplication($value);
        } elseif ($value == '/') {
            return new Division($value);
        } elseif (in_array($value, array('(', ')'))) {
            return new Parenthesis($value);
        } elseif ($value == '^') {
            return new Power($value);
        } elseif ($value == '>') {
            return new ComparisonGreaterThan($value);
        } elseif ($value == '<') {
            return new ComparisonLessThan($value);
        } 
        throw new \Exception('Expression contains value that is not integer or boolean => ' . $value);
    }

    abstract public function operate(Stack $stack);

    public function isOperator()
    {
        return false;
    }

    public function isUnary()
    {
        return false;
    }

    public function isParenthesis()
    {
        return false;
    }

    public function isNoOp()
    {
        return false;
    }

    public function render()
    {
        return $this->value;
    }
}
