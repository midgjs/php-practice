<?php

function vlidate_form() {
    $input = array();
    $errors = array();

    $input['file'] = trim($_POST['file'] ?? '');
    if(0 == strlen($input['file'])) {
        $errors[] = '파일명을 입력해주세요.';
    } else {
        $full = $_SERVER['DOCUMENT_ROOT'] . '/' . $input['file'];
        $full = realpath($full);
        if($full === false) {
            $errors[] = "올바른 파일명을 입력해주세요.";
        } else {
            $docroot_len = strlen($_SERVER['DOCUMENT_ROOT']);
            if(substr($full, 0, $docroot_len) != $_SERVER['DOCUMENT_ROOT']) {
                $errors[] = '문서 루트 안에 있는 파일을 입력해주세요.';
            } else if(strcasecmp(substr($full, -5), '.html') !=0) {
                $errors[] = '파일명은 .html로 끝나야 합니다.';
            } else {
                $input['full'] = $full;
            }
        }
    }

    return array($errors, $input);
}








?>