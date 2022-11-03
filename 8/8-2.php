<?php

require 'FormHelper.php';

//DB 검증
try {
    $db = new PDO('pgsql:/tmp/restaurant.db');
} catch (PDOException $e) {
    echo "접속할 수 없습니다: " . $e->getMessage();
    exit();
}

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

//FORM 검증
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
    $form = new FormHelper();
    include 'price-form.php';
}

function validate_form() {
    $input = array();
    $errors = array();

    $input['min_price'] = filter_input(INPUT_POST,'min_price',
    FILTER_VALIDATE_FLOAT);
    if($input['min_price'] === null || $input['min_price'] === false) {
        $errors[] = '최저 가격을 올바르게 입력해주세요.';
    }
    return array($errors, $input);
}

function process_form($input) {
    global $db;

    $sql = 'SELECT dish_name, price, is_spicy FROM dishes WHERE price >= ?';

    $stmt = $db->prepare($sql);
    $stmt->execute(array($input['min_price']));
    $dishes = $stmt->fetchAll();
    if(count($dishes) == 0) {
        echo '발견된 메뉴가 없습니다.';
    } else {
        echo '<table>';
        echo '<tr><th>메뉴명</th><th>Price</th><th>맵기</th></tr>';
        foreach($dishes as $dish) {
            if($dish->is_spicy == 1) {
                $spicy = 'Yes';
            } else {
                $spicy = 'No';
            }
            printf('<tr><td>%s</td><td>$%.02f</td><td>%s</td></tr>',
                htmlentities($dish->dish_name), $dish->price, $spicy);
        }
        echo '</table>';
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
                <? foreach ($errors as $error) { ?>
                    <li><?= $form->encode($error) ?></li>
                <? } ?>
            </ul>
        </td>
    </tr>
    <? } ?>
    <tr>
        <td>최저 가격:</td>
        <td><?= $form->input('text',['name' => 'min_price']) ?></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <?= $form->input('submit', ['name' => 'search', 'values' => '검색']) ?>
        </td>
    </tr>
</table>
</form>