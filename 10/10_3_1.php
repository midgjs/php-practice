<?php

//세션 활성화 가장 처음에
session_start();

require 'FormHelper.php';

$colors = array(
    'ff0000' => 'Red',
    'ffa500' => 'Orange',
    'ffffff' => 'Yellow',
    '008000' => 'Green',
    '0000ff' => 'Blue',
    '4b0082' => 'Indigo',
    '663399' => 'Rebecca Purple',
);

//폼 검증
if($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    global $colors;

    $form = new FormHelper();
    include 'color-form.php';
}

function validate_form() {
    $input = array();
    $errors = array();

    $input['color'] = $_POST['color'] ?? '';
    if(! array_key_exists($input['color'], $GLOBALS['colors'])) {
        $errors[] = '올바른 색상을 선택하세요';
    }
    return array($errors, $input);

    function process_form($input) {
        global $colors;
        $_SESSION['background_color'] = $input['color'];
        print '<p>선택한 색상이 적용됐습니다.</p>';
    }
}



?>

<form method="POST" action="<?= $form->encode($_SERVER['PHP_SELF']) ?>">
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
        <td>마음에 드는 색상을 고르세요:</td>
        <td><?= $form->select($colors,['name' => 'color']) ?></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <?= $form->input('submit', ['name' => 'set', 'value' => '색상 설정']) ?>
        </td>
    </tr>
</table>

</form>

