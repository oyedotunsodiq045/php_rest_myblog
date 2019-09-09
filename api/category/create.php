<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');
  header('Access-Control-Allow-Method: POST');
  header("Access-Control-Max-Age: 3600");
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

  $category->name = $data->name;

  // Create category
  if ($category->create()) {
    
    // set response code - 201 created
    http_response_code(201);

    echo json_encode(
      array(
        'status' => true,
        'message' => 'Category Created'
      )
    );
  } else {
    // set response code - 503 service unavailable
    http_response_code(503);

    echo json_encode(
      array(
        'status' => false,
        'message' => 'Category Not Created'
      )
    );
  }