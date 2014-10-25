<?php
// DB接続
// DBに接続できたかを常に確認する
$dbh = mysql_connect("localhost:3306", "root") or die('I cannot connect to the database because：'. mysql_error());

mysql_select_db('phppro', $dbh);
// スレッド取得し，作成日時に関して降順で並べる（mysqlにクエリを送っている）
// スレッドを取得できたかを常に確認する
$sql = 'SELECT * FROM threads order by created_at desc';
$result = mysql_query($sql) or die('query error：' . mysql_error());

// // MySQLに対する処理
// $close_flag = mysql_close($dbh);
// if ($close_flag) {
// 	echo '<p>切断に成功しました．</p>';
// }

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html"; charset=utf-8 />
<title>掲示板ホーム</title>
</head>
<body>
<p><a href="thread_new.php">スレッド作成</a></p>
<table>
<!-- スレッドが作成してあった場合に実行 -->
<?php
// 「：」は開き波括弧と同じ意味
while($thread = mysql_fetch_array($result)):?>
			<tr><td><a href="thread.php?id=<?php echo $thread['id'];?>"><?php echo $thread['title'];?>
</a></td><td><?php echo $thread['created_at'];?></td></tr>
<?php endwhile;?>
</table>
</body>
</html>
