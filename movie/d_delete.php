<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$d_id = $_GET['d_id'];

mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "delete from director where d_id = $d_id");

if(!$ret)
{
	mysqli_query($conn, "rollback"); //삭제 query 수행 실패. rollback
	msg('Query Error : '.mysqli_error($conn));
    msg('해당 감독의 영화가 등록되어있기 때문에 삭제할 수 없습니다. 먼저 영화를 삭제해주세요');
}
else
{
	mysqli_query($conn, "commit"); //삭제 query 수행 성공. commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=d_list.php'>";
}

?>

