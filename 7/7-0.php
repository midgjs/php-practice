<?php
?>

<form method="POST" action="7-1.php"?
면에 곁들일 재료: <select name="noodle">
<option>게살</option>
<option>버섯</option>
<option>돼지고기</option>
<option>저민 생강과 파</option>
</select>
<br/>
Sweet:<select name="sweet[]" multiple>
<option value="puff"> 참깨 퍼프
<option value="square"> 코코넛 우유 젤리
<option value="cake"> 흑설탕 케이크
<option value="ricemeat"> 찹쌀 경단
</select>
<br/>
디저트 수량: <input type="text" name="sweet_q">
<br/>
<input type="submit" name="submit" value="주문">
</form>
<?

?>