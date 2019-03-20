<meta charset='utf8'> 
<?php

$word = 'プログラマ';

$word = urlencode($word);

sleep(3); // 3秒休憩 

$url = 'https://api.apitore.com/api/40/wordnet-simple/all?access_token=c3eeb546-506f-4d4f-9f47-019f9bc2e761&word='.$word.'&pos=n%2Cv%2Ca%2Cr';

$data = file_get_contents($url);
$data = json_decode($data,true); // trueで、stdClassをArrayにできる

$entries = $data['entries']; // 必要なデータセット（〇〇語のブロックが５個ぐらい）

// echo '<pre>'; var_dump($entries);echo '</pre>';  // 全部出力してみる

echo '<hr>';

$synonym = getBlockWords('同義語', $entries); 
$broader = getBlockWords('上位語', $entries); 
$narrower = getBlockWords('下位語', $entries);

$component = getBlockWords('構成要素', $entries); 
$inclusion = getBlockWords('被包含領域', $entries); 


echo '<pre>'; var_dump($broader); echo '</pre>';  // 欲しいブロックをダンプ

foreach($broader as $word){

}

function getBlockWords($kind, $blocks){ // 〇〇語のブロックの単語達を返す関数
	foreach($blocks as $index => $block){ // ブロック（〇〇語）ごとに順番に見ていく
		if(array_search($kind, $block)){ // 欲しい要素の時に
			return $blocks[$index]['words']; // インデックス番号を当てはめて、その情報ブロックの単語達を返す
		}
	}
}


?>