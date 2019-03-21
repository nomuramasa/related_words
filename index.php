<meta charset='utf8'> <!-- 文字コード -->
<meta name='viewport' content='width=device-width'> <!-- スマホ対応 -->
<title>つながり検索</title>

<!--Bootstrap４に必要なCSSとJavaScriptを読み込み-->
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>

<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>

<link rel='icon' href='./favicon.ico'> <!-- ファビコン -->

<style>

body{
	background-image: url(liblary2.jpg); /*図書館画像*/
	background-size: cover; /*全体に*/
}

/*大二階層の単語ごとのボタン設定*/
.btn-white{
	background-color: #fff;
	border: solid 1px #ddd;
}
.btn-white:hover{
	/*color:#aaa;*/
	color:#fff;
	background-color: #bbb;
	/*border: solid 1px #888;*/
}
.first{
	font-size:19px;
}
.third{
	font-size:13px;
}

</style>

<!-- ナビ -->
<nav class='navbar navbar-expand-sm bg-dark mb-3'>
  <div class='container'>
		<h4 class='my-2 text-light'>
			つながり検索
			<a href='sample2.html' target='_blank' class='text-secondary h6'>■</a>
			<a href='sample3.html' target='_blank' class='text-secondary h6'>■</a>
		</h4>

 </div>
</nav>

<div class='container'>

	<!-- 入力フォーム -->
	<form action='./' method='get'>
		<div class='form-gruop row mx-0'>

			<input name='word' value='<?php if($_GET["word"]){echo $_GET["word"]; } ?>' class='form-control col-4' placeholder='単語を入力'>　<!-- 既に単語入ってたらそれを入れる -->

			<!-- 取得方法 -->
			<select name='approach'>
				<option value='google' <?php if($_GET['approach'] == 'google'){echo 'selected';} ?> class='form-control' >Google関連語</option>
				<option value='yahoo' <?php if($_GET['approach'] == 'yahoo'){echo 'selected';} ?> class='form-control'>Yahooサジェスト</option>
				<option value='wordnet' <?php if($_GET['approach'] == 'wordnet'){echo 'selected';} ?> class='form-control' >WordNet概念図</option>
			</select>　

			<select name='level'> <!-- 階層選択 -->
				<?php for($l=1; $l<=3; $l++): ?>  <!-- 1から3まで -->
					<option value='<?php echo $l; ?>' <?php if($l == $_GET['level']){echo 'selected';} ?> class='form-control col-4'>第<?php echo $l; ?>階層</option>  <!-- 既に選ばれてる階層は選択済みにする -->
				<?php endfor; ?>
			</select>　

			<select name='rest'> <!-- 休憩時間 -->
				<?php for($t=1; $t<=10; $t+=0.5): ?>  
					<option value='<?php echo $t; ?>' <?php if($t == $_GET['rest']){echo 'selected';} ?> class='form-control col-4'><?php echo $t; ?>秒</option>  <!-- 既に選ばれてる階層は選択済みにする -->
				<?php endfor; ?>
			</select>

		　<input type='submit' value='検索' class='btn btn-success'> <!-- 検索ボタン -->

		</div>
	</form>

</div>


<?php
require_once('phpQuery.php'); // phpQueryの読み込み
require_once('go_ya_function.php'); // GoogleとYahooの関数の読み込み
require_once('wordnet_function.php'); // WordNetの関数の読み込み

$input_word = $_GET['word']; // ユーザーが入力した単語
$times = $_GET['level']; // 第何階層までか
?>


<div class='container'>

	<?php if($_GET['approach'] == 'google' || $_GET['approach'] == 'yahoo'): // GoogleとYahooの時だけ ?>
		<?php echoGoYaWords($input_word, 0, $times); // 関数「echoWords」を実行 ?>

	<?php elseif($_GET['approach'] == 'wordnet'): // WordNetの時だけ ?>
		<?php echoWebnetWords($input_word); // 関数「echoWords」を実行 ?>

	<?php endif; ?>

</div> <!-- container -->
