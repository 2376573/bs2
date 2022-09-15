<?php
require_once "header.php";
?>
<div class="container">
    <form action="signup_ok.php" method="post">
        <div>
            <div class="mt-3">
                <h2>회원가입</h2>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">아이디</div>
                <div class="col-md-9">
                    <input type="text" name="userid" class="form-control" maxlength="12" minlength="4" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">이름</div>
                <div class="col-md-9">
                    <input type="text" name="username" class="form-control" maxlength="12" minlength="2" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">비밀번호</div>
                <div class="col-md-9">
                    <input type="password" name="userpw" class="form-control" maxlength="12" minlength="4" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">비밀번호확인</div>
                <div class="col-md-9">
                    <input type="password" name="userpw_r" class="form-control" maxlength="12" minlength="4" required>
                </div>
            </div>
            <div>
                <button class="btn btn-success form-control">저장하기</button>
            </div>
        </div>
    </form>
</div>
