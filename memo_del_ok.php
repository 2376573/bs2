<?php
require_once "connect.php";

$query = "delete from memo2 where idx = '{$_POST['idx']}' and userpw = '{$_POST['pw']}'";
$connect -> query($query);
$res = $connect ->affected_rows;
echo $query;
?>
<script>
    if(<?=$res?>){
        alert("삭제되었습니다.");
        location.href="memo.php";
    }
    else{
        alert("비밀번호가 틀렸습니다");
        history.go(-1);
    }
</script>

