<?php require_once "header.php";
?>
<div class="container">
    <form action="login_ok.php" method="post">
        <div>
            <div class="row mt-3">
                <div class="col-md-3">아이디</div>
                <div class="col-md-9">
                    <input type="text" name="userid" class="form-control" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">비밀번호</div>
                <div class="col-md-9">
                    <input type="password" name="userpw" class="form-control" required>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary form-control">확인</button>
            </div>
        </div>
    </form>
</div>
