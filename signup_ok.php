<?php
if(!isset($_POST['userid'])){
    echo "잘못된 접근입니다.";
    exit(1);
}
if($_POST['userpw'] != $_POST['userpw_r']){
    ?>
    <script>
        alert("비밀번호를 확인해주세요");
        history.go(-1);
    </script>
    <?php
    exit(1);
}
require_once "connect.php";
$query = "insert into user2(userid, username, userpw, userip) value('{$_POST['userid']}','{$_POST['username']}', sha1('{$_POST['userpw']}'),'{$_SERVER['REMOTE_ADDR']}')";

try{
    $connect -> query($query);
    $res = $connect -> affected_rows;
}
catch (Exception $e){
    $res = 0;
}
if($res){
    ?>
    <script>
        alert("회원가입이 완료되었습니다");
        location.href = "login.php";
    </script>
<?php
}else{
    ?>
    <script>
        alert("회원가입을 실패했습니다");
        history.go(-1);
    </script>
<?php
}