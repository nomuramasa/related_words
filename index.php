<meta charset='utf8'> <!-- 文字コード -->
<meta name='viewport' content='width=device-width'> <!-- スマホ対応 -->
<title>つながり検索</title>

<!--Bootstrap４に必要なCSSとJavaScriptを読み込み-->
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>

<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>

<link rel='icon' href='./favicon.ico'> <!-- ファビコン -->

<link href='style.css' rel='stylesheet'>

<!-- ナビ -->
<nav class='navbar navbar-expand-sm bg-dark mb-3'>
  <div class='container'>
		<h4 class='my-2 text-light'>
			つながり検索
			<a href='sample/google_level2.html' target='_blank' class='text-secondary h6'>■</a>
			<a href='sample/google_level3.html' target='_blank' class='text-secondary h6'>■</a>
			<a href='sample/wordnet.html' target='_blank' class='text-secondary h6'>■</a>
		</h4>

 </div>
</nav>

<div class='container'>

	<!-- 入力フォーム -->
	<form action='./' method='post'>
		<div class='form-gruop row'>

			<input name='word' value='<?php if($_POST["word"]){echo $_POST["word"]; } ?>' class='form-control col-12 col-lg-4' placeholder='単語を入力'>　<!-- 既に単語入ってたらそれを入れる -->

			<!-- 取得方法 -->
			<select name='approach' class='col-10 col-lg-auto mt-3'>
				<option value='google' <?php if($_POST['approach'] == 'google'){echo 'selected';} ?> class='form-control' >連想検索（Google 関連ワード）</span></option>
				<option value='wordnet' <?php if($_POST['approach'] == 'wordnet'){echo 'selected';} ?> class='form-control' >俯瞰検索（WordNet 上位語）</option>
				<option value='yahoo' <?php if($_POST['approach'] == 'yahoo'){echo 'selected';} ?> class='form-control'>候補検索（Yahoo サジェスト）</option>
			</select>　

			<select name='level' class='col-4 col-lg-auto mt-2'> <!-- 階層選択 -->
				<?php for($l=1; $l<=3; $l++): ?>  <!-- 1から3まで -->
					<option value='<?php echo $l; ?>' <?php if($l == $_POST['level']){echo 'selected';} ?> class='form-control col-lg-4'><?php echo $l; ?>階層</option>  <!-- 既に選ばれてる階層は選択済みにする -->
				<?php endfor; ?>
			</select>　

			<select name='rest' class='col-4 col-lg-auto mt-2'> <!-- 休憩時間 -->
				<?php for($t=2; $t<=10; $t+=0.5): ?>  
					<option value='<?php echo $t; ?>' <?php if($t == $_POST['rest']){echo 'selected';} ?> class='form-control col-lg-4'><?php echo $t; ?>秒毎</option>  <!-- 既に選ばれてる階層は選択済みにする -->
				<?php endfor; ?>
			</select>

			<span class='text-center col-12 col-lg-auto mt-4 mt-lg-auto'>
			　<input type='submit' value='検索' class='btn btn-success'> <!-- 検索ボタン -->
			</span>

		</div>
	</form>

</div>


<?php
require_once('library/phpQuery.php'); // phpQueryの読み込み
require_once('function/go_ya.php'); // GoogleとYahooの関数の読み込み
require_once('function/wordnet.php'); // WordNetの関数の読み込み

$input_word = $_POST['word']; // ユーザーが入力した単語
$times = $_POST['level']; // 第何階層までか
?>


<div class='container'>

	<?php if($_POST['approach'] == 'google' || $_POST['approach'] == 'yahoo'): // GoogleとYahooの時だけ ?>
		<?php echoGoYaWords($input_word, 0, $times); // 関数「echoWords」を実行 ?>

	<?php elseif($_POST['approach'] == 'wordnet'): // WordNetの時だけ ?>
		<?php echoWebnetWords($input_word); // 関数「echoWords」を実行 ?>

	<?php endif; ?>

</div> <!-- container -->
