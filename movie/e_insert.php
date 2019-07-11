<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$contents = $_POST['contents'];
$m_id = $_POST['m_id'];
//trancastion 수정
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$query = "select title from evaluation where title = '$title'";
$res = mysqli_query($conn,$query);

if(!$res){
	alert_message('Query Error : '.mysqli_error($conn));
}
$row = mysqli_fetch_array($res);


$ret = mysqli_query($conn, "insert into evaluation (title, m_id, contents) values('$title', '$m_id', '$contents')");
if(!$ret)
{
	mysqli_query($conn, "rollback"); // 등록 query 수행 실패. 수행 전으로 rollback
	alert_message('Query Error : '.mysqli_error($conn));
}
else
{
	$e_id = mysqli_insert_id($conn);
	mysqli_query($conn, "commit"); // 등록 query 수행 성공. 수행 내역 commit
	s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=e_list.php'>";
}

?>

