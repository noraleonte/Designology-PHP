<?php
include('../includes/autoload.php');
$characters = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "V", "W", "X", "Y", "Z");
function generateCode()
{
    global $characters;
    $code = '';
    for ($i = 1; $i <= 6; $i++) {
        $index = rand(1, 3);
        switch ($index) {
            case 1:
                $c = rand(48, 57);
                break;
            case 2:
                $c = rand(65, 90);
                break;
            case 3:
                $c = rand(97, 122);
                break;
        }
        // $chr = $characters[array_rand($characters)];
        $chr = chr($c);
        $code = $code . $chr;
    }

    return $code;
}
function generateValidCode()
{
    $codes = new Codes();
    $code = generateCode();
    while ($codes->validateCode($code)) {
        $code = generateCode();
    }
    return $code;
}
echo generateValidCode();
