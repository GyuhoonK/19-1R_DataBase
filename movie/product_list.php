<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from (select * from movie natural join director) as t natural join genre";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where m_name like '%$search_keyword%' or d_name like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>감독</th>
            <th>영화제목</th>
            <th>개봉일</th>
            <th>장르</th>
        </tr>
        </thead>
        <tbody>
        <a href='product_form.php'><button class='button primary small'>영화 등록</button></a>

        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['d_name']}</td>";
            echo "<td><a href='product_view.php?m_id={$row['m_id']}'>{$row['m_name']}</a></td>";
            echo "<td>{$row['year']}</td>";
            echo "<td>{$row['g_name']}</td>";
            echo "<td width='17%'>
                <a href='product_form.php?m_id={$row['m_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['m_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(m_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "product_delete.php?m_id=" + m_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
