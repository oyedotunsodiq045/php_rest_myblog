<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Method: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantitiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog category object
  $category = new Category($db);

  // Get raw category data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to delete
  $category->id = $data->id;

  // Delete category
  if ($category->delete()) {
    // set response code - 200 ok
    http_response_code(200);

    echo json_encode(
      array('message' => 'Category Deleted')
    );
  } else {
    // set response code - 503 service unavailable
    http_response_code(503);

    echo json_encode(
      array('message' => 'Category Not Deleted')
    );
  }