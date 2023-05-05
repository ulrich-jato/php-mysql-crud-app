<!--Name: Jato Ulrich Guiffo Kengne 
    Date: April 08, 2023 
    Section: CST 8285 section 303
    Assignment: 02 
    File: upload.php
    Assignment objective: Use HTML, CSS, JavaScript, PHP and 
    MySQL to buils a web aplication to perform CRUD operation
-->
<?php
// Validate image
if (isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $file_name = $file["name"]; // Find the file name
    $tmp_name = $file["tmp_name"]; // Temp location
    $size = $file["size"]; // Find the file size
    $error = $file["error"]; // Find errors
    $target_dir = "imgs/";
    // $target_file = $target_dir . basename($file_name);
    if (empty($file_name)) {
        $image_err = "Please choose a valid image!";
    } elseif (!empty($file_name) && $error == 0) {
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // Get the file extension-
        $is_allowed = ["jpg", "jpeg", "png", "bmp", "gif", "svg"]; // Allowed extensions

        if (in_array($file_extension, $is_allowed)) {
            if ($size < 10000000) {
                $new_file_name = uniqid('', true) . '.' . $file_extension; // Create new file name
                $target_file = $target_dir . $new_file_name; // set the target file path
                $image = basename($new_file_name); // Use the new filename as the image name
            } else {
                $image_err = "Sorry, your file size is too big! < 10MB";
            }
        } else {
            $image_err = "Sorry, your file type is not accepted";
        }
    }
}
?>