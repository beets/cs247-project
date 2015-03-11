<?
include('common.php');
$memory_id = $_GET['id'];

$new_response = array(
    'member' => intval($_GET['user'])
);
$text = trim($_POST['text']);
if ($text) {
    $new_response['text'] = $text;
}
$video_url = trim($_POST['video_url']);
if ($video_url) {
    $new_response['video_url'] = $video_url;
}
array_push($family_json['memories'][$memory_id]['responses'], $new_response);
$output = json_encode($family_json, JSON_PRETTY_PRINT);
file_put_contents('./data/' . $family_name . '.json', $output);

$get .= '&id=' . $memory_id;
header('Location: memory.php?' . $get);
//header('Location: timeline.php?family=' . $family);
die();
?>
