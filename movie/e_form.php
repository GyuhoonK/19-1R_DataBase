<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "e_insert.php";

if (array_key_exists("e_id", $_GET)) {
    $e_id = $_GET["e_id"];
    $query =  "select * from evaluation where e_id = $e_id";
    $res = mysqli_query($conn, $query);
    $evaluation = mysqli_fetch_array($res);
    if(!$evaluation) {
        msg("존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "e_modify.php";
}

$movie = array();

$query = "select * from movie";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $movie[$row['m_id']] = $row['m_name'];
}

?>
    <div class="container">
        <form name="e_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="e_id" value="<?=$evaluation['e_id']?>"/>
            <h3>영화 추천 게시물 <?=$mode?></h3>
       
            <p>
                <label for="title">제목</label>
                <input type="text" placeholder="이름" id="title" name="title" value="<?=$evaluation['title']?>"/>
            </p>
           <p>
                <label for="m_id">영화</label>
                <select name="m_id" id="m_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($movie as $id => $name) {
                            if($id == $evaluation['m_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="content">내용</label>
                <textarea placeholder="내용" id="contents" name="contents" rows="10"><?=$evaluation['contents']?></textarea>
            </p>
          

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("title").value == "-1") {
                        alert ("제목을 입력해주십시오"); return false;
                    }
                    else if(document.getElementById("m_id").value == "") {
                        alert ("영화를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("contents").value == "") {
                        alert ("내용을 입력해 주십시오"); return false;
                    }
                   
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>