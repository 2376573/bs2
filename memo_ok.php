
<?php
require_once "connect.php";
$lt = sha1($_POST['userpw']);
session_start();
if($_POST['userpw']!=""&&mb_strlen($_POST['txt'])<=200&&$lt==$_SESSION['userpw']){
$query = "insert into memo2(username,userpw ,txt) values('{$_POST['username']}',sha1('{$_POST['userpw']}'),'{$_POST['txt']}')";
$connect -> query($query);
$res = $connect ->affected_rows;
?>
<script>
    alert("저장되었습니다. <?=$res?>");
    location.href="memo.php";
</script>
<?php
}
else if($_SESSION['userpw'] != $lt){
    ?>
    <script>
        alert("비밀번호를 맞게 써주세요");
        history.go(-1);
    </script>
<?php
}