<?php
  // You can simulate a slow server with sleep
  // sleep(2);
require_once("initialize.php");



  //if(!isset($_SESSION['favorites'])) { $_SESSION['favorites'] = []; }

  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  if(!is_ajax_request()) { exit; }

  // extract $id
  $id = isset($_POST['id']) ? $_POST['id'] : '';
  insertWish($id,$_SESSION['user_email']);
  echo 'true';


  /*
  if(preg_match("/blog-post-(\d+)/", $raw_id, $matches)) {
    $id = $matches[1];

    // store in $_SESSION['favorites']
    //if(!in_array($id, $_SESSION['favorites'])) {
    //  $_SESSION['favorites'][] = $id;
    //}

    insertWish($id);
    echo 'true';
  } else {
    echo 'false';
  }
  */
?>
