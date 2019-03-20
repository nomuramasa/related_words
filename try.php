<meta charset='utf8'> 
<?php

$word = 'プログラマ';

$word_code = urlencode($word);

$url = 'https://api.apitore.com/api/40/wordnet-simple/all?access_token=c3eeb546-506f-4d4f-9f47-019f9bc2e761&word='.$word_code.'&pos=n%2Cv%2Ca%2Cr';


$data = file_get_contents($url);
$data = json_decode($data,true); // trueで、stdClassをArrayにできる

$entries = $data['entries']; // 必要なデータセット（〇〇語のブロックが５個ぐらい）


echo getBlockIndexNum('同義語',$entries); // 同義語のブロック番号を出力
echo getBlockIndexNum('上位語',$entries); // 上位語のブロック番号を出力
echo getBlockIndexNum('下位語',$entries); // 下位語のブロック番号を出力
echo getBlockIndexNum('被包含領域',$entries); // 被包含領域語のブロック番号を出力


function getBlockIndexNum($kind, $blocks){ // 〇〇語のブロック番号を返す関数
	foreach($blocks as $index => $block){ // ブロック（〇〇語）ごとに順番に見ていく
		if(array_search($kind, $block)){ 
			return $index; // インデックス番号を返す
		}
	}
}


?>