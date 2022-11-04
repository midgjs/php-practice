<?php

require 'FormHelper.php';

if($_SERVER['REQUEST_METHOD']=='POST') {
    list($errors, $input) = validate_form();
    if($errors) {
        show_form($errors);
    } else {
        process_form($input);
    }
} else {
    show_form();
}

function show_form($errors = array()) {
    $form = new FormHelper();

    include 'filename-form.php';
}

function validate_form() {
    $input = array();
    $errors = array();

    $input['file'] = trim($_POST['file'] ?? '');
    if(0 == strlen($input['file'])) {
        $errors[] = '파일명을 입력해주세요.';
    } else {
        //전체 파일 경로가
        //웹 서버의 문서 루트 하위에 있는지 확인한다.
        $full = $_SERVER['DOCUMENT_ROOT'] . '/' . $input['file'];

        $full = realpath($full);
        if($full === false) {
            $errors[] = "올바른 파일명을 입력해주세요.";
        } else {
            //$full 값이 문서 루트 디렉터리로 시작하는지 검사한다.
            $docroot_len = strlen($_SERVER['DOCUMENT_ROOT']);
            if(substr($full, 0, $docroot_len) != $_SERVER['DOCUMENT_ROOT']) {
                $errors[] = '문서 루트 안에 있는 파일을 입력해주세요.';
            } else {
                $input['full'] = $full;
            }
        }
    }
    return array($errors, $input);
}

function process_form($input) {
    if(is_readable($input['full'])) {
        print htmlentities(file_get_contents($input['full']));
    } else {
        print "{$input['file']}을 읽을 수 없습니다.";
    }
}



?>

<form method="POST" action ="<?= $form->encode($_SERVER['PHP_SELF']) ?>">
<table>
    <? if($errors) { ?>
    <tr>
        <td>다음 항목을 수정해주세요:</td>
        <td>
            <ul>
                <? foreach($errors as $error) { ?>
                    <li><?= $form->encode($error) ?></li>
                <? } ?>
            </ul>
        </td>
    </tr>
    <? } ?>
    <tr>
        <td>파일명:</td>
        <td>
            <?= $form->input('text', ['name' => 'file']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <?= $form->input('submit', ['value' => '출력']) ?>
        </td>
    </tr>
</table>
</form>