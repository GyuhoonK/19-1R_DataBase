<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$r_id = $_POST['r_id'];
$title = $_POST['title'];
$contents = $_POST['contents'];
$g_id = $_POST['g_id'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "update recommend set g_id = '$g_id', title = '$title', contents = '$contents', title = '$title' where r_id = $r_id");

if(!$ret)
{
	mysqli_query($conn,"rollback"); // 실패시 roll back
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn,"commit"); //성공시 commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=r_list.php'>";
}

?>

