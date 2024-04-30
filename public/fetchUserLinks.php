<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  require_once('db.php');
  require_once('functions.php');
  $data = json_decode(file_get_contents('php://input'));
  $userID = mysqli_real_escape_string($link, $data->{'userID'});

  $page = mysqli_real_escape_string($link, $data->{'page'});
  $overrideMaxResults = mysqli_real_escape_string($link, $data->{'maxResultsPerPage'});
  if($overrideMaxResults) $maxResultsPerPage = $overrideMaxResults;
  $start = $maxResultsPerPage * $page;

  $sql="SELECT id FROM imjurUploads WHERE userID = $userID";
  $res = mysqli_query($link, $sql);
  $totalRecords = mysqli_num_rows($res);
  $totalPages = floor(($totalRecords-1) / $maxResultsPerPage) + 1;

  $sql = "SELECT * FROM imjurUploads WHERE userID = $userID ORDER BY date DESC LIMIT $start, $maxResultsPerPage";
  $res = mysqli_query($link, $sql);
  
  $uploadDir = 'uploads';
  $links = [];
  $meta = [];
  for($i=0; $i<mysqli_num_rows($res); ++$i){
    $row = mysqli_fetch_assoc($res);
    $slug = $row['slug'];
    $uploadID = $row['id'];
    $m = [
      'id'             => $uploadID,
      'slug'           => $slug,
      'size'           => json_decode($row['meta'])->{'file size'},
      'hash'           => $row['hash'],
      'name'           => $row['name'],
      'filetype'       => $row['filetype'],
      'date'           => $row['date'],
      'userID'         => $row['userID'],
      'origin'         => $row['origin'],
      'upvotes'        => $row['upvotes'],
      'private'        => $row['private'],
      'downvotes'      => $row['downvotes'],
      'views'          => $row['views'],
      'description'    => $row['description'],
      'originalSlug'   => $row['originalSlug'],
      'originalDate'   => $row['originalDate'],
      'serverTZO'      => getServerTZOffset(),
    ];
    $suffix = getSuffix($row['filetype']);
    $originalSlug = $row['originalSlug'];
    $links[] = "$uploadDir/$slug.$suffix";
    $meta[] = $m;
  }
  if(sizeof($links)){
    $ct = 0;
    forEach($links as &$lnk){
      $comments = [];
      $uploadID = $meta[$ct++]['id'];
      $sql = "SELECT * FROM imjurComments WHERE uploadID = $uploadID";
      $res = mysqli_query($link, $sql);
      for($i=0; $i<mysqli_num_rows($res); ++$i){
        $row = mysqli_fetch_assoc($res);
        $comments[] = $row;
      }
      $lnk["comments"] = $comments;
    }
    echo json_encode([true, $links, $meta, $totalPages]);
  }else{
    echo json_encode([false]);
  }
?>