<?php

$age =12;
$shoe_size=13;
if($age > $shoe_size) {//false
    print '1번 메시지.';
} elseif(($shoe_size++) && ($age > 20)) { //false $show_size++는 실행됨
    print '2번 메시지.';
} else {
    print '3번 메시지.';
}
print "나이: $age. 신발치수: $shoe_size";

?>  