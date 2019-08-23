<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
    
  // include database and object files
  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantitiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get ID
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $post->read_single();

if ($post->title != null) {
    // Create array
    $post_arr = array(
      'id' => $post->id,
      'title' => $post->title,
      'body' => $post->body,
      'author' => $post->author,
      'category_id' => $post->category_id,
      'category_name' => $post->category_name
    );
      
    // set response code - 200 OK
    http_response_code(200);
  
    // Make JSON
    print_r(json_encode($post_arr));
} else {
  // set response code - 404 Not found
  http_response_code(404);

  // tell the user post does not exist
  echo json_encode(array("message" => "Post does not exist."));
}


  