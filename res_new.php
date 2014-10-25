<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;	// スレッドのid
$type = isset($_POST['type']) ? $_POST['type'] : null;

if ($type == 'create') {
	// DB接続
	$dbh = mysql_connect('localhost', 'root') or die('I cannot connent to the database because：' . mysql_error());
	mysql_select_db('phppro');

	$body = $_POST['body'];
	$name = $_POST['name'];
	// 書き込み
	$sql_res = "INSERT INTO responses (thread_id, body, name, created_at) VALUES ($id, '$body', '$name', now())";
	$result_set = mysql_query($sql_res) or die('query error１：' . mysql_error());

	// スレッド画面に遷移
	header("Location:thread.php?id=" . $id);
}
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>レス投稿画面</title>
</head>
<body>
<form method="post" action="res_new.php">
<table>
	<tr>
		<th>名前</th>
		<td><input type="text" name="name" /></td>
	</tr>
	<tr>
		<th>内容</th>
		<td><textarea name="body"></textarea></td>
	</tr>
	<tr>
		<td><input type="hidden" name="id" value="<?php echo $id;?>" />
				<input type="hidden" name="type" value="create" />
		</td>
		<td><input type="submit" name="submit" value="投稿" /></td>
	</tr>
</table>
</form>
</body>
</html>