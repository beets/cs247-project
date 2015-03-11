<?
include('common.php');
$memory_id = $_GET['id'];

$new_response = array(
    'text' => trim($_POST['text']),
    'member' => $_GET['user']
);
array_push($family_json['memories'][$memory_id]['responses'], $new_response);
$output = json_encode($family_json, JSON_PRETTY_PRINT);
file_put_contents('./data/' . $family . '.json', $output);

$get .= '&id=' . $memory_id;
header('Location: memory.php?' . $get);
//header('Location: timeline.php?family=' . $family);
die();
?>
