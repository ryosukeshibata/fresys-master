<?php
include('dbconnect.php');
if(!empty($_GET['id'])&& isset($_GET['id'])) {
  $sql = sprintf('SELECT * FROM `friends`,`areas` WHERE areas.area_id=
  friends.area_id AND friends.area_id=%s',$_GET['id']);
  $record = mysqli_query($db,$sql) or die(mysqli_error($db));
  while($table =mysqli_fetch_assoc($record)){
    $datas[] = $table;
  }
  $count = count($datas);
  $data_male = 0;
  $data_female = 0;
  for ($i=0; $i < $count ; $i++) {
    if(isset($datas[$i]['gender']) && $datas[$i]['gender'] ==
    'm'){
      $data_male += 1;
    }elseif(isset($datas[$i]['gender']) && $datas[$i]['gender'] ==
    'f'){
      $data_female += 1;
    }
}
  echo $_GET['id'];
  echo "<pre>";
  print_r($datas);
  echo "</pre>";
}else{
  header('locate: index.php');
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
        <h1><?php echo $datas[0]['area_name']; ?>友達一覧</h1>
      </div>
      <div class="well">
        男性:<?php echo $data_male; ?>名 女性:<?php echo $data_female; ?>名
      </div>
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th><div class="text-center">名前</div></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i= 0; $i < $count; $i++):
           ?>
           <tr>
            <td><?php echo $datas[$i]['friend_name']; ?></td>
            <td>
              <a href="edit.php?id=<?php echo $datas[$i]['friend_id']; ?>"><i class="fa
              fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="delete.php?id=<?php echo $datas[$i]['friend_id']; ?>"><i class="fa fa-trash"></i></a>
            </td>
           </tr>
           <?php
         endfor;
            ?>
        </tbody>
      </table>
      <input type="button" class="btn btn-default" value="新規作成" onClick="location.href='new.php'">
    </div>
    <div class="copyright">
      <small>Copyright &copy; Core Creative Manager.All right reserved.</small>
    </div>
  </body>
</html>
