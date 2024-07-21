<?php
$logo_dir=__DIR__.'/logos';
if (!file_exists($logo_dir)) {
  die('Logo directory is not found.');
}
if (!is_readable($logo_dir)) {
  die('The logo directory is not readable.');
}
$mainfest=array(
  'items' => []
);
$logo_dir_files=scandir($logo_dir);
foreach ($logo_dir_files as $logo_dir_file_name) {
  $logo_type_dir_path=$logo_dir.'/'.$logo_dir_file_name;
  if (is_dir($logo_type_dir_path)&&$logo_dir_file_name!='.'&&$logo_dir_file_name!='..') {
    $logo_collection = array(
    'type' => $logo_dir_file_name,
    'logos' => []
    );
    
    if (is_readable($logo_type_dir_path)) {
      $logo_type_dir_files=scandir($logo_type_dir_path);
      foreach ($logo_type_dir_files as $logo_type_dir_file_name) {
        if (substr($logo_type_dir_file_name,-4)=='.png'&&$logo_type_dir_file_name!='.'&&$logo_type_dir_file_name!='..') {
          $logo_info = array(
            'name' => $logo_type_dir_file_name,
            'path' => 'logos/'.$logo_dir_file_name.'/'.$logo_type_dir_file_name
          );
          array_push($logo_collection['logos'],$logo_info);
        }
      }
    }
    array_push($mainfest['items'],$logo_collection);
  }
}
$json=json_encode($mainfest);
if (!is_writable(__DIR__)) {
  die('The root directory is not writeable!');
}
file_put_contents('manifest.json',$json);
?>