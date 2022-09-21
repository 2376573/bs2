<!--데이터베이스에 유저 정보 저장-->
<!--유저 아이디 없이 접근 했을 경우-->
<?php
if(!isset($_POST['userid'])){
    echo "잘못된 접근입니다.";
    exit(1);
}
//비밀번호와 비밀번호 확인이 맞지 않는 경우
if($_POST['userpw'] != $_POST['userpw_r']){
    ?>
    <script>
        alert("비밀번호를 확인해주세요");
        history.go(-1);
    </script>
    <?php
    exit(1);
}
//이제부터 실행
require_once "connect.php";
$query = "insert into user2(userid, username, userpw, userip) value('{$_POST['userid']}','{$_POST['username']}', sha1('{$_POST['userpw']}'),'{$_SERVER['REMOTE_ADDR']}')";

try{
    $connect -> query($query);
    $res = $connect -> affected_rows;
}
catch (Exception $e){
    $res = 0;
}
//유저정보 저장을 성공 했을 경우
if($res){
    ?>
    <script>
        alert("회원가입이 완료되었습니다");
        location.href = "login.php";
    </script>
<?php
//실패 했을 경우    
}else{
    ?>
    <script>
        alert("회원가입을 실패했습니다");
        history.go(-1);
    </script>
<?php
}