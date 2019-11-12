<?php

// we'll upload the files to this folder
$image_folder = "uploaded-files/";

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $error_message = "";

  if($_FILES['upload']['error'] == UPLOAD_ERR_OK){

    $allowed = array("image/jpeg", "image/JPG", "image/X-PNG", "image/PNG", "image/png", "image/x-png", "image/pjpeg");

    if(in_array($_FILES['upload']['type'], $allowed)){
      if(move_uploaded_file($_FILES['upload']['tmp_name'],$image_folder . $_FILES['upload']['name'])){
        echo("FILE UPLOADED SUCCESSFULLY");
        echo($_FILES['upload']['tmp_name']);
        //die();
      }
    }else{
      $error_message = "FILE TYPE NOT ALLOWED";
    }
  }else{
    $error_message = "NO FILE POSTED";
  }

  if(!empty($error_message)){
    echo($error_message);
  }

  $files = scandir($image_folder);
  if(empty($files)){
    echo("No Files");
  }else{
    foreach($files as $f){
      echo($f . "<br>");
    }
  }
}


?>
<h1>Uploading Files</h1>
Some things to remember:
<ul>
  <li>Use &lt;input type="file" /&gt; to allow file uploads</li>
  <li>Make sure to set the 'enctype' attribute on the form tag (otherwise the file will not be uploaded)</li>
  <li>Make sure that PHP is configured properly for file uploads (check the upload_max_filesize setting in the php.ini file)</li>
  <li>To be safe, uploaded files should go outside of the doc root dir, but that presents some problems if you want to be able to link the the files from your pages.</li>
</ul>

<br><br>
<!--enctype="multipart/form-data" specifies that the form should be able to handle multiple types of data-->
<form method="POST" action="<?php echo($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
	<div class="row">
      <div class="label">
  			Image:
  		</div>
  		<div class="control">
        <!--<input type="hidden" name="MAX_FILE_SIZE" value="50000" />-->
  			<input type="file" name="upload" />
  		</div>
 	</div>
  <div class="row">
      <div class="label">

      </div>
      <div class="control">
        <input type="submit" name="btnSubmit" value="SAVE" />
      </div>
  </div>
</form>
