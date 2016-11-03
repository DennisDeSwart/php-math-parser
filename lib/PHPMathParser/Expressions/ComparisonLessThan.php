<?php

/*
 * The PHP Math Parser library
 *
 * @author     Anthony Ferrara <ircmaxell@ircmaxell.com>
 * @author     Dennis de Swart <dennis@dennisdeswart.nl>
 * @copyright  2011 The Authors
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    Build @@version@@
 */
namespace PHPMathParser\Expressions;

use PHPMathParser\Stack;

class ComparisonLessThan extends Operator
{
    protected $precedence = 1;

    public function operate(Stack $stack)
    {
        $val1 = $stack->pop()->operate($stack) ;
        
        $pop2  = $stack->pop();       
        if(empty($pop2)){
            throw new \Exception('Error comparison LessThan');
        }
        $val2 = $pop2->operate($stack);

        $bool = $val2 < $val1;
        return $bool;
    }
}
