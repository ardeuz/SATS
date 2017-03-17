<?php
    require_once('../../connection.php');
    $load_dir = "property_images/";
    $target_dir = "../../property_images/";
    $uploadOk = 1; //upload if 1, dont upload if 0.
    $target_file = $target_dir . basename($_FILES["propertyUploader"]["name"]);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    //check if the file uploaded is image
    $check = getimagesize($_FILES["propertyUploader"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0; //no image announcement
    }

    //check file type, allow only jpg, png and jpeg
    if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg") {
      // echo "Sorry, only JPG, JPEG & PNG files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 1) {
      //rename file
      $property_id = $db->max("property","id");

      $temp = explode(".", $_FILES["propertyUploader"]["name"]);
      $renameFile = $property_id . "." . end($temp);

      $imagePath = $target_dir . $renameFile;

      if (move_uploaded_file($_FILES["propertyUploader"]["tmp_name"], $imagePath)) {
        $load_path = $load_dir . $renameFile; //this is the path to be saved on database
        echo $renameFile;
	//do your transactions here, (saving to database, etc...)
        // $account_id = $db->id();
        $db->update("property",["property_image"=>$load_path],["id"=>$property_id]);
        echo "1";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
    }

?>
