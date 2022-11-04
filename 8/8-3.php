<?php

//클래스 불러오기
require 'FormHelper.php';

//db접속 및 예외 설정
try {
    $db = new PDO('pgsql:/tmp/restaurant.db');
} catch (PDOException $e) {
    print "접속할 수 없습니다: " . $e->getMessage();
    exit();
}

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

//폼 검사
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
    global $db;

    $form = new FormHelper();

    $sql = 'SELECT dish_id, dish_name FROM dishes ORDER BY dish_name';
    $stmt = $db->query($sql);
    $dishes = array();
    while($row = $stmt->fetch()) {
        $dishes[$row->dish_id] = $row->dish_name;
    }
    include 'dish-form.php';
}

function validate_form() {
    $input = array();
    $errors = array();

    if(isset($_POST['dish_id'])) {
        $input['dish_id'] = $_POST['dish_id'];
    } else {
        $errors[] = '메뉴를 선택하세요.';
    }
    return array($errors, $input);
}

function process_form($input) {
    global $db;

    $sql = 'SELECT dish_id, dish_name, price, is_spicy FROM dishes WHERE dish_id = ?';

    $stmt = $db->prepare($sql);
    $stmt->execute(array($input['dish_id']));
    $dish = $stmt->fetch();;

    if(count($dish) == 0) {
        print '발견된 메뉴가 없습니다.';
    } else {
        print '<table>';
        print '<tr><th>ID</th><th>메뉴명</th><th>가격</th>';
        print '<th>맵기</th></tr>';
        if($dish->is_spicy == 1) {
            $spicy = 'Yes';
        } else {
            $spicy = 'No';
        }

        printf('<tr><td>%d</td><td>%s</td><td>$%.02f</td><td>%s</td></tr>',
            $dish->dish_id,
            htmlentities($dish->dish_name), $dish->price, $spicy);
        print '</table>';

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
        <td>메뉴:</td>
        <td><?= $form->input('text',['name' => 'dish_id']) ?></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <?= $form->input('submit', ['name' => 'info', 'values' => '메뉴 정보']) ?>
        </td>
    </tr>
</table>
</form>