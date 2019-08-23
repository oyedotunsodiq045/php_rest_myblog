<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';
 
  // include database and object files
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // get keywords
  $keywords = isset($_GET["s"]) ? $_GET["s"] : "";
 
  // query posts
  $result = $post->search($keywords);
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
    echo json_encode($posts_arr);
  } else {
 
    // set response code - 404 Not found
    http_response_code(404);
    
    // No Posts
    echo json_encode(
      array('message' => 'No Post Found')
    );
  }
  