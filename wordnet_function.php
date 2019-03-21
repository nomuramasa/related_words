<?php

// $times = 1; // 繰り返し回数

$entries = getApiData($input_word); // APIから受け取る関数実行
// getApiData($word, 0, $times); 
	

$broaders = getBlockWords('上位語', $entries); // 上位語の配列
// echo '<pre>'; var_dump($broaders); echo '</pre>';  // 欲しいブロックをダンプ


echo "<div class='row mx-0'>";
// if($count < $times){ // まだ全回数終わってなければ更に繰り返す
	foreach($broaders as $index => $broader){
		
		$entries = getApiData($broader); // APIから受け取る関数実行

		echo "<div class='col-12 px-0'><a href='https://www.google.com/search?q=".$broader."' target='_blank' class='btn btn-light m-2 border first'>".$broader;

		$narrowers = getBlockWords('下位語', $entries);

		echo "<div class='row mx-0'>";
		foreach($narrowers as $n_index => $narrower){
			
			echo "<object><a href='https://www.google.com/search?q=".$narrower."' target='_blank' class='btn btn-white m-2 text-dark second'>".$narrower;

			$entries = getApiData($narrower); // APIから受け取る関数実行
			$narrowers = getBlockWords('下位語', $entries);

			echo "<div class='row mx-0'>";
			foreach($narrowers as $n_index => $narrower){
				
				echo "<object><a href='https://www.google.com/search?q=".$narrower."' target='_blank' class='btn btn-light m-1 text-dark border third'>".$narrower."</a></object>";
			}
			echo "</div>";
			echo "</a></object>";

		}

		echo "</div>";
		echo "</a></div>";
	}
echo "</div>";


	// getApiData($word, $count, $times);
// }


// $synonym = getBlockWords('同義語', $entries); 
// $broader = getBlockWords('上位語', $entries); 
// $narrower = getBlockWords('下位語', $entries);
// $component = getBlockWords('構成要素', $entries); 
// $inclusion = getBlockWords('被包含領域', $entries); 


// function getApiData($_word, $count, $times){ // APIからのデータ取得の関数
function getApiData($_word){ // APIからのデータ取得の関数
	// $count++; // カウンタ増やす

	$word = urlencode($_word); // 単語をURL用に変換
	$url = 'https://api.apitore.com/api/40/wordnet-simple/all?access_token=c3eeb546-506f-4d4f-9f47-019f9bc2e761&word='.$word.'&pos=n%2Cv%2Ca%2Cr'; // WordNetのAPIを叩く
	sleep(3); // 3秒休憩 
	$data = file_get_contents($url);
	$data = json_decode($data,true); // trueで、stdClassをArrayにできる
	$entries = $data['entries']; // 必要なデータセット（〇〇語のブロックが５個ぐらい）
	return $entries; // 返す
}


function getBlockWords($kind, $blocks){ // 〇〇語のブロックの単語達を返す関数
	foreach($blocks as $index => $block){ // ブロック（〇〇語）ごとに順番に見ていく
		if(array_search($kind, $block)){ // 欲しい要素の時に
			return $blocks[$index]['words']; // インデックス番号を当てはめて、その情報ブロックの単語達を返す
		}
	}
}
?>