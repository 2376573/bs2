<?php
//세션 내의 정보 삭제 후 돌아가기
session_start();
$_SESSION = Array();
?>

    <script>
            history.go(-1);
    </script>