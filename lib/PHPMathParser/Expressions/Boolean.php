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
use PHPMathParser\TerminalExpression;

class Boolean extends TerminalExpression
{
    public function operate(Stack $stack)
    {
        return $this->value;
    }
}
