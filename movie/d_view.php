<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("d_id", $_GET)) {
    $d_id = $_GET["d_id"];
    $query = "select * from director natural left outer join movie where d_id = $d_id";
    $res = mysqli_query($conn, $query);
    $director = mysqli_fetch_assoc($res);
    if (!$director) {
        msg("존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>감독 상세 정보</h3>

        <p>
            <label for="d_id">감독 코드</label>
            <input readonly type="text" id="d_id" name="d_id" value="<?= $director['d_id'] ?>"/>
        </p>
        
        <p>
            <label for="d_name">이름</label>
            <input readonly type="text" id="d_name" name="d_name" value="<?= $director['d_name'] ?>"/>
        </p>
        
        <p>
            <label for="birth">생년월일</label>
            <input readonly type="text" id="birth" name="birth" value="<?= $director['birth'] ?>"/>
        </p>
        <p>
            <label for="content">감독설명</label>
            <textarea readonly id="content" name="content" rows="10"><?= $director['content'] ?></textarea>
        </p>
        <p>
            <label for="m_name">작품활동</label>
            <input readonly type="text" id="m_name" name="m_name" value="<?= $director['m_name'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>