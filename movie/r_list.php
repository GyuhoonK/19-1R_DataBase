<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from recommend natural join genre";
  
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
	<a href='r_form.php'><button class='button primary small'>장르 추천 게시물 작성</button></a>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>제목</th>
            <th>장르</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='r_view.php?r_id={$row['r_id']}'>{$row['title']}</a></td>";
            echo "<td>{$row['g_name']}</td>";
            echo "<td width='17%'>
                <a href='r_form.php?r_id={$row['r_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['r_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(r_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "r_delete.php?r_id=" + r_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
