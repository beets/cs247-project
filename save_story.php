<?
$family = $_GET['family'];
$family_file = file_get_contents('./data/' . $family . '.json');
$family_json = json_decode($family_file, true);

//The page that calls this URL will send values for date and prompt
$newStory = array(
  "date" => trim($_POST['date']),
  "prompt" => trim($_POST['prompt']),
  "responseText" => null,
  "audioPath" => null,
  "imagePath" => $_POST['photo_url']
);
array_push($family_json['stories'], $newStory);
$output = json_encode($family_json, JSON_PRETTY_PRINT);
file_put_contents('data/' . $family . '.json', $output);

header('Location: timeline.php?family=' . $family);
?>
