<?php

function process_form() {
    print '<ul>';
    foreach ($_POST as $k => $v) {
        print '<li>' . htmlentities($k) .'=' . htmlentities($v) . '</li>';
    }
    print '</ul>';
}


































?>