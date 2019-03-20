<?php

require_once('head.php'); // phpQueryの読み込み
require_once('phpQuery.php'); // phpQueryの読み込み

$input_word = $_GET['word']; // ユーザーが入力した単語
$times = $_GET['level']; // 第何階層までか
?>

<div class='container'>

	<?php //☆if($_GET['approach'] == 'google' || $_GET['approach'] == 'yahoo'): // GoogleとYahooの時だけ ?>

		<?php echoWords($input_word, 0, $times); // 関数「echoWords」を実行 ?>


		<?php function echoWords($_word, $count, $times){ // 関数 ?>
			
			<?php
			$count++; // カウンタ増やす

			$word = str_replace(' ', '%20', $_word); // 半角スペースだとエラーになるので%20に直す
			$word = urlencode($word);

			sleep($_GET['rest']); // ☆数秒休憩 
			
			if($_GET['approach'] == 'google'){
				// Googleの関連キーワード
				$url = 'https://www.google.com/search?q='.$word; // Google検索のurl　半角スペースが入るとエラー
				$html = file_get_contents($url); // htmlを取得 
				// var_dump($url); echo '<br>'; var_dump($html); // 確認用
				$rel_words_obj = phpQuery::newDocument($html)->find('table tr td p.aw5cc'); // 第一階層で関係する単語達のオブジェクトをスクレイピング

			}else if($_GET['approach'] == 'yahoo'){
				// Yahooのサジェストキーワード
				$url = 'http://ff.search.yahoo.com/gossip?output=json&command='.$word; // キーワードAPI
				$json_data = file_get_contents($url); // htmlを取得 
				// var_dump($url); echo '<br>'; var_dump($json_data); // 上手くいかない時の確認用
				$data_array = json_decode($json_data, true); // 連想配列にデコード
				$rel_words_obj = $data_array['gossip']['results']; // 第一階層で関係する単語達のオブジェクトをスクレイピング

			}else if($_GET['approach'] == 'synonym'){
				// 類語
				$url = 'https://api.apitore.com/api/40/wordnet-simple/all?access_token=c3eeb546-506f-4d4f-9f47-019f9bc2e761&word='.$word.'&pos=n%2Cv%2Ca%2Cr'; 
				$data = file_get_contents($url);
				$data = json_decode($data);
				$rel_words_obj = $data->entries[2]->words;
			}

			?>

			<div class='row mx-0'>

				<?php

				foreach($rel_words_obj as $rel_word_obj): 
				
					if($_GET['approach'] == 'google'){
						// Googleの関連キーワード
						$rel_word = $rel_word_obj->textContent; 

					}else if($_GET['approach'] == 'yahoo') {
						// Yahooのサジェストキーワード 
						$rel_word = $rel_word_obj['key']; // テキストのみ 

					}else if($_GET['approach'] == 'synonym'){
						// 類語
						$rel_word = $rel_word_obj; 
					}

				?>

					<?php if($count == 1): ?>
						<div class='col-12 px-0'> <!-- 第1階層のボタンの外枠 -->
						<a href='https://www.google.com/search?q=<?php echo $rel_word; ?>' target='_blank' class='btn btn-light m-2 border first'> <!-- 第1階層のボタン -->
						<?php echo $rel_word; // 単語出力 ?>
					<?php endif; ?>

					<?php if($count == 2): ?> 
						<object>
						<a href='https://www.google.com/search?q=<?php echo $rel_word; ?>' target='_blank' class='btn btn-white m-2 text-dark second'> <!-- 第2階層のボタン -->
						<?php echo $rel_word; // 単語出力 ?>
					<?php endif; ?>

					<?php if($count == 3): ?> 
						<object>
						<a href='https://www.google.com/search?q=<?php echo $rel_word; ?>' target='_blank' class='btn btn-light m-1 text-dark border third'> <!-- 第3階層のボタン -->
						<?php echo $rel_word; // 単語出力 ?>
					<?php endif; ?>

					<?php if($count < $times): // まだ全回数終わってなければ更に繰り返す ?>
						<?php // ☆sleep($_GET['rest']); // 数秒休憩はここに書けば、１回目は即実行で2回目以降の直前に挟むので、 ?>
						<?php echoWords($rel_word, $count, $times); // $rel_wordは一新、$countは増えてる、$timesはそのまま ?>
					<?php endif; ?>

					<?php if($count == 3): ?> 
						</a>
						</object>
					<?php endif; ?>

					<?php if($count == 2): ?> 
						</a>
						</object>
					<?php endif; ?>

					<?php if($count == 1): ?>
						</a>
						</div>
					<?php endif; ?>

				<?php endforeach; ?>
			</div> <!-- row -->
		<?php } ?> <!-- 関数終わり -->

	<?php // ☆endif; // GoogleとYahooの時だけ ?>
</div> <!-- container -->

<?php

// 初！ 再帰関数
// $word = 'あ';
// $times = 4; // 繰り返し回数
// factorial($word, 0, $times); 

// function factorial($word, $count, $times) { // $countは今時点の繰り返し数、 $timesは全部で何回繰り返すか
//     echo $word;
//     $w = 'い';

//     $count++; // 今$count周目
// 	  if($count < $times) { // まだ全回数終わってなければ更に繰り返す
// 	    factorial($w, $count, $times);
// 	  }
// }

?>