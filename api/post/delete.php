<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');
  header('Access-Control-Allow-Method: DELETE');
  header("Access-Control-Max-Age: 3600");
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');
 
  // include database and object files
  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantitiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to delete
  $post->id = $data->id;

  // Delete post
  if ($post->delete()) {
    
    // set response code - 200 ok
    http_response_code(200);

    echo json_encode(
        array('message' => 'Post Deleted')
    );
  } else {
    
    // set response code - 503 service unavailable
    http_response_code(503);

    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
  }