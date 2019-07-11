<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "r_insert.php";

if (array_key_exists("r_id", $_GET)) {
    $r_id = $_GET["r_id"];
    $query =  "select * from recommend where r_id = $r_id";
    $res = mysqli_query($conn, $query);
    $recommend = mysqli_fetch_array($res);
    if(!$recommend) {
        msg("존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "r_modify.php";
}

$genre = array();

$query = "select * from genre";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $genre[$row['g_id']] = $row['g_name'];
}

?>
    <div class="container">
        <form name="r_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="r_id" value="<?=$recommend['r_id']?>"/>
            <h3>장르 추천 <?=$mode?></h3>
            <p>
                <label for="g_id">장르</label>
                <select name="g_id" id="g_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($genre as $id => $name) {
                            if($id == $recommend['g_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="m_name">제목</label>
                <input type="text" placeholder="제목 입력" id="title" name="title" value="<?=$recommend['title']?>"/>
            </p>
            <p>
                <label for="summary">내용</label>
                <textarea placeholder="내용" id="contents" name="contents" rows="10"><?=$recommend['contents']?></textarea>
            </p>


            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("g_id").value == "-1") {
                        alert ("장르를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("contents").value == "") {
                        alert ("내용 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>