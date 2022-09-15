
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel = "stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<script src="js/bootstrap.min.js"></script>
<nav class="navbar navbar-expand-md bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">홈페이지 제목</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">|||</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        게시판
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">자유게시판</a></li>
                        <li><a class="dropdown-item" href="#">묻고 답하기</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">공지사항</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<div class="container">
    <div class="">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
            <label>총 인원수를 입력하세요</label>
            <div class="input-group">
                <select name="size" class="form-select">
                    <option value="3">3줄</option>
                    <option value="4">4줄</option>
                    <option value="5">5줄</option>
                </select>
                <input name="cnt" type="text" class="form-control text-end">
                <span class="input-group-text">명</span>
                <button class="btn btn-primary">만들기</button>
            </div>
        </form>
    </div>
    <div>
        <?php
            $cnt = $_GET['cnt'];
            if(!is_numeric($cnt)|| $cnt<1){?>
                <div class="alert alert-danger">
                    숫자를 입력해야 합니다.
                </div>
            <?php
            }else{
                $size = $_GET['size'];
                for($i = 0;$i<$cnt;$i++){
                    $arr[] = $i+1;
                }
                shuffle($arr);
                ?>
            <table class="table table-bordered text-center">
                <tr>
            <?php
                for($i = 0;$i<$cnt;$i++){
                    echo "<td>".$arr[$i]."</td>";
                    if(($i+1)%$size==0){
                        echo "</tr><tr>";
                    }
                }
                $last = ($size - ($cnt % $size))%$size;
                for($i = 0;$i<$last;$i++){
                    echo "<td>0</td>";
                }
                echo "</tr>";
                echo "</table>";
            }
            ?>
    </div>
</div>
</body>
</html>
