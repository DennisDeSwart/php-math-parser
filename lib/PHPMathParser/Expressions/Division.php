<?php

/*
 * The PHP Math Parser library
 *
 * @author     Anthony Ferrara <ircmaxell@ircmaxell.com>
 * @copyright  2011 The Authors
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    Build @@version@@
 */
namespace PHPMathParser\Expressions;

use PHPMathParser\Stack;

class Division extends Operator
{
    protected $precedence = 5;

    public function operate(Stack $stack)
    {
        $left = $stack->pop()->operate($stack);
        
        $popRight  = $stack->pop();       
        if(empty($popRight)){
            throw new \Exception('Error division');
        }
        $right = $popRight->operate($stack);

        return $right / $left;
    }
}
