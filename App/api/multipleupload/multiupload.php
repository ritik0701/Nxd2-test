<!DOCTYPE html>
<html>
    <head>
		<title>Create Your Advertiment</title>
		<!-------Including jQuery from google------>
        <script src="jquery.js"></script>
        <script src="script.js"></script>

		<!-------Including CSS File------>
        <link rel="stylesheet" type="text/css" href="style.css">
    <body>
        <div id="maindiv">

            <div id="formdiv">
                <h2>Multiple Image Upload Form</h2>
                <form enctype="multipart/form-data" action="" method="post">
                  <hr/>
                  <input type="text" name="title" placeholder="Enter Your Title" required>
                    <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>

                    <input type="button" id="add_more" class="upload" value="Add More Files"/>
                    <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
                </form>
                <br/>
                <br/>
				<!-------Including PHP Script here------>
                <?php include "upload.php"; ?>
            </div>

		   <!-- Right side div -->

        </div>
    </body>
</html>
