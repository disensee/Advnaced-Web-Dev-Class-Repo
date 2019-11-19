<?php
include("ImageUploader.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){

	// STEP 1 - Setting up the image uploader...
	// params used for the ImageUploader constructor
	$max_img_size_allowed = 4000000; 						// in bytes
	$allowed_file_types = array('gif','jpg','jpeg','png');	// we'll allow these file types to be uploaded
	
	$imgUploader = new ImageUploader($max_img_size_allowed, $allowed_file_types);



	// STEP 2 - Uploading an image...
	$upload_dir = "uploaded-files/";	// where to put the file once it has been uploaded
	$file_posted = $_FILES['imgFile'];	// the file input from the HTML form
	$new_file_name = time(); 			// You probably need to rename the file (using the id from the database), 
										// but since we aren't using a db for this example, we'll just use a time stamp for the id
										// Note that the ImageUploader will add the proper extension to the new file name;
	
	//  upload the image...
	$upload_result = $imgUploader->uploadImage($new_file_name, $file_posted, $upload_dir);

	// $upload_result will be an array that holds information about the file 
	// but if something goes wrong it will be FALSE
	if($upload_result ==  false){
		die("Something went wrong uploading the image.");
	}
	
	//var_dump($upload_result);die();



	// STEP 3 - resizing the image
	// we'll put the resized images in a 'thumbnails' folder that is inside of the upload_dir
	$thumbnails_dir = $upload_dir . "thumbnails/";
	
	$img_src = $upload_result['file_path'];									// the path to the image being resized
	$img_destination =  $thumbnails_dir .  $upload_result['file_name'];		// the destination folder for the resized image
	$resize_width = 150;								
	$resize_height = 200;

	// resize the image...
	$resize_result = $imgUploader->resizeImage($img_src, $img_destination, $resize_width, $resize_height);

	// $resize_result will be an array that has some details about the final size of the image
	if($resize_result ==  false){
		die("Something when wrong resizing the image.");
	}
	//var_dump($resize_result);die();

	die("Looks like it worked! Check the uploaded-files folder!");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Image Resizer Sample</title>
</head>
<body>
	Don't forget to set the enctype attribute on the form tag!<br>

	<form method="POST" action="<?php echo($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
		<input type="file" name="imgFile"><br><br>
		<input type="submit" name="Submit" value="Upload">
	</form>

</body>
</html>