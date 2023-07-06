<!-- タイトルと説明 -->
<nav class='navbar navbar-expand-sm bg-dark mb-3'>
  <div class='container'>
    <h4 class='my-2 text-light'>
      連想ワード検索
    </h4>
    <p class='text-light mb-0'>〜 頭の中にまだ無い、新しいキーワードを発見しよう 〜</p>
  </div>
</nav>

<!-- 検索欄 -->
<div class='container'>
  <form action='./search.php' method='post'>
    <div class='form-gruop row mx-lg-0'>
      <input
        name='query_word'
        placeholder='単語を入力'
        value='<?php if($_POST['query_word']) {echo $_POST['query_word'];} ?>'
        class='form-control col-12 col-lg-4'
        >
      <input type='submit' value='検索' class='btn btn-success ml-2'>
    </div>
  </form>
</div>