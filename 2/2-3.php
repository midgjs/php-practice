<?php
$hamburger = 4.95;
$shake = 1.95;
$coke = 0.85;

$tip_rate = 0.16;
$tax_rate = 0.075;

$food = 2*$hamburger + $shake + $cola;
$total = $food + $food*$tip_rate + $food*$tax_rate;

printf("%-9s \$%.2f %d개: \$%5.2f\n", '햄버거', $hanbergur, 2, 2*$hamburger);
printf("%-9s \$%.2f %d개: \$%5.2f\n", '쉐이크', $shake, 1, $shake);
printf("%-9s \$%.2f %d개: \$%5.2f\n", '콜라', $coke, 1, $coke);
printf("%25s: \$%5.2f\n", '음식 가격', $food);
printf("%25s: \$%5.2f\n", '음식 가격(부가세 합계)', $food*$tax_rate);
printf("%25s: \$%5.2f\n", '음식 가격(부가세,팁 합계)', $toal);

//https://php.net/manual/kr/function.sprintf.php
?> 