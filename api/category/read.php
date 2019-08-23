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

  // Category read query
  $result = $category->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if ($num > 0) {
    // Cat Array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $cat_item = array(
        'id' => $id,
        'name' => $name
      );

      // Push to "data"
      array_push($cat_arr['data'], $cat_item);
      // array_push($cat_arr, $cat_item);

    }
    
    // set response code - 200 OK
    http_response_code(200);

    // Turn to JSON & output
    echo json_encode($cat_arr);
  } else {
    
    // set response code - 404 Not found
    http_response_code(404);
    
    // No Categories
    echo json_encode(
      array('message' => 'No Categories Found')
    );
  }
  