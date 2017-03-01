<?php

  require_once('../../connection.php');
  if(isset($_POST['showSelect'])){
  $selectorDatas = $db->select("property",["id","description"]);
  foreach($selectorDatas as $selectorData){
    echo '<option value='.$selectorData['id'].'>'.htmlspecialchars($selectorData['description']).'</option>';
  }
}
?>
