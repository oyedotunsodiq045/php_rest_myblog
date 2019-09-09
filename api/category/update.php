<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Method: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantitiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $category = new Category($db);

  // Get raw category data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $category->id = $data->id;

  $category->name = $data->name;

  // Update category
  if ($category->update()) {
    // set response code - 200 ok
    http_response_code(200);

    echo json_encode(
      array(
        'status' => true,
        'message' => 'Category Updated'
      )
    );
  } else {
    // set response code - 503 service unavailable
    http_response_code(503);

    echo json_encode(
      array(
        'status' => false,
        'message' => 'Category Not Updated'
      )
    );
  }