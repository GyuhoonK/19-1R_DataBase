<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$e_id = $_GET['e_id'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation


$ret = mysqli_query($conn, "delete from evaluation where e_id = $e_id");

if(!$ret)
{
	mysqli_query($conn, "rollback"); //삭제 실패시 rollback
	msg('Query Error :'.mysqli_error($conn));
}
else
{
	mysqli_query($conn,"commit"); //삭제 성공시 commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=e_list.php'>";
}

?>

