<meta charset='utf8'> 
<?php

$word = 'プログラマ';

$word_code = urlencode($word);

$url = 'https://api.apitore.com/api/40/wordnet-simple/all?access_token=c3eeb546-506f-4d4f-9f47-019f9bc2e761&word='.$word_code.'&pos=n%2Cv%2Ca%2Cr';


$data = file_get_contents($url);
$data = json_decode($data,true); // trueで、stdClassをArrayにできる

$entries = $data['entries']; // 必要なデータセット



// echo '<pre>'; var_dump($data['entries']); echo '</pre>';
// echo '<pre>'; var_dump($data->entries[2]->words); echo '</pre>';
// $words = $data['entries'][2]['words']; // labeljaが'下位語'の番号が[2]なのか[1]なのか知りたい
// echo '<pre>'; var_dump($words); echo '</pre>';

echo '<hr>';

// var_dump(array_search('同義語',$data['entries']));

foreach($entries as $index => $assoc){

	if(array_search('同義語',$assoc)){ 
		return $index; // インデックス番号を返す
	}
	// $labelja = array_search('同義語',$index);
	// $index = array_search($labelja, $indexata['entries']);
	// var_dump($index);

	echo '<pre>'; var_dump($assoc); echo '</pre>'; 
	if($index['labelja'] == '同義語'){
		echo '同義語';
	} 
	echo '<hr>';
}

?>