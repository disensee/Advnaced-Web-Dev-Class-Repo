<?php
/**
* This class allows you to upload images and create thumbnails of them.
* It was created by Niall Kader
* A LOOONG TIME AGO (probably needs a refactoring!)
*/
class ImageUploader{
	
	/**
	* @property $error_msg 	If something goes wrong you can check this instance variable for an error message
	*/
	public $error_msg = "";

	private $max_file_size;
	private $ar_allowed_file_types = array();
	
	
	/**
	* @param $max_file_size				Allows you to limit the file size of the image that is being uploaded.
	* @param $ar_allowed_file_types		Allows you to restrict files to be of a certain type (white list)
	*/
	public function __construct($max_file_size = 4000000,$ar_allowed_file_types = array('jpg','jpeg','gif','png')){
		$this->max_file_size = $max_file_size;
		$this->ar_allowed_file_types = $ar_allowed_file_types;
	}
	
	/**
	* Handles the file upload.
	* @param $rename_to 		This is what the uploaded file will be renamed to
	* @param $file 				The $_FILE object being uploaded. 
	*							For example, if the file input in your form is named 'image', like this: <input type="file" name='image' />
	* 							Then you would pass this in for the second param: $_FILES['image']
	*
	* @param $destination_dir	The folder where the uploaded file should end up
	*
	* @return boolean			Returns true if the file is successfully uploaded, false if not
	*/
	public function uploadImage($rename_to ,$file, $destination_dir){
		$original_name = $file['name'];
		$imgArray = explode(".",$original_name);//imgArray[1] is the file extension we should use
		//make sure there's not more than one file extension...
		if(!count($imgArray) == 2){
			$this->error_msg = "ImageUploader - too many periods in file name";
			return false;
		}
		$ext = strtolower($imgArray[1]);
		//make sure the file extension is allowed...
		if(!in_array($ext,$this->ar_allowed_file_types)){
			$this->error_msg = "ImageUploader - invalid file extension";
			return false;
		}
		//rename the file...		
		//$rename_to = $rename_to . "." . $ext;
		$uploadfile = $destination_dir . $rename_to . "." . $ext;
		$file_name = $rename_to . "." . $ext;
		$file_size = filesize($file['tmp_name']);
		
		if(is_uploaded_file($file['tmp_name'])){
			if($file_size <= $this->max_file_size){
				if(move_uploaded_file($file['tmp_name'],$uploadfile)){
					//chmod($uploadfile, 0644); //changes the permisssions of the uploaded file
					return array('original_name' => $original_name, 'new_name' => $rename_to,'file_name' => $file_name, 'size' => $file_size, 'ext' => $ext, 'destination_dir' => $destination_dir, 'file_path' => $uploadfile);
				}else{
					//echo("error:upload failed");
					$this->error_msg = "ImageUploader - upload failed";
					//die();
					return false;
				}
			}else{
				$this->error_msg = "ImageUploader - file size (" . $file_size . ") exceeds limit (" . $this->max_file_size . ")";
				return false;
			}
		}else{
			$this->error_msg = "ImageUploader - is not uploaded file";
			return false;
		}	
	}
	
	/**
	* Resizes an image that has been uploaded. Creates a copy of the original.
	* @param $img_src 				The path to the image that should be resized
	* @param $img_destination		The path to the folder that will contain the resized image
	* @param $resize_width			The width to resize the image to
	* @param $resize_height			The height to resize the image to
	*
	* @return assoc array or false 	Returns an associative array that includes final height, width and file size (in bytes) of the resized image
	*								For example:
	* 									array('width' => 100, 'height' => 50, 'file_size' => 10000);
	*								Returns false if something goes wrong
	*/
	public function resizeImage($img_src,$img_destination,$resize_width,$resize_height){
		try{	
			// get original images width and height
			list($or_w, $or_h, $or_t) = getimagesize($img_src);
		
			// make sure image is a jpeg or gif
			//see http://us3.php.net/manual/en/function.exif-imagetype.php for info about image type constants such as
			//IMAGETYPE_JPEG = 2
			//IMAGETYPE_GIF = 1
			if ($or_t == 1 || $or_t == 2 || $or_t == 3) {
			
				// obtain the image's ratio
				$or_ratio = ($or_h / $or_w);
				$resize_ratio = ($resize_height/$resize_width);
		
				// original image
				if($or_t == 1){
					$or_image = imagecreatefromgif($img_src);
				}else if ($or_t == 2){
					$or_image = imagecreatefromjpeg($img_src);
				}else{
					$or_image = imagecreatefrompng($img_src);
				}
				
				// resize image?
				if ($or_w > $resize_width || $or_h > $resize_height) {
					//image must be resized
					if($or_ratio < $resize_ratio){
						$w = $resize_width;
						$h = $w * $or_ratio;
					}else{
						$h = $resize_height;
						$w = ($h/$or_ratio);	
					}
				}else {
					// image requires no resizing
					$w = $or_w;
					$h = $or_h;
				}
				
				//resize...	
				$rs_image = imagecreatetruecolor($w, $h);
				
				//fix the problem with gif and png transparencies....
				if($or_t == 1){
					// integer representation of the color black (rgb: 0,0,0)
					$background = imagecolorallocate($rs_image, 0, 0, 0);
					// removing the black from the placeholder
					imagecolortransparent($rs_image, $background);
				}else if ($or_t == 3){
					// integer representation of the color black (rgb: 0,0,0)
					$background = imagecolorallocate($rs_image, 0, 0, 0);
					// removing the black from the placeholder
					imagecolortransparent($rs_image, $background);
					// turning off alpha blending (to ensure alpha channel information is preserved, rather than removed (blending with the rest of the image in the form of black))
					imagealphablending($rs_image, false);
					// turning on alpha channel information saving (to ensure the full range of transparency is preserved)
					imagesavealpha($rs_image, true);
				}
				
				imagecopyresampled($rs_image, $or_image, 0, 0, 0, 0, $w, $h, $or_w, $or_h);
					
				// generate resized image - $or_t is the image type (gif or jpg)
				if($or_t == 1){
					imagegif($rs_image, $img_destination, 100);
				}else if($or_t == 2){
					imagejpeg($rs_image, $img_destination, 100);
				}else{
					imagepng($rs_image, $img_destination);
				}
				//SUCCESS - if resize completes, return array with height and width...
				return array('width' => $w, 'height' => $h, 'file_size' => filesize($img_destination));
			}else{
				// Image type was not jpeg or gif!
				$this->error_msg = "image file type is not allowed";
				return false;
			}
		} catch (Exception $e) {
			//echo("error: catch...");
			$this->error_msg = $e->getCode() . " -- " . $e->getMessage();
			return false;
		}
	}
}