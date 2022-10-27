<?php
function restaurant_check($meal, $tax, $tip)
{
    $tax_amount = $meal * ($tax / 100);
    $tip_amount = $meal * ($tip / 100);
    return $meal + $tax_amount + $tip_amount;
}

$cash_on_hand = 31;
$meal = 25;
$tax = 10;
$tip = 10;

while(($cost = restaurant_check($meal,$tax,$tip)) < $cash_on_hand)
{
    $tip++;
    echo "팁으로 $tip% ($cost) 정도는 낼 수 있지\n";
}




















?>