<?php

  require_once('../../connection.php');

  if(isset($_POST['showSelect'])){

  $selectorDatas = $db->select("showselectors",["id","pcode","description"],["minor_category[<>]"=>[2,9]]);

  foreach($selectorDatas as $selectorData){

    echo '<option value='.$selectorData['id'].'>'.htmlspecialchars($selectorData['pcode']).' - '.$selectorData['description'].'</option>';
  }
}
?>
