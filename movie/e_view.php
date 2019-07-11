<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("e_id", $_GET)) {
    $e_id = $_GET["e_id"];
    $query = "select * from evaluation natural join movie where e_id = $e_id";
    $res = mysqli_query($conn, $query);
    $evaluation = mysqli_fetch_assoc($res);
    if (!$evaluation) {
        msg("존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>감독 상세 정보</h3>

        <p>
            <label for="e_id">게시물 코드</label>
            <input readonly type="text" id="e_id" name="e_id" value="<?= $evaluation['e_id'] ?>"/>
        </p>
        
        <p>
            <label for="title">제목</label>
            <input readonly type="text" id="title" name="title" value="<?= $evaluation['title'] ?>"/>
        </p>
        
        <p>
            <label for="m_name">영화</label>
            <input readonly type="text" id="m_name" name="m_name" value="<?= $evaluation['m_name'] ?>"/>
        </p>
        <p>
            <label for="contetns">내용</label>
            <textarea readonly id="contents" name="contents" rows="10"><?= $evaluation['contents'] ?></textarea>
        </p>
   
    </div>
<? include("footer.php") ?>