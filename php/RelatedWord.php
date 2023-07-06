<?php

class RelatedWord
{
  private const WIKIPEDIA_RELATED_WORDS_API_URL = 'https://ja.wikipedia.org/w/api.php?format=json&action=query&origin=*&list=search&srlimit=5&srsearch=';

  public function get(string $queryWord): array
  {
    sleep(2);
    $encodedQueryWord = urlencode($queryWord);
    $api = self::WIKIPEDIA_RELATED_WORDS_API_URL . $encodedQueryWord;
    $json = file_get_contents($api);
    $array = json_decode($json, true);
    $wordsArray = $array['query']['search'];

    $relatedWords = [];
    foreach($wordsArray as $wordArray) {
      $relatedWords[] = $wordArray['title'];
    }
    return $relatedWords;
  }
}
