<?php

session_start();

require 'FormHelper.php';

$products = [
    'cuke' => '데친 해삼',
    'stomach' => '"순대"',
    'tripe' => '와인 소스 양대창',
    'taro' => '돼지고기 토란국',
    'giblets' => '곱창 소금 구이',
    'abalone' => '전복 호박 볶음',
];

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
    global $products;
    $defaults = array();
    foreach ($products as $code => $label) {
        $defaults["quantity_$code"] = 0;
    }
    if(isset($_SESSION['quantities'])) {
        foreach($_SESSION['quantities'] as $field => $quantity) {
            $defaults[$field] = $quantity;
        }
    }
    $form = new FormHelper($defaults);
    include 'order-form.php';
}

function validate_form() {
    global $products;

    $input = array();
    $errors = array();

    foreach($products as $code => $name) {
        $field = "quantity_$code";
        $input[$field] = filter_input(INPUT_POST, $field, FILTER_VALIDATE_INT, ['options' => ['min_range'=>0]]);
        
        if(is_null($input[$field]) || ($input[$field] === false )) {
            $errors[] = "$name 의 수량을 올바르게 입력해주세요.";
        }
    }
    return array($errors, $input);
}

function process_form($input) {
    $_SESSION['quantities'] = $input;
    print "주문해주셔서 감사합니다.";
}
?>

<form method="POST" action="<?= $form->encode($_SERVER['PHP_SELF']) ?> ">
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
        <th>메뉴</th>
        <td>수량</td>
    </tr>

    <? foreach($products as $code=>$name) { ?>
    <tr>
        <td>
            <?= htmlentities($name) ?>:
        </td>
        <td>
            <?= $form->input('text', ['name' => "quantity_$code"]) ?>
        </td>
    </tr>
    <? } ?>
    <tr>
        <td colspan="2" align="center">
            <?= $form->input('submit', ['value' => '주문하기']) ?>
        </td>
    </tr>
</table>
</form>