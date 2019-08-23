<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Method: PUT');
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

  // Set ID to update
  $post->id = $data->id;

  $post->title = $data->title;
  $post->body = $data->body;
  $post->author = $data->author;
  $post->category_id = $data->category_id;

  // Update post
  if ($post->update()) {
    
    // set response code - 200 ok
    http_response_code(200);

    echo json_encode(
      array('message' => 'Post Updated')
    );
  } else {
    
    // set response code - 503 service unavailable
    http_response_code(503);
    
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }