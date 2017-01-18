<?php

  require_once("../../connection.php");

?>
<select  id="majorCat">
  <option value='0'>Select a Category</option>
  <?php

    $minorSelectDatas = $db->select("major_category",["description","id"]);
    foreach ($minorSelectDatas as $minorSelectData) {
      ?>
        <option value="<?php echo $minorSelectData['id']?>"><?php echo $minorSelectData['description']?></option>
      <?php
    }
  ?>
</select>
