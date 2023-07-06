<!DOCTYPE html>
<html>

<head>
  <link href='favicon.ico' rel='icon'>
  <?php require_once('common/head.php'); ?>
</head>

<body>
  <?php require_once('common/nav.php'); ?>

  <div class='container'>
    <div class='row mx-0'>
      <div class='col-12 px-0'>
        <!-- 第1階層のボタン -->
        <a class='btn btn-light m-2 border first'>
          第１関連ワード
          <div class='row mx-0'>
            <?php for ($i = 1; $i <= 3; $i++) : ?>
              <object>
                <!-- 第2階層のボタン -->
                <a class='btn btn-white m-2 text-dark second'>
                  第２関連ワード
                  <div class='row mx-0'>
                    <?php for ($k = 1; $k <= 8; $k++) : ?>
                      <object>
                        <!-- 第3階層のボタン -->
                        <a class='btn btn-light m-1 text-dark border third'>
                          第３関連ワード
                        </a>
                      </object>
                    <?php endfor; ?>
                  </div>
                </a>
              </object>
            <?php endfor; ?>
          </div>
        </a>
      </div>
    </div>
  </div>
</body>
</html>