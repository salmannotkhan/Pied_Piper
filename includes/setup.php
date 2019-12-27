<?php
    if(isset($_POST["submit"])){
        $query = "INSERT INTO CLASS_SUB VALUES";
    }
?>
<div class="minicontainer">
    <form method="post" class="box">
    <select name="course">
        <option value="bca">BCA</option>
        <option value="bba">BBA</option>
    </select>
    <div class="sem">Number of Sem : <input type="number" name="sem" max="10" min="0" style="width:35px;"></div>
    <input type="submit" value="Setup">
    </form>
</div>