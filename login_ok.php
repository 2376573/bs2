<?php
//$_POST값 없이 들어왔을 경우
if(!isset($_POST)){
    echo "잘못된 접근 입니다";
    exit(1);
}
require_once "connect.php";
$query = "select * from user2 where userid='{$_POST['userid']}' and userpw = sha1('{$_POST['userpw']}')";
$res = $connect -> query($query) -> fetch_all(1);

//데이터베이스에 유저가 입력한 정보가 있다면 로그인 후 메인페이지로
if(count($res) == 1){
    $user = $res[0];
    session_start();
    //세션에 유저 정보 저장
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
//아니라면 다시 로그인창으로
else{
    ?>
    <script>
        alert("로그인 실패");
        history.go(-1);
    </script>
<?php
}