<?php

$word = 'プログラマ';

$word_code = urlencode($word);

$url = 'https://api.apitore.com/api/40/wordnet-simple/all?access_token=c3eeb546-506f-4d4f-9f47-019f9bc2e761&word='.$word_code.'&pos=n%2Cv%2Ca%2Cr';


$data = file_get_contents($url);
$data = json_decode($data);

echo '<pre>'; var_dump($data->entries); echo '</pre>';
// echo '<pre>'; var_dump($data->entries[2]->words); echo '</pre>';
// $words = $data->entries[2]->words;
// echo '<pre>'; var_dump($words); echo '</pre>';

?>