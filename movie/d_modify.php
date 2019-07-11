<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$d_name = $_POST['d_name'];
$d_id = $_POST['d_id'];
$birth = $_POST['birth'];
$content = $_POST['content'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "update director set d_name = '$d_name', birth = '$birth', content = '$content' where d_id = $d_id");

if(!$ret)
{
	 mysqli_query($conn, "rollback"); // 수정  query 수행 실패. 수행 전으로 rollback
	msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); //수정 query 수행 성공. commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=d_list.php'>";
}

?>

