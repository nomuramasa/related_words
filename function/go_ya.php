		<?php function echoGoYaWords($_word, $count, $times){ // 関数 ?>
			
			<?php
			$count++; // カウンタ増やす

			$word = str_replace(' ', '%20', $_word); // 半角スペースだとエラーになるので%20に直す
			$word = urlencode($word);

			sleep($_POST['rest']); // API叩く前は数秒休憩 
			
			if($_POST['approach'] == 'google'){
				// Googleの関連キーワード
				$url = 'https://www.google.com/search?q='.$word; // Google検索のurl　半角スペースが入るとエラー
				$html = file_get_contents($url); // htmlを取得 
				// var_dump($url); echo '<br>'; var_dump($html); // 確認用
				$rel_words_obj = phpQuery::newDocument($html)->find('.BNeawe.deIvCb.AP7Wnd'); //第一階層で関係する単語達のオブジェクトをスクレイピング

			}else if($_POST['approach'] == 'yahoo'){
				// Yahooのサジェストキーワード
				$url = 'http://ff.search.yahoo.com/gossip?output=json&command='.$word; // キーワードAPI
				$json_data = file_get_contents($url); // htmlを取得 
				// var_dump($url); echo '<br>'; var_dump($json_data); // 上手くいかない時の確認用
				$data_array = json_decode($json_data, true); // 連想配列にデコード
				$rel_words_obj = $data_array['gossip']['results']; // 第一階層で関係する単語達のオブジェクトをスクレイピング

			}

			?>

			<div class='row mx-lg-0'>

				<?php

				foreach($rel_words_obj as $rel_word_obj): 
				
					if($_POST['approach'] == 'google'){
						// Googleの関連キーワード
						$rel_word = $rel_word_obj->textContent; 

					}else if($_POST['approach'] == 'yahoo') {
						// Yahooのサジェストキーワード 
						$rel_word = $rel_word_obj['key']; // テキストのみ 

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
						<?php // sleep($_POST['rest']); // 数秒休憩はここに書くべき？？？ ?>
						<?php echoGoYaWords($rel_word, $count, $times); // $rel_wordは一新、$countは増えてる、$timesはそのまま ?>
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