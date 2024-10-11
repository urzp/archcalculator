<?php

function int2roman($n) {
    $M = ["","M","MM","MMM"];
    $C = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM"];
    $X = ["","X","XX","XXX","XL","L","LX","LXX","LXXX","XC"];
    $I = ["","I","II","III","IV","V","VI","VII","VIII","IX"];

    return sprintf('%s%s%s%s', $M[$n/1000],$C[($n % 1000)/100],$X[($n % 100)/10],$I[($n % 10)]);
}


?>