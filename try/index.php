<meta charset='utf8'> <!-- 文字コード -->
<meta name='viewport' content='width=device-width'> <!-- スマホ対応 -->
<title>つながり検索</title>

<!--Bootstrap４に必要なCSSとJavaScriptを読み込み-->
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>

<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>

<style>
/*大二階層の単語ごとのボタン設定*/
.btn-white{
	background-color: #fff;
	border: solid 1px #ddd;
}
.btn-white:hover{
	color:#fff;
	background-color: #bbb;
}
.first{
	font-size:19px;
}
.third{
	font-size:13px;
}
</style>

<?php

$word = 'レモン';

// APIからの単語あたりの取得データを全て表示してみる
// $word = urlencode($word); 
// $url = 'https://api.apitore.com/api/40/wordnet-simple/all?access_token=c3eeb546-506f-4d4f-9f47-019f9bc2e761&word='.$word.'&pos=n%2Cv%2Ca%2Cr';
// $data = file_get_contents($url);
// $data = json_decode($data,true); 
// echo '<pre>'; var_dump($data); echo '</pre>';


// $times = 1; // 繰り返し回数

$entries = getApiData($word); // APIから受け取る関数実行
// getApiData($word, 0, $times); 
	

$broaders = getBlockWords('上位語', $entries); // 上位語の配列
// echo '<pre>'; var_dump($broaders); echo '</pre>';  // 欲しいブロックをダンプ


echo "<div class='container'><div class='row mx-0'>";
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
echo "</div></div>";


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