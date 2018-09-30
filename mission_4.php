<?php
header('Content-type:text/html;charset=UTF-8');

$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo= new PDO($dsn,$user,$password);

$sql1="CREATE TABLE mission4"
."("
."id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,"
."namae TEXT,"
."komento TEXT,"
."date TEXT,"
."pass TEXT"
.");";
$stmt1=$pdo->query($sql1);


$name1=($_POST['name1']);//名前
$come=($_POST['come']);//コメント
$passd=($_POST['passd']);//投稿時のパスワード
$sakuzyo=($_POST['sakuzyo']);//削除対象番号
$deletepass= ($_POST['deletepass']);//削除確認パス
$editing=($_POST['editing']);//編集番号
$editpass=($_POST['editpass']);//編集確認パス
$editt=($_POST['editt']);//編集中の番号

$hi= date("Y年m月d日H時i分");

//確認用
//echo $name1;
//echo $come;
//echo $passd;

//新規書き込み
if($_POST['aaa']&&!$_POST['bbb']&&!$_POST['ccc']&&empty($editt)){//送信ボタンが押された時
	if(!empty($name1)&&!empty($come)&&!empty($passd)){//氏名とコメントが空白でないなら；

	$sql4=$pdo->prepare("INSERT INTO mission4(namae,komento,date,pass) VALUES (:namae,:komento,:date,:pass)");
	$sql4->bindParam(':namae',$namae,PDO::PARAM_STR);
	$sql4->bindParam('komento',$komento,PDO::PARAM_STR);
	$sql4->bindParam('date',$date,PDO::PARAM_STR);
	$sql4->bindParam('pass',$pass,PDO::PARAM_STR);

	$namae=$name1;//名前
	$komento=$come;//コメント
	$date=$hi;//日付
	$pass=$passd;//パスワード
	$sql4->execute();
	};
};
//投稿削除
if($_POST['bbb']&&!$_POST['aaa']&&!$_POST['ccc']){//削除ボタンが押された時
		if(!empty($sakuzyo)&&!empty($deletepass)){//削除対象番号が空でない時
			$sqldate='SELECT * FROM mission4';
			$resultdate=$pdo -> query($sqldate);
			foreach($resultdate as $rowdate){
				if($rowdate['id']==$sakuzyo&&$rowdate['pass']==$deletepass){
					echo"【番号".$sakuzyo."が削除されました】";
					$deleid=$sakuzyo;
					$sqldele="delete from mission4 where id=$deleid";
					$rowdate=$pdo->query($sqldele);
				};
			};
		};
};
//投稿編集
if(!$_POST['aaa']&&!$POST['bbb']&&$_POST['ccc']){//送信ボタンが押された時
	if(!empty($editing)&&!empty($editpass)){
		$sqldit1='SELECT * FROM mission4';
		$resultdit1=$pdo->query($sqldit1);
		foreach($resultdit1 as $rowdit1){
			if($rowdit1['id']==$editing&&$rowdit1['pass']==$editpass){
				$data0=$rowdit1['id'];
				$data1=$rowdit1['namae'];
				$data2=$rowdit1['komento'];
				echo"【パスワードを設定してください】";
			};
		};
	};
};
//ファイルに上書き			
if($_POST['aaa']&&!$POST['bbb']&&!$_POST['ccc']){//編集ボタンが押された時
	if(!empty($name1)&&!empty($come)&&!empty($passd)){
		$edid=$editt;
		$ednamae=$name1;
		$edkomento=$come;
		$edpass=$passd;
		
		$sqledit="update mission4 set namae='$ednamae' , komento='	$edkomento' ,date='$hi',pass='$edpass' where id = $edid";
		$resultit=$pdo->query($sqledit);
		echo "【投稿番号".$edid."が編集されました】";
};
};	
		
<html>
<meta charset="utf-8">
<body>
<form action="#" method="POST">

<!-- -->
<!-- 新規投稿ファイル-->
<br>
<input type="text" name="name1" value="<?php echo $data1;?>">：名前
<br>
<input type="text" name="com"value="<?php echo  $data2;?>">：コメント		
<br>
<input type="text" name="passd" placeholder="パスワード">
<br>
<input type="submit" value="送信" name="aaa">
<br>
<!--編集番号表示フォーム-->
<input type="hidden" name="editt" value="<?php echo $data0;?>">
<br>
<!--コメント削除フォーム-->
<input type="text" name="sakuzyos" placeholder="削除対象番号">
<br>
<input type="text" name="deletepass"placeholder="パスワード">
<input type="submit" value="削除" name="bbb">
<br>
<!--コメント編集フォーム-->
<input type="text" name="editing" placeholder="編集対象番号">
<br>
<input type="text" name="editpass" placeholder="パスワード">
<br>
<input type="submit" value="編集" name="ccc">
<br>
</form>
</body>
</html>

<?php
header('Content-type:text/html;charset=UTF-8');

$dsn='mysql:dbname=tt_286_99sv_coco_com;host=localhost';
$user='tt-286.99sv-coco';
$password='T8xADYcw';
$pdo= new PDO($dsn,$user,$password);

if($_POST['aaa'] or $_POST['ccc'] or $_POST['bbb']){
	$sql5='SELECT * FROM mission4 ORDER BY id ASC';
	$result5=$pdo->query($sql5);
	foreach($result5 as $row5){
		echo$row5['id'].'&emps;';
		echo$row5['namae'].'&emsp;';
		echo$row5['komento'].'&emsp;';
		echo$row5['date'].'<br>';
		};
};
?>


