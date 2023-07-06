<!DOCTYPE html>
<html>

<head>
  <link href='favicon.ico' rel='icon'>
  <?php require_once('common/head.php'); ?>
</head>

<body>
  <?php require_once('common/nav.php'); ?>

  <?php
  $firstGetWordCount = 5;
  $secondGetWordCount = 40;
  $googleSearchUrl = 'https://www.google.com/search?q=';

  include_once('php/RelatedWord.php');
  $relatedWord = new RelatedWord();
  ?>

  <div class='row mx-lg-0'>
    <!-- 1回目のAPIアクセス -->
    <?php $relatedWords1 = $relatedWord->get($_POST['query_word'], $firstGetWordCount); ?>
    <?php foreach ($relatedWords1 as $relatedWord1) : ?>
      <div class='col-12 px-0'>
        <a href='<?php echo $googleSearchUrl . $relatedWord1; ?>' target='_blank' class='btn btn-light m-2 border first'>
          <?php
          echo $relatedWord1;
          ob_flush();
          flush();
          ?>
          <div class='row mx-lg-0'>
            <!-- 2回目のAPIアクセス -->
            <?php $relatedWords2 = $relatedWord->get($relatedWord1, $secondGetWordCount); ?>
            <?php foreach ($relatedWords2 as $relatedWord2) : ?>
              <object>
                <a href='<?php echo $googleSearchUrl . $relatedWord2; ?>' target='_blank' class='btn btn-white m-2 text-dark second'>
                  <?php
                  echo $relatedWord2;
                  ob_flush();
                  flush();
                  ?>
                </a>
              </object>
            <?php endforeach; ?>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>

</body>

</html>