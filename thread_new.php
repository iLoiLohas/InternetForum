<?php
$type = (isset($_POST['type']))? $_POST['type'] : null;

if ($type == 'create') {
	// DB接続
	$dbh = mysql_connect("localhost:3306", "root") or die('I cannot connect to the database because：' . mysql_error());
	mysql_select_db('phppro', $dbh);
// 	mysql_query('SET NAMES UTF8');

	$title = $_POST['title'];
	$body = $_POST['body'];

	// 書き込み
	$sql_thread = "INSERT INTO threads (title, body, created_at) VALUES ('$title', '$body', now())";
	$result_thread = mysql_query($sql_thread) or die('query error：' . mysql_error());

	// スレッド画面に遷移
	header("Location:index.php");
}
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>スレッド作成画面</title>
</head>
<body>
<form method="post" action="thread_new.php">
<table>
	<tr>
			<th>タイトル</th>
			<td><input type="text" name="title" /></td>
	</tr>
	<tr>
			<th>内容</th>
			<td><textarea name="body"></textarea></td>
	</tr>
	<tr>
			<td><input type="hidden" name="type" value="create" /></td>
			<td><input type="submit" name="submit" value="作成" /></td>
	</tr>
</table>
</form>
</body>
</html>