<?php
$hamburger = 4.95;
$shake = 1.95;
$coke = 0.85;

$tip_rate = 0.16;
$tax_rate = 0.075;

$food = 2*$hamburger + $shake + $cola;
$total = $food + $food*$tip_rate + $food*$tax_rate;

print '총가격 : $'.$total;
?> 