<?php
require_once "connect.php";
//데이터베이스에서 삭제
$query = "delete from memo2 where idx = '{$_POST['idx']}' and userpw = sha1('{$_POST['pw']}')";
$connect -> query($query);
$res = $connect ->affected_rows;
echo $query;
?>
<script>
    //성공시
    if(<?=$res?>){
        alert("삭제되었습니다.");
        location.href="memo.php";
    }
    //실패시
    else{
        alert("비밀번호가 틀렸습니다");
        history.go(-1);
    }
</script>

