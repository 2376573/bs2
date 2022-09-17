<?php
require_once "connect.php";

$query = "update memo2 set username = '{$_POST['username']}',txt = '{$_POST['txt']}',memodate = now() where idx = '{$_POST['idx']}' and userpw = sha1('{$_POST['userpw']}')";
$connect->query($query);
$result = $connect -> affected_rows;
?>
<script>
    <?php 
        if($result) echo "alert('수정완료'); location.href = 'memo.php'";
        else echo "alert('비밀번호가 일치하지 않습니다'); location.href = 'memo.php'";
    ?>
</script>
