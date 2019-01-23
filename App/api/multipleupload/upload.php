<?php
if (isset($_POST['submit'])) {
    include_once '../config/database.php';
    //include_once '../objects/user.php';
    $j = 0; //Variable for indexing uploaded image
    $database = new Database();
    $title = $_POST['title'];
    $db = $database->getConnection();

    $stmt2 = $db->prepare( "SELECT max(id) FROM
                advertisement");
    $stmt2->execute();
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    $ad_id = intval($row['max(id)']);
    $ad_id = $ad_id + 1;

    $stmt1 = $db->prepare( "INSERT INTO
                advertisement
            SET
                id=?,user_id=1, title=?");
    $stmt1->execute(array($ad_id,$title));

    $target_path = "image/"; //Declaring Path for uploaded images

    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array
        $file_url = "C:/xampp/htdocs/nxd2-test/app/api/multipleupload/";
        $target_path = "image/";
        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable

      $target_path.=md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
	   //$target_path.=$_FILES['file']['name'][$i];//set the target path with old name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array

	  if (($_FILES["file"]["size"][$i] < 100000000) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to uploads folder
                echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';


                $query = "INSERT INTO
                            file_url
                        SET
                            ad_id=?, url=?";
                $file_url.=$target_path ;
                // prepare query
                $stmt = $db->prepare($query);
                //echo "<br>".$ad_id;
              //$ad_id = $db->lastInsertId();
                if($stmt->execute(array($ad_id,$file_url))){
                  //echo "Inserted";
                }

            } else {//if file was not moved.
                echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
}
?>
