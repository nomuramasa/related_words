<?php require_once('head.php') ?> <!-- ヘッダー読み込み -->

<script src='script.js'></script> <!-- Javascript読み込み -->

<!-- ナビ -->
<nav class='navbar navbar-expand-sm bg-dark mb-3'>
  <div class='container'>
		<h4 class='my-2 text-light'>
			連想ワード検索
			<a href='developer.php' target='_blank' class='text-secondary h6'>■</a>
		</h4>

 </div>
</nav>

<div class='container'>

	<!-- 入力フォーム -->
	<form action='./' method='post'>
		<div class='form-gruop row'>

			<input name='word' value='<?php if($_POST["word"]){echo $_POST["word"]; } ?>' class='form-control col-12 col-lg-4' placeholder='単語を入力'>　<!-- 既に単語入ってたらそれを入れる -->

			<span class='text-center col-12 col-lg-auto mt-lg-auto'>
			　<input type='submit' value='検索' class='btn btn-success'> <!-- 検索ボタン -->
			</span>

		</div>
	</form>


  <!-- 最初の説明文 -->
  <!-- <div id='only_once' class='text-sm-center my-4 balloon rounded rounded-lg p-3 mx-auto col-lg-7 bg-white'>
    <p class='mb-0 text-sm-center'>
      なかなか思い通りの検索結果が返って来なくて困ってる人の為の、キーワード発見ツールです！
      <br class='d-none d-md-block'>
      まだ頭の中に無い言葉を見つけましょう！
    </p>
  </div> -->



</div>


<?php
require_once('library/phpQuery.php'); // phpQueryの読み込み
require_once('function/go_ya.php'); // GoogleとYahooの関数の読み込み

// 検索設定
$_POST['approach'] = 'google';
$_POST['rest'] = 2; 

$input_word = $_POST['word']; // ユーザーが入力した単語
$times = 3; // 第何階層までか
?>


<div class='container'>

	<?php if($_POST['approach'] == 'google' || $_POST['approach'] == 'yahoo'): // GoogleとYahooの時だけ ?>
		<?php echoGoYaWords($input_word, 0, $times); // 関数「echoWords」を実行 ?>

	<?php elseif($_POST['approach'] == 'wordnet'): // WordNetの時だけ ?>
		<?php echoWebnetWords($input_word); // 関数「echoWords」を実行 ?>

	<?php endif; ?>

</div> <!-- container -->
