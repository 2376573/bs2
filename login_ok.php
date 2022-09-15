<?php
if(!isset($_POST)){
    echo "잘못된 접근 입니다";
    exit(1);
}
require_once "connect.php";
$query = "select * from user2 where userid='{$_POST['userid']}' and userpw = sha1('{$_POST['userpw']}')";
$res = $connect -> query($query) -> fetch_all(1);
if(count($res) == 1){
    $user = $res[0];
    session_start();
    $_SESSION['userid'] = $user['userid'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['userpw'] = $user['userpw'];
    $_SESSION['idx'] = $user['idx'];
    ?>
    <script>
        location.href="memo.php";
    </script>
    <?php
}
else{
    ?>
    <script>
        alert("로그인 실패");
        history.go(-1);
    </script>
<?php
}