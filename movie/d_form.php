<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "d_insert.php";

if (array_key_exists("d_id", $_GET)) {
    $d_id = $_GET["d_id"];
    $query =  "select * from director where d_id = $d_id";
    $res = mysqli_query($conn, $query);
    $director = mysqli_fetch_array($res);
    if(!$director) {
        msg("존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "d_modify.php";
}


?>
    <div class="container">
        <form name="d_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="d_id" value="<?=$director['d_id']?>"/>
            <h3>감독 정보 <?=$mode?></h3>
       
            <p>
                <label for="m_name">감독이름</label>
                <input type="text" placeholder="이름" id="d_name" name="d_name" value="<?=$director['d_name']?>"/>
            </p>
            <p>
                <label for="birth">생년월일</label></label>
                <input type="text" placeholder="YYYY-MM-DD" id="birth" name="birth" value="<?=$director['birth']?>"/>
            </p>
            <p>
                <label for="content">설명</label>
                <textarea placeholder="설명" id="content" name="content" rows="10"><?=$director['content']?></textarea>
            </p>
          

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("d_name").value == "-1") {
                        alert ("감독이름을 입력해주십시오"); return false;
                    }
                    else if(document.getElementById("birth").value == "") {
                        alert ("생년월일을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("content").value == "") {
                        alert ("설명을 입력해 주십시오"); return false;
                    }
                   
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>