<?php

$json = file_get_contents("http://php.net/releases/?json");

if($json === false) 
{
    print "데이터를 가져올 수 없습니다.";
}

else
{
    $feed = json_decode($json, true);
    $major_numbers = array_keys($feed);

    rsort($major_numbers);
    $biggest_major_number = $major_numbers[0];

    $version = $feed[$biggest_major_number]['version'];
    print "현재 PHP의 가장 최신 버전은 $version 입니다.";
}




?>