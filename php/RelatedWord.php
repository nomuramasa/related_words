<?php

class RelatedWord
{
  private const WIKIPEDIA_RELATED_WORDS_API_URL = 'https://ja.wikipedia.org/w/api.php';

  public function get(string $queryWord, int $count): array
  {
    sleep(2);
    $encodedQueryWord = urlencode($queryWord);
    $api = self::WIKIPEDIA_RELATED_WORDS_API_URL . '?format=json&action=query&origin=*&list=search&srlimit=' . $count . '&srsearch=' . $encodedQueryWord;
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
