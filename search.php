<!DOCTYPE html>
<html>

<head>
  <link href='favicon.ico' rel='icon'>
  <?php require_once('common/head.php'); ?>
</head>

<body>
  <?php require_once('common/nav.php'); ?>

  <?php
  $googleSearchUrl = 'https://www.google.com/search?q=';

  include_once('php/RelatedWord.php');
  $relatedWord = new RelatedWord();

  $relatedWords1 = $relatedWord->get($_POST['query_word']);
  ?>

  <div class='row mx-lg-0'>
    <?php foreach ($relatedWords1 as $relatedWord1) : ?>
      <div class='col-12 px-0'>
        <a href='<?php echo $googleSearchUrl . $relatedWord1; ?>' target='_blank' class='btn btn-light m-2 border first'>
          <?php
          echo $relatedWord1;
          ob_flush();
          flush();
          ?>
          <?php $relatedWords2 = $relatedWord->get($relatedWord1); ?>
          <div class='row mx-lg-0'>
            <?php foreach ($relatedWords2 as $relatedWord2) : ?>
              <object>
                <a href='<?php echo $googleSearchUrl . $relatedWord2; ?>' target='_blank' class='btn btn-white m-2 text-dark second'>
                  <?php
                  echo $relatedWord2;
                  ob_flush();
                  flush();
                  ?>
                  <?php $relatedWords3 = $relatedWord->get($relatedWord1); ?>
                  <div class='row mx-lg-0'>
                    <?php foreach ($relatedWords3 as $relatedWord3) : ?>
                      <object>
                        <a href='<?php echo $googleSearchUrl . $relatedWord3; ?>' target='_blank' class='btn btn-light m-1 text-dark border third'>
                          <?php
                          echo $relatedWord3;
                          ob_flush();
                          flush();
                          ?>
                        </a>
                      </object>
                    <?php endforeach; ?>
                  </div>
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