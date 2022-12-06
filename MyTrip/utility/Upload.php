<?php
    
class Upload {
    public function __construct($path, $file) {
        $this->path = $path;
        $this->file = $file;
    }

    function uploadImg(){
        $rs = 0;
        $targetPath = $this->path;
        $targetFileName = $targetPath.basename($this->file["name"]);

        //$imageFileType = strtolower(pathinfo($targetFileName,PATHINFO_EXTENSION));

        $check = getimagesize($this->file["tmp_name"]);

        if($check == false){
            //$message = "File is not an image.";
            $rs = 2;
        } else if (file_exists($targetFileName)) {
            // Check if file already exists
            //$message = "Sorry, file already exists.";
            $rs = 3;
        }else if ($this->file["size"] > 1024000) {
            // Check file size
            //$message = "Sorry, your file is too large.";
            $rs = 4;
        }else if (move_uploaded_file($this->file["tmp_name"], $targetFileName)) {
            //$message =  "The file ". htmlspecialchars( basename( $_FILES["fileupload"]["name"])). " has been uploaded.";
            $rs = 1;
        } else {
            //$message =  "Sorry, there was an error uploading your file.";
            $rs = 5;
        }
        
        return $rs;

    }

}



?>