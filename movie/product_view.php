<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("m_id", $_GET)) {
    $m_id = $_GET["m_id"];
    $query = "select * from movie natural join genre,director where m_id = $m_id";
    $res = mysqli_query($conn, $query);
    $movie = mysqli_fetch_assoc($res);
    if (!$movie) {
        msg("존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>영화 정보 상세 보기</h3>

        <p>
            <label for="m_id">영화 코드</label>
            <input readonly type="text" id="m_id" name="m_id" value="<?= $movie['m_id'] ?>"/>
        </p>

        <p>
            <label for="g_id">장르</label>
            <input readonly type="text" id="g_name" name="g_name" value="<?= $movie['g_name'] ?>"/>
        </p>

        <p>
            <label for="g_name">감독</label>
            <input readonly type="text" id="d_name" name="d_name" value="<?= $movie['d_name'] ?>"/>
        </p>

        <p>
            <label for="m_name">영화제목</label>
            <input readonly type="text" id="m_name" name="m_name" value="<?= $movie['m_name'] ?>"/>
        </p>

        <p>
            <label for="summary">영화설명</label>
            <textarea readonly id="summary" name="summary" rows="10"><?= $movie['summary'] ?></textarea>
        </p>

        <p>
            <label for="year">개봉일</label>
            <input readonly type="text" id="year" name="year" value="<?= $movie['year'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>