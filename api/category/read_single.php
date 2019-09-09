<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantitiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog category object
  $category = new Category($db);

  // Get ID
  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $category->read_single();

if ($category->name != null) {
  // Create array
  $cat_arr = array(
    'id' => $category->id,
    'name' => $category->name
  );
    
  // set response code - 200 OK
  http_response_code(200);

  // Make JSON
  print_r(json_encode(
    array(
      'status' => true,
      'message' => 'Category Found',
      'data' => $cat_arr
    )
  ));
} else {
  // set response code - 404 Not found
  http_response_code(404);

  // tell the user category does not exist
  echo json_encode(
    array(
      'status' => false,
      "message" => "Category does not exist."
    )
  );
}


  