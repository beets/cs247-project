<?
$family = $_GET['family'];
$family_file = file_get_contents('./data/' . $family . '.json');
$family_json = json_decode($family_file, true);

//The page that calls this URL will send values for date and prompt
$newStory = array("date" => 1999, "prompt" => "PLACEHOLDERTEXT FOR PROMPT", "responseText" => null, "audioPath" => null, "imagePath" => null);
array_push($family_json['stories'], $newStory);
$output = json_encode($family_json, JSON_PRETTY_PRINT);
file_put_contents('./data/' . $family . '.json', $output);
?>