<?php


/**
 * Initialize
 */
    use PHPMathParser\Math;

    require_once 'vendor/autoload.php';

    $math = new Math();
    echo '<pre>'; 
    
    
/**
 * Optinal error handling
 */
    function runEvaluation($math, $exp){
        try{
            $answer = $math->evaluate($exp);
            return $answer;
        } catch (\Exception $ex) {
            return 'Message: ' .$ex->getMessage();
        }
    }
    
    // Error handling tests
     $answer = runEvaluation($math, '-8 */ 2');
    var_dump($answer);echo "<br /><br />";
    // error during multiplication
    
    $answer = runEvaluation($math, '-8 * someUndefinedValue');
    var_dump($answer);echo "<br /><br />";
    // contains value that is not integer or boolean
    
    $answer = runEvaluation($math, 'textThatCannotBeParsed');
    var_dump($answer);echo "<br /><br />";
    // contains value that is not integer or boolean
    
/**
 * Tests
 */    
    
//Comparison Tests

     $answer = $math->evaluate('(-8>2)');
    var_dump($answer);echo "<br /><br />";
    // boolean false

    $answer = $math->evaluate('100 > -10');
    var_dump($answer);echo "<br /><br />";
    // boolean true

    $answer = $math->evaluate('100 < -10');
    var_dump($answer);echo "<br /><br />";
    // boolean false

    $answer = $math->evaluate('100 < -10+120'); // comparison has precedence over addition in the evaluation
    var_dump($answer);echo "<br /><br />";
    // boolean true
        
    $answer = $math->evaluate('(6+2) < 5');
    var_dump($answer);echo "<br /><br />";
    // boolean false

    $answer = $math->evaluate('-8 < 5');
    var_dump($answer);echo "<br /><br />";
    // boolean true
    
    /**
     * IMPORTANT: known problems with comparison operators
     */
    
    // Allowing more than 1 comparison is not possible
    $answer = $math->evaluate('3 > 2 > 1');
    var_dump($answer);echo "<br /><br />";
    // boolean true because 3 > 2 is true. The final comparison is not evaluated
    
    // Division by zero if false
    $answer = $math->evaluate('1 / (1 > 2)');
    var_dump($answer);echo "<br /><br />";
    // Leads to division by zero because '1 / false'
        
    // Comparison needs spaces
    $answer = $math->evaluate('3>2');
    var_dump($answer);echo "<br /><br />";
    // Exception because this 3>2 is not a number
    
    // Unlogical calculation
     $answer = $math->evaluate('(2<1)*1)'); // works but isn't logical, because it is multiplying a "boolean" 
    var_dump($answer);echo "<br /><br />";
    // int(0) but should not be a valid mathimatical answer
    
    
    
//Positive Integer Tests
    
    $answer = $math->evaluate('(2-3) + 5');
    var_dump($answer);echo "<br /><br />";
    // int(4)

    $answer = $math->evaluate('10 / 5');
    var_dump($answer);echo "<br /><br />";
    // int(2)

    $answer = $math->evaluate('(2 + 3) * 4');
    var_dump($answer);echo "<br /><br />";
    // int(20)

    $answer = $math->evaluate('1 + 2 * ((3 + 4) * 5 + 6)');
    // 1 + 2 * (7 * 5 + 6)
    // 1 + 2 * (35 + 6)
    // 1 + 2 * 41
    // 1 + 82
    var_dump($answer);echo "<br /><br />";
    // int(83)

    $answer = $math->evaluate('9 * (3+8) - 6 - 45');
    var_dump($answer);echo"<br /><br />";
    // 99 - 6 - 45
    // int(48)

    $answer = $math->evaluate('1 * 2 + ((3 + 4) * 5 + 6)');
    // 2 + (7 * 5 + 6)
    // 2 + (35 + 6)
    var_dump($answer);echo "<br /><br />";
    // int(43)

    $answer = $math->evaluate('(1 + 2) * (3 + 4) * (5 + 6)');
    var_dump($answer);echo "<br /><br />";
    // int(231)

    $math->registerVariable('a', 4);
    $answer = $math->evaluate('($a + 3) * 4');
    var_dump($answer);echo "<br /><br />";
    // int(28)

    $math->registerVariable('a', 5);
    $answer = $math->evaluate('($a + $a) * 4');
    var_dump($answer);echo "<br /><br />";
    // int(40)

//Float Tests
    $answer = $math->evaluate('1.45 + 3');
    var_dump($answer);echo "<br /><br />";
    // float(4.45)

    $answer = $math->evaluate('0.45 + 3.5');
    var_dump($answer);echo "<br /><br />";
    // float(3.95)

    $answer = $math->evaluate('10.6 / 1.2');
    var_dump($answer);echo "<br /><br />";
    // float(8.83333333333)

    $answer = $math->evaluate('(1.65 + 2) * (3.1415 + 4) * (5 + 6.8989)');
    var_dump($answer);echo "<br /><br />";
    // float(310.162379378) (but 310.1623793775 in Apple and Windows Calculators)

    $math->registerVariable('a', 5.36464);
    $answer = $math->evaluate('($a + $a) * 4');
    var_dump($answer);echo "<br /><br />";
    // float(42.91712)

//Neg Unary Operator Tests
    $answer = $math->evaluate('3 - -3');
    var_dump($answer);echo " <br /><br />";
    //int(6)

    $answer = $math->evaluate('-2 + -3');
    var_dump($answer);echo " <br /><br />";
    //int(-5)

    $answer = $math->evaluate('-2.5 / 0.5');
    var_dump($answer);echo "<br /><br />";
    //float(-5)

    $answer = $math->evaluate('-9 * (-3+8) - 6 - -45');
    var_dump($answer);echo "<br /><br />";
    //int(-6)

    $answer = $math->evaluate('(10 / 5 * -(1 + 2))');
    var_dump($answer);echo "<br /><br />";
    //int(-6)

    $answer = $math->evaluate('-7.3 * (-3.2+8) - 6 - -45.5');
    var_dump($answer);echo "<br /><br />";
    // float(4.46)

    $math->registerVariable('a', -5.5);
    $answer = $math->evaluate('($a + $a) * 4');
    var_dump($answer);echo "<br /><br />";
    // float(-44)
