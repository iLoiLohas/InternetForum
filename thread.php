<?php
// DB接続
$dbh = mysql_connect('localhost', 'root') or die('I cannot connect to the database because：' . mysql_error());
mysql_select_db('phppro');
// mysql_query('SET NAMES UTF8');

// スレッドIDを取得
// GETの場合にはURLにクエリとして与えている？？？？
$id = $_GET['id'];

// スレッドを取得
$sql_thread = "SELECT * FROM threads where id = $id";
$result_thread = mysql_query($sql_thread) or die('query error１：' . mysql_error());
$thread = mysql_fetch_array($result_thread);

// レスを取得
$sql_res = "SELECT * FROM responses where thread_id = $id order by created_at desc";
$result_res = mysql_query($sql_res) or die('query error２：' . mysql_error());
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $thread['title']?></title>
</head>
<body>
<p>作成日時：<?php echo $thread['created_at'];?></p>
<p>タイトル：<?php echo $thread['title'];?></p>
<p><?php echo $thread['body'];?></p>

<p><a href="res_new.php?id=<?php echo $thread['id'];?>">書き込み</a></p>
<p><a href="index.php">トップに戻る</a></p>

<?php
while ($res = mysql_fetch_array($result_res)):?>
	<hr />
	<p><?php echo $res['body'];?></p>
	<p>名前：<?php echo $res['name'];?></p>
	<p>投稿日時：<?php echo $res['created_at'];?></p>
<?php endwhile;?>
</body>
</html>