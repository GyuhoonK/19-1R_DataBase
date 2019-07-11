<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("r_id", $_GET)) {
    $r_id = $_GET["r_id"];
    $query = "select * from recommend natural join genre where r_id = $r_id";
    $res = mysqli_query($conn, $query);
    $recommend = mysqli_fetch_assoc($res);
    if (!$recommend) {
        msg("존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>추천 게시물 보기</h3>

        <p>
            <label for="r_id">게시물 코드</label>
            <input readonly type="text" id="r_id" name="r_id" value="<?= $recommend['r_id'] ?>"/>
        </p>
        
        <p>
            <label for="title">제목</label>
            <input readonly type="text" id="title" name="title" value="<?= $recommend['title'] ?>"/>
        </p>
        
        <p>
            <label for="g_name">장르</label>
            <input readonly type="text" id="g_name" name="g_name" value="<?= $recommend['g_name'] ?>"/>
        </p>

        <p>
            <label for="contents">내용</label>
            <textarea readonly id="contents" name="contents" rows="10"><?= $recommend['contents'] ?></textarea>
        </p>

    </div>
<? include("footer.php") ?>