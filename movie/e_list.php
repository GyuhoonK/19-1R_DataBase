<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from evaluation natural join movie";
 
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
    <a href='e_form.php'><button class='button primary small'>영화 후기 작성</button></a>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>제목</th>
            <th>영화제목</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='e_view.php?e_id={$row['e_id']}'>{$row['title']}</a></td>";
            echo "<td>{$row['m_name']}</td>";
            echo "<td width='17%'>
                <a href='e_form.php?e_id={$row['e_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['e_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(e_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "e_delete.php?e_id=" + e_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
