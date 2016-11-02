<?php


    use PHPMathParser\Math;

    require_once 'vendor/autoload.php';

    $math = new Math();
    echo '<pre>'; 
        
//Positive Integer Tests

    $answer = $math->evaluate('-8 < 2');
    var_dump($answer);echo "<br /><br />";
    // boolean true

     $answer = $math->evaluate('-8 > 2');
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
    
    $answer = $math->evaluate('(2-3) + 5');
    var_dump($answer);echo "<br /><br />";
    // int(4)

    $answer = $math->evaluate('-8 < 5');
    var_dump($answer);echo "<br /><br />";
    // boolean true

    $answer = $math->evaluate('(6+2) < 5');
    var_dump($answer);echo "<br /><br />";
    // boolean false

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