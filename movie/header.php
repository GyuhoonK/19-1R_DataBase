<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>MOVIE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="product_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">MOVIE</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="movie 검색(제목 or 감독)">
                </li>
                <li><a href='product_list.php'>영화 목록</a></li>
                <li><a href='d_list.php'>감독 목록</a></li>
                <li><a href='r_list.php'>추천 목록</a></li>
                <li><a href='e_list.php'>후기 목록</a></li>
                <li><a href='site_info.php'>소개</a></li>
            </ul>
        </div>
    </div>
</form>