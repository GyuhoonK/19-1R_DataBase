<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$m_id = $_POST['m_id'];
$m_name = $_POST['m_name'];
$summary = $_POST['summary'];
$g_id = $_POST['g_id'];
$year = $_POST['year'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "update movie set m_name = '$m_name', summary = '$summary', g_id = $g_id, year = $year where m_id = $m_id");

if(!$ret)
{
	mysqli_query($conn,"rollback"); // 실패 시 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn,"commit"); //성공시 commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_list.php'>";
}

?>

