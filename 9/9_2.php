<?php

//주소
$addresses = array();
$fh = fopen('addresses.txt', 'rb');
if(! $fh) {
    die("addresses.txt 파일을 열 수 없습니다: $php_errormsg");
}
while ((! feof($fh)) && ($line = fgets($fh))) {
    $line = trim($line);
    //주소를 $addresses 배열의 키로 사용
    //키에 할당된 값은 해당 주소를 발견한 횟수다.
    if(! isset($addresses[$line])) {
        $addresses[$line] = 0;
    }
    $addresses[$line] = $addresses[$line] + 1;
}
if(! fclose($fh)) {
    die("addresses.txt 파일을 저장할 수 없습니다: $php_errormsg");
}

arsort($addresses);

$fh = fopen('addresses-count.txt','wb');
if(! $fh) {
    die("addresses-count.txt 파일을 열 수 없습니다: $php_errormsg");
}
foreach($addresses as $addresses => $count) {
    if(fwrite($fh, "$count,$address\n") === false) {
        die("$count,$address 를 기록할 수 없습니다: $php_errormsg");
    }
}
if(! fclose($fh)) {
    die("addresses-count.txt 파일을 저장할 수 없습니다: $php_errormsg");
}


?>

test01@google.com
test02@google.com
test03@google.com
test04@google.com
test05@google.com
test06@google.com
test07@google.com
test08@google.com
test09@google.com
test10@google.com
test11@google.com
test12@google.com
test13@google.com
test14@google.com
test15@google.com
