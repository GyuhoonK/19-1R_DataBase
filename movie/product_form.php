<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "product_insert.php";

if (array_key_exists("m_id", $_GET)) {
    $m_id = $_GET["m_id"];
    $query =  "select * from movie where m_id = $m_id";
    $res = mysqli_query($conn, $query);
    $movie = mysqli_fetch_array($res);
    if(!$movie) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "product_modify.php";
}

$genre = array();

$query = "select * from genre";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $genre[$row['g_id']] = $row['g_name'];
}

$query = "select * from director";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $director[$row['d_id']] = $row['d_name'];

}


?>
    <div class="container">
        <form name="product_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="m_id" value="<?=$movie['m_id']?>"/>
            <h3>영화 정보 <?=$mode?></h3>
            <p>
                <label for="g_id">장르</label>
                <select name="g_id" id="g_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($genre as $id => $name) {
                            if($id == $movie['g_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="d_id">감독</label>
                <select name="d_id" id="d_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($director as $id => $name) {
                            if($id == $movie['d_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="m_name">영화이름</label>
                <input type="text" placeholder="영화명 입력" id="m_name" name="m_name" value="<?=$movie['m_name']?>"/>
            </p>
            <p>
                <label for="summary">영화줄거리</label>
                <textarea placeholder="영화줄거리 입력" id="summary" name="summary" rows="10"><?=$movie['summary']?></textarea>
            </p>
            <p>
                <label for="year">개봉일</label>
                <input type="date" placeholder="YYYY-MM-DD" id="year" name="year" value="<?=$movie['year']?>" />
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("g_id").value == "-1") {
                        alert ("장르를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("m_name").value == "") {
                        alert ("영화제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("summary").value == "") {
                        alert ("영화줄거리를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("year").value == "") {
                        alert ("개봉날짜을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>