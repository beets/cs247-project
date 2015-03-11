<?

/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
*/

$ret = array('ok' => 1);

$extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
$target_dir = "uploads/";
$target_file = $target_dir . time() . '.' . $extension;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
    } else {
        $ret['ok'] = 0;
        $ret['error'] = "File is not an image.";
    }
}
if ($ret['ok'] == 1) {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $ret['url'] = $target_file;
    } else {
        $ret['ok'] = 0;
        $ret['error'] = "Sorry, there was an error uploading your file.";
    }
}

echo json_encode($ret);

?>
