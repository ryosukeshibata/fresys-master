<?php
include('dbconnect.php');
$before_url = $_SERVER['HTTP_REFERER'];
$before_url = explode("?id=",$before_url);
//$before_url = $before_url[1];

$sql = sprintf('SELECT * FROM `areas`WHERE 1');
$record = mysqli_query($db,$sql) or die(mysqli_error($db));
while($table =mysqli_fetch_assoc($record)){
  $datas_area[] = $table;
}
$count_area = count($datas_area);
if(!empty($_POST)){
  $data[] = $_POST;
  $areas_id = $_POST['area_id'];
  $sql = sprintf('INSERT INTO `friends` (`friend_id`,
  `friend_name`, `area_id`, `gender`, `age`, `created`,
  `modified`) VALUES (NULL, "%s", "%d", "%s","%d",
    CURRENT_TIME(), CURRENT_TIMESTAMP)',
    mysqli_real_escape_string($db, $data[0]['name']),
    mysqli_real_escape_string($db, $data[0]['area_id']),
    mysqli_real_escape_string($db, $data[0]['gender']),
    mysqli_real_escape_string($db, $data[0]['age'])
  );
  mysqli_query($db, $sql) or die(mysqli_error($db));
  header("Location:show.php?id=$areas_id");
  exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>都道府県お友達システム</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="./assets/css/style.css">
  </head>
  <body>
    <div class="contents">
      <div class="contents_title">
        <h1>友達登録</h1>
      </div>
      <form method="post" action="" class="form-horizontal" role="form">
        <div class="form-group">
          <div class="content_title">名前</div>
          <div class="content_input">
            <input type="text" name="name" class="form-control" placeholder="例：安久　昌和">
          </div>
        </div>
        <div class="form-group">
          <div class="content_title">出身</div>
          <div class="content_input">
            <select class="form-control" name="area_id">
              <?php for ($i=0; $i < $count_area; $i++): ?>
                <option name="area_id" value="<?php echo
                $datas_area[$i]['area_id'];?>"<?php
                if($before_url[1] == $datas_area[$i]['area_id'])
                echo 'selected'; ?>>
                <?php echo $datas_area[$i]['area_name'];?></option>
              <?php  endfor; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="content_title">性別</div>
          <div class="content_input">
            <select class="form-control" name="gender">
              <option value="0">性別を選択</option>
              <option value="m">男性</option>
              <option value="f">女性</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="content_title">年齢</div>
          <div class="content_input">
            <input type="text" name="age" class="form-control" placeholder="例: 22">
          </div>
        </div>
        <input type="submit" class="btn btn-default" value="登録">
      </form>
    </div>
    <div class="copyright">
      <small>Copyright &copy; Core Creative Manager.All right reserved.</small>
    </div>
  </body>
</html>
