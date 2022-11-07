<?php

//예외 처리기

function exceptionHandler($ex) {
    //오류 정보를 오류 로그에 기록한다.
    error_log("ERROR: " . $ex->getMessage());

    //오류메시지 클라이언트에게 출력
    die("<p>죄송합니다. 문제가 생겼습니다.</p>");
}

set_exception_handler('exceptionHandler'); //인수로 위에 정의한 함수명을 넣어준다.

















?>