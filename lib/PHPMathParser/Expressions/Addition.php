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

class Addition extends Operator
{
    protected $precedence = 4;

    public function operate(Stack $stack)
    { 
        $operation1  = $stack->pop()->operate($stack);
        
        $pop2  = $stack->pop();       
        if(empty($pop2)){
            throw new \Exception('Error adding');
        }
        
        $operation2 = $pop2->operate($stack);
            
        $result = $operation1 + $operation2;
        return $result;
    }
}
