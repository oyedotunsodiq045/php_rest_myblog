<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');
  header('Access-Control-Allow-Method: POST');
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

  // Check to make sure data inputed are not empty
  // if ( ! empty($post->title) && 
  //       ! empty($post->body) && 
  //       ! empty($post->author) && 
  //       ! empty($post->category_id) 
  //     ) { // Set post property values
    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    // Create post
    if ($post->create()) {

      // set response code - 201 created
      http_response_code(201);
      
      echo json_encode(
          array(
            'status' => true,
            'message' => 'Post Created'
          )
      );
    } else {
      // set response code - 503 service unavailable
      http_response_code(503);

      echo json_encode(
          array(
            'status' => false,
            'message' => 'Post Not Created'
          )
      );
    }
  // } else {
  //   // set response code - 400 bad request
  //   http_response_code(400);
    
  //   echo json_encode(
  //     array("message" => "Post Not Created. Incomplete Data.")
  //   );
  // }