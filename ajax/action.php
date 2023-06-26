

<?php

$people = json_decode(file_get_contents('../json/data.json'), true);

// Load the first person on page load

$action = $_GET['a'];
$index = $_GET['index'];
$personIndex = $index ?: 1;


$out_data = [];
$status = "";

if ($action === 'getNextPerson') {

  if ($personIndex >= count($people)) {
    // Reached the end of the array
    $out_data = "";
    $status = "error";
  } else {
    $person = $people[$personIndex];
    $out_data  =  $person;
    $status = "success";
  }
}

if ($status) {
  $out["status"] = $status;
}
if ($out_data) {
  $out["data"] = $out_data;
}
if ($errors) {
  $out["error"] = $errors;
}


header('Content-type: application/json');
echo json_encode($out);


?>