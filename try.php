<meta charset='utf8'> 
<?php

$word = 'プログラマ';

$word_code = urlencode($word);

$url = 'https://api.apitore.com/api/40/wordnet-simple/all?access_token=c3eeb546-506f-4d4f-9f47-019f9bc2e761&word='.$word_code.'&pos=n%2Cv%2Ca%2Cr';


$data = file_get_contents($url);
$data = json_decode($data,true); // trueで、stdClassをArrayにできる

$entries = $data['entries']; // 必要なデータセット（〇〇語のブロックが５個ぐらい）

getIndexNum($entries);

function getIndexNum($blocks){
	foreach($blocks as $index => $block){ // ブロック（〇〇語）ごとに順番に見ていく
		if(array_search('同義語',$block)){ 
			return $index; // インデックス番号を返す
		}
	}
}


?>