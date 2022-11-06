<?php 

$now = time();
setcookie('last_access', $now);
if(isset($_COOKIE['last_access'])) {
    $d = new DateTime('@', $_COOKIE['last_access']);
    $msg = '<p>마지막으로 방문한 시각: ' . 
    $d->format('g:i a') . ' on ' . 
    $d->format('F j, Y') . '</p>';
} else {
    $msg = '<p>이 페이지에 처음 방문하셨습니다.</p>';
}
print $msg;


?>