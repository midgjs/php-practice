<?php

// $name = '이순신';
// function say_hello() {
//     print '안녕하세요, ';
//     print global $name;
// }

// say_hello();

$name = '이순신';
function say_hello1() {
    print '안녕하세요, ';
    print $GLOBALS['name'];
}

say_hello1();

$name = '이순신';
function say_hello2() {
    global $name;
    print '안녕하세요, ';
    print $name;
}

say_hello2();

?>