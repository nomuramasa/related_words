<?php

// 初！！！ 　再帰関数

$word = 'あ';
$times = 4; // 繰り返し回数
factorial($word, 0, $times); 

function factorial($word, $count, $times) { // $countは今時点の繰り返し数、 $timesは全部で何回繰り返すか
    echo $word;
    $w = 'い';

    $count++; // 今$count周目
	  if($count < $times) { // まだ全回数終わってなければ更に繰り返す
	    factorial($w, $count, $times);
	  }
}

?>