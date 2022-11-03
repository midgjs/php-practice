<?php

require 'FormHelper.php';

try {
    $db = new PDO('pgsql:/tmp/restaurant.db');
} catch (PDOException $e) {
    echo "접속할 수 없습니다: " . $e->getMessage();
    exit();
}

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$dishes = array();
$sql = 'SELECT dish_id, dish_name FROM dishes ORDER BY dish_name';
$stmt = $db->query($sql);
while($row = $stmt->fetch()) {
    $dishes[$row->dish_id] = $row->dish_name;
}

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
        <td>이름:</td>
        <td><?= $form->input('text',['name' => 'name']) ?></td>
    </tr>
    <tr>
        <td>전화번호:</td>
        <td><?= $form->input('text',['name' => 'phone']) ?></td>
    </tr>
    <tr>
        <td>선호메뉴:</td>
        <td><?= $form->select($dishes,['name' => 'dish_id']) ?></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <?= $form->input('submit', ['name' => 'add', 'values' => '고객 등록']) ?>
        </td>
    </tr>
</table>
</form>