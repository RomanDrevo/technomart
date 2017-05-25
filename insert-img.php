<html>
<head><title>File Insert</title></head>
<body>


<form enctype="multipart/form-data" action=
"<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label>Insert Manufacturer<input type="text" name="manufacturer"></label><br>
    <label>Insert Model<input type="text" name="model"></label><br>
    <label>Insert Price<input type="number" name="price"></label><br>

    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
    <input name="userfile" type="file" />
    <input type="submit" value="Submit" />
</form>

<?php
include 'inc/lib.inc.php';
include "inc/config.inc.php";
// check if a file was submitted
if(!isset($_FILES['userfile']))
{
    echo '<p>Please select a file</p>';
}
else
{
    try {
        $msg= upload();  //this will upload your image
        echo $msg;  //Message showing success or failure.
    }
    catch(Exception $e) {
        echo $e->getMessage();
        echo 'Sorry, could not upload file';
    }
}

// the upload function

function upload() {
//    include "inc/config.inc.php";
    $maxsize = 100000000; //set to approx 10 MB

    //check associated error code
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {

        //check whether file is uploaded with HTTP POST
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {

            //checks size of uploaded image on server side
            if( $_FILES['userfile']['size'] < $maxsize) {

                //checks whether uploaded file is of image type
                //if(strpos(mime_content_type($_FILES['userfile']['tmp_name']),"image")===0) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {

                    // prepare the image for insertion
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));

                    // put the image in the db...
                    // database connection
                    $link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die('No Connection');

                    // select the db
//                    mysqli_select_db (DB_NAME) OR DIE ("Unable to select db".mysqli_error());

                    // our sql query
                    $sql = "INSERT INTO catalog
                    (manufacturer, model, price, image, name)
                    VALUES
                    ('{$_POST['manufacturer']}', '{$_POST['model']}', '{$_POST['price']}', '{$imgData}', '{$_FILES['userfile']['name']}');";

                    // insert the image
                    mysqli_query($link, $sql) or die("Error in Query: " . mysqli_error());
                    $msg='<p>Image successfully saved in database with id ='. mysqli_insert_id($link).' </p>';
                }
                else
                    $msg="<p>Uploaded file is not an image.</p>";
            }
            else {
                // if the file is not less than the maximum allowed, print an error
                $msg='<div>File exceeds the Maximum File limit</div>
                <div>Maximum File limit is '.$maxsize.' bytes</div>
                <div>File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].
                    ' bytes</div><hr />';
            }
        }
        else
            $msg="File not uploaded successfully.";

    }
    else {
        $msg= file_upload_error_message($_FILES['userfile']['error']);
    }
    return $msg;
}

// Function to return error message based on error code

function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}
?>
</body>
</html>