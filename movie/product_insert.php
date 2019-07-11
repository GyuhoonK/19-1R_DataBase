<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$m_name = $_POST['m_name'];
$summary = $_POST['summary'];
$g_id = $_POST['g_id'];
$year = $_POST['year'];
$d_id = $_POST['d_id'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$query = "select m_name from movie m_name = ''$m_name'";
$res = mysqli_query($conn, $query);

$ret = mysqli_query($conn, "insert into movie (m_name, year, summary, g_id,d_id) values('$m_name', '$year', '$summary', '$g_id','$d_id')");

if(!$ret)
{
	mysqli_query($conn, "rollback"); // 등록 query 수행 실패. 수행 전으로 rollback
	alert_message('Query Error : '.mysqli_error($conn));
}
else
{
	$m_id = mysqli_insert_id($conn);
	mysqli_query($conn, "commit"); //  등록 query 수행 성공. 수행 내역 commit
	s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=product_list.php'>";
}

?>

