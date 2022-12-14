<?php 

session_start();

$products = [
    'cuke' => '데친 해삼',
    'stomach' => '"순대"',
    'tripe' => '와인 소스 양대창',
    'taro' => '돼지고기 토란국',
    'giblets' => '곱창 소금 구이',
    'abalone' => '전복 호박 볶음',
];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    process_form();
} else {
    show_form();
}

function show_form() {
    global $products;

    if(isset($_SESSION['quantities']) && (count($_SESSION['quantities'])>0 )) {
        print "<p>주문 내역:</p><ul>";
        foreach($_SESSION['quantities'] as $field => $amount) {
            list($junk, $code) = explode('_', $field);
            $product = $products[$code];
            print "<li>$amount $product</li>";
        }
        print "</ul>";
        print '<form method="POST" action=' . htmlentities($_SERVER['PHP_SELF']) . '>';
        print '<input type="submit" value="주문 완료" />';
        print '</form>';
    } else {
        print "<p>저장된 주문 내역이 없습니다.</p>";
    }
    print '<a href="order.php">주문 페이지로 돌아가기</a>';
}

function process_form() {
    unset($_SESSION['quantities']);
    print "<p>주문해주셔서 감사합니다.</p>";
}


?>