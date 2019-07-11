<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$d_name = $_POST['d_name'];
$content = $_POST['content'];
$birth = $_POST['birth'];

//transaction 구현
mysqli_query($conn, "set autocommit = 0");  // autocommit 해제
mysqli_query($conn, "set transation isolation level serializable"); // isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$query = "select d_name from director where d_name = '$d_name'";
$res = mysqli_query($conn, $query);

if(!$res)
{
	alert_message('Query Error : '.mysqli_error($con));
}


	$ret = mysqli_query($conn, "insert into director set d_name=\"$d_name\", content=\"$content\", birth=\"$birth\"");
	
	if($ret){	// insert new director successful
	$d_id = mysqli_insert_id($conn);
	mysqli_query($conn, "commit"); //수행 내역 commit
	s_msg ('성공적으로 입력 되었습니다');
	echo "<meta http-equiv='refresh' content='0;url=d_list.php'>";
	}
	
	else{	// insert new director fail
		mysqli_query($conn, "rollback"); //등록 query 수행 실패. 수행 전으로 rollback
		alert_message('Query Error : '.mysqli_error($conn));
	}


?>

