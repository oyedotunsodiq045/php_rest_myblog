<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');
 
  // include database and object files
  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantitiate DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Blog post query
  $result = $post->read();
  // Get row count
  $num = $result->rowCount();

  // CHeck if any posts
  if ($num > 0) {
    // Post Array
    $posts_arr = array();
    $posts_arr['data'] = array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      // extract row
      // this will make $row['name'] to
      // just $name only
      extract($row);
 
      $post_item = array(
        'id' => $id,
        'title' => $title,
        'body' => html_entity_decode($body),
        'author' => $author,
        'category_id' => $category_id,
        'category_name' => $category_name
      );

      // Push to "data"
      array_push($posts_arr['data'], $post_item);
      // array_push($posts_arr, $post_item);

    }
 
    // set response code - 200 OK
    http_response_code(200);

    // Turn to JSON & output
    // echo json_encode($posts_arr);
    echo json_encode(
      array(
        'status' => true,
        'message' => 'Post Found',
        'data' => $posts_arr['data']
      )
    );
  } else {
 
    // set response code - 404 Not found
    http_response_code(404);
    
    // No Posts
    echo json_encode(
      array(
        'status' => false,
        'message' => 'No Post Found'
      )
    );
  }
  