<?php if($_GET['idx']){?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<form action="memo_del_ok.php" method="post">
    <div class="container">
        <div class="">
            <div class="alert alert-warning mb-3">
                정말 삭제하시겠습니까?
            </div>
            <div>
                <input type="password" name = "pw" class="form-control mb-3" placeholder="비밀번호를 입력하세요" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" onclick="history.go(-1)" class=" btn btn-secondary">
                    취소
                </button>
                <button class=" btn btn-danger">
                    삭제
                </button>
            </div>
        </div>
    </div>
    <input type="hidden" name="idx" value="<?=$_GET['idx']?>">
</form>

</body>
</html>
<?php } else {?>
    <script>
        alert("해킹하지마세요");
        location.href="memo.php";
    </script>
<?php } ?>

