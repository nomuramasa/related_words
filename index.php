<?php require_once('head.php') ?> <!-- ヘッダー読み込み -->

<script src='script.js'></script> <!-- Javascript読み込み -->

<!-- タイトルと説明 -->
<nav class='navbar navbar-expand-sm bg-dark mb-3'>
  <div class='container'>
    <h4 class='my-2 text-light'>
      連想ワード検索
    </h4>
    <p class='text-light mb-0'>〜 頭の中にまだ無い、新しいキーワードを発見しよう 〜</p>
  </div>
</nav>

<div class='container'>

	<!-- 入力フォーム -->
	<form action='./' method='post'>
		<div class='form-gruop row mx-lg-0'>

			<input name='word' value='<?php if($_POST["word"]){echo $_POST["word"]; } ?>' class='form-control col-12 col-lg-4' placeholder='単語を入力'>　<!-- 既に単語入ってたらそれを入れる -->

			<span class='text-center col-12 col-lg-auto mt-lg-auto'>
			　<input type='submit' value='検索' class='btn btn-success'> <!-- 検索ボタン -->
			</span>

		</div>
	</form>
</div>



<?php
require_once('library/phpQuery.php'); // phpQueryの読み込み
require_once('function/go_ya.php'); // 関数の読み込み

$input_word = $_POST['word']; // ユーザーが入力した単語
$times = 3; // 第3階層まで
?>

<div class='container'>

  <!-- 最初だけの説明文 -->
  <div id='only_once' class='d-none'>
    
    <div class='row mx-0'>
      <div class='col-12 px-0'> <!-- 第1階層のボタンの外枠 -->
        <a class='btn btn-light m-2 border first'> <!-- 第1階層のボタン -->
          入力した単語に関連するキーワード				
          <div class='row mx-0'>
            <?php for($i=1; $i<=3; $i++): ?>
              <object>
                <a class='btn btn-white m-2 text-dark second'> <!-- 第2階層のボタン -->
                  第２関連キーワード				
                  <div class='row mx-0'>
                    <?php for($k=1; $k<=8; $k++): ?>
                      <object>
                        <a class='btn btn-light m-1 text-dark border third'> <!-- 第3階層のボタン -->
                          第３関連ワード				
                        </a>
                      </object>
                    <?php endfor; ?>
                  </div>
                </a>
              </object>
            <?php endfor; ?>
          </div>
        </a>
      </div>
    </div>
  </div>
  <!-- ここまで最初だけ -->

  <?php echoGoYaWords($input_word, 0, $times); // 関数「echoWords」を実行 ?>
</div> <!-- container -->
