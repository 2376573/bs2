<?php
require_once "connect.php";
//자신이 위치하고 있는 페이지
$page = $_GET['page']??1;

//한 페이지당 최대 게시물 개수
$rows = 10;

//자신이 위치하고 있는 페이지가 4라면 게시물의 30번째 부터 10개 표시
$now = ($page - 1) * $rows;

//검색 내용이 있다면 검색한 정보만 가져오기
if(isset($_GET['search_value']) && $_GET['search_value'] != ""){
    $total = "select count(*) as cnt from memo2 where {$_GET['search_type']} like '%{$_GET['search_value']}%'";
    $query ="select idx,username,memodate, txt from memo2 where {$_GET['search_type']} like '%{$_GET['search_value']}%' order by idx desc limit {$now}, {$rows}";
}
//검색 내용이 없다면 모든 정보를 가져오기
else{
    $total = "select count(*) as cnt from memo2";
    $query = "select idx,username, memodate, txt from memo2 order by idx desc limit {$now}, {$rows}";
}
//현재 개수
$cnt = $connect -> query($total)->fetch_all(1)[0]['cnt'];
//select한 결과물
$result = $connect->query($query)->fetch_all(1);
$url = "http://".$_SERVER['HTTP_HOST'];
session_start();
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
<!--fontawesome-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--ckeditor-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/34.1.0/ckeditor.min.js" integrity="sha512-RvP4YtcpRcd5+PFgOCIEat6eHD2mAjflHdzpfTJc2giz2FsmDETkM1DZO6EkwUWj1nZySTR2fm22GZq9nlo5Rg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--메인 페이지-->
<div class="container">
        <div class="">
                <!--글쓰기 버튼을 눌렀을 경우 로그인이 되어있으면 글쓰기 모달 띄우기 아니면 로그인 알림창 띄우기-->
                <button type="button" class="btn btn-primary" <?php if(isset($_SESSION['userid'])){?> data-bs-toggle="modal" data-bs-target="#exampleModal" <?php } else {?> onclick="pw()" <?php } ?> id="bt" >
                    <i class="fa-solid fa-pen"></i> 글쓰기
                </button>
                <script>
                    function pw(){
                        alert("로그인 해주세요");
                    }
                </script>
            <!--로그인 회원가입 로그아웃 버튼 생성-->
            <div class="float-end">
                <?php
                //로그인이 되어있지 않으면 로그인, 회원가입 버튼 띄우기
                if(!isset($_SESSION['userid'])){
                    ?>
                    <button type="button" class="btn btn-primary ms-1"  onclick="location.href='login.php'">
                        <i class="fa-solid fa-user"></i> 로그인
                    </button>
                    <button type="button" class="btn btn-primary ms-1" onclick="location.href='signup.php'">
                        회원가입
                    </button>
                <!--아니면 로그아웃 버튼 띄우기-->
                <?php } else {?>
                    <button type="button" class="btn btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#logout">
                         로그아웃
                    </button>
                <?php } ?>
            <!--검색-->
            </div>
                <!--자신에게 반환-->
                <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
                    <div class=" col-md-6">
                        <div class="input-group">
                            <select class="btn btn-secondary" name="search_type">
                                <option value="username" <?php
                                //작성자를 검색한 상태면 작성자로 selected
                                if(isset($_GET['search_type'])&&$_GET['search_type'] == "username"){
                                    echo "selected";
                                } ?>>작성자</option>

                                <!--내용을 검색한 상태면 내용으로 selected-->
                                <option value="txt" <?php
                                if(isset($_GET['search_type'])&&$_GET['search_type'] == "txt"){
                                    echo "selected";
                                }
                                 ?>>내용</option>
                            </select>
                            <input name="search_value" class="form-control" type="text" value="<?php
                                //검색 정보가 이미 있다면 검색 정보 남기기
                                if(isset($_GET['search_value']) && $_GET['search_value'] != ""){
                                   echo $_GET['search_value'];
                                }
                            ?>">
                            <button class="btn btn-primary">검색</button>
                        </div>
                    </div>
                </form>
                <!--메모장-->
                <div>
                    <?php
                        foreach ($result as $lt){
                        ?>
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                            <?=$lt['username']?>님의 글입니다.
                            </div>
                            <div>
                                <!--수정 및 삭제-->
                                <a href="memo_edit.php?idx=<?=$lt['idx']?>">
                                    <i class="fa-solid fa-gears fa-xl"></i>
                                </a>
                                <a href="memo_del.php?idx=<?=$lt['idx']?>">
                                    <i class="fa-solid fa-trash-can fa-xl fa-beat fa-rotate-90"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?=nl2br($lt['txt'])?>
                        </div>
                        <div class="card-footer small fst-italic">
                            <?=$lt['memodate']?>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>

            <!-- 로그아웃 modal -->
            <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">정말 로그아웃 하시겠습니까?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">아니요</button>
                            <button type="button" class="btn btn-primary" onclick="location.href='logout.php'">네</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--글쓰기 modal-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">글쓰기</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="memo_ok.php" method="post">
                            <div class="modal-body">
                                <div class="">
                                    <div class="mb-3">
                                        <label >이름</label>
                                        <input class="form-control" type="text" name="username" maxlength="20" value="<?=$_SESSION['username']?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label >비밀번호</label>
                                        <input class="form-control" type="password" name="userpw" maxlength="20" required>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" name="txt" required></textarea>
                                        <script>
                                            ClassicEditor
                                                .create( document.querySelector( 'textarea' ), {
                                                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                                                    heading: {
                                                        options: [
                                                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                                                        ]
                                                    }
                                                } )
                                                .catch( error => {
                                                    console.log( error );
                                                } );
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">저장하기</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Pagination-->
<?php
//총 페이지 개수
$pages = ceil($cnt/$rows);
//자신이 위치하고 있는 페이지를 기준으로 시작 번호 생성
$start = floor(($page-1) / 10) * 10 + 1;
//마지막 페이지 번호 생성
$last = min($start + 9, $pages);
?>
<div class = "container">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            for($i = $start; $i <= $last; $i++){
                if(isset($_GET['search_value']) && $_GET['search_value'] != ""){
                    $search = "&search_type={$_GET['search_type']}&search_value={$_GET['search_value']}";
                }else{
                    $search = "";
                }
                //자신이 위치하고 있는 페이지 확인 변수
                $active = $i == $page ? "active" : "";
                ?>
                    <!-- pagination 리스트 생성 -->
                <li class="page-item <?=$active?>">
                    <a class="page-link" href="<?=$url?>/bs2/memo.php?page=<?=$i?><?=$search?>"><?=$i?></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </nav>
</div>
</body>
</html>