		<?php function echoGoYaWords($_word, $count, $times){ // 関数 ?>
			
			<?php
			$count++;

			$word = str_replace(' ', '%20', $_word); // 半角スペースだとエラーになるので%20に直す
			$word = urlencode($word);

			// 2秒休憩
			sleep(2);

			// Googleの関連キーワード
			$url = 'https://ja.wikipedia.org/w/api.php?format=json&action=query&origin=*&list=search&srlimit=5&srsearch='.$word; // Google検索のurl　半角スペースが入るとエラー

			$json_data = file_get_contents($url);

			$data_array = json_decode($json_data,true);
			$rel_words_obj = $data_array['query']['search'];
			?>

			<div class='row mx-lg-0'>

				<?php foreach($rel_words_obj as $rel_word_obj): ?>
					<?php $rel_word = $rel_word_obj['title']; ?>
					<?php if($count == 1): ?>
						<div class='col-12 px-0'> <!-- 第1階層のボタンの外枠 -->
						<a href='https://www.google.com/search?q=<?php echo $rel_word; ?>' target='_blank' class='btn btn-light m-2 border first'> <!-- 第1階層のボタン -->
						<?php echo $rel_word; ob_flush(); flush(); // 単語出力 ?>
					<?php endif; ?>

					<?php if($count == 2): ?> 
						<object>
						<a href='https://www.google.com/search?q=<?php echo $rel_word; ?>' target='_blank' class='btn btn-white m-2 text-dark second'> <!-- 第2階層のボタン -->
						<?php echo $rel_word; ob_flush(); flush(); // 単語出力 ?>
					<?php endif; ?>

					<?php if($count == 3): ?> 
						<object>
						<a href='https://www.google.com/search?q=<?php echo $rel_word; ?>' target='_blank' class='btn btn-light m-1 text-dark border third'> <!-- 第3階層のボタン -->
						<?php echo $rel_word; ob_flush(); flush(); // 単語出力 ?>
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