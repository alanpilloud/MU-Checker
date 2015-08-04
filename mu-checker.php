<?php
/*
* Loading WP framework
*/
require( dirname( __FILE__ ) . '/wp-blog-header.php' );

/*
* Get the existing blogs
*/
$existing_blogs = $wpdb->get_results( "SELECT blog_id FROM $wpdb->blogs", ARRAY_A);
foreach($existing_blogs as $blog) {
  $existing_blogs_list[] = $blog['blog_id'];
}

/*
* Simple css styles
*/
$css = array(
  'success' => 'padding:3px',
  'error' => 'padding:3px;background:#d9534f;color:#fff'
);

echo 
'<h1>Welcome to MU-Checker</h1>',
'<p>Use this tool to find ghost folders and tables that usually appears after deleting a blog.</p>';


/*
* Get the blogs directories in wp-content/blogs.dir/
*/
echo '<h3>Checking for ghost blogs.dir folder</h3>';
$blogsdir_ids = scandir(WP_CONTENT_DIR.'/blogs.dir');
foreach($blogsdir_ids as $k => $id) {
  if($id == '.' || $id == '..') {
    continue;
  }
  if(!in_array($id,$existing_blogs_list)) {
    echo '<div style="'.$css['error'].'">Folder blogs.dir/'.$id.' has no blog</div>';
  } else {
    echo '<div style="'.$css['success'].'">Folder blogs.dir/'.$id.' has a blog</div>';
  }
}

/*
* Get the blogs directories in wp-content/uploads/sites/
*/
echo '<h3>Checking for ghost blogs.dir folder</h3>';
$blogsdir_ids = scandir(WP_CONTENT_DIR.'/uploads/sites');
foreach($blogsdir_ids as $k => $id) {
  if($id == '.' || $id == '..') {
    continue;
  }
  if(!in_array($id,$existing_blogs_list)) {
    echo '<div style="'.$css['error'].'">Folder uploads/sites/'.$id.' has no blog</div>';
  } else {
    echo '<div style="'.$css['success'].'">Folder uploads/sites/'.$id.' has a blog</div>';
  }
}

/*
* Get the blogs db tables
*/
echo '<h3>Checking for ghost database tables</h3>';
$existing_tables = $wpdb->get_results( "SHOW TABLES IN ".DB_NAME, ARRAY_A);
foreach($existing_tables as $table) {
  $table = reset($table);
  $table_parts = explode('_',$table);
  if(is_numeric($table_parts[1]) && !in_array($table_parts[1],$existing_tables_list)) {
    $existing_tables_list[] = $table_parts[1]; //only to avoid multiple loops
    
    if(!in_array($table_parts[1],$existing_blogs_list)) {
      echo '<div style="'.$css['error'].'">Tables for blog id '.$table_parts[1].' have no blog</div>';
    } else {
      echo '<div style="'.$css['success'].'">Tables for blog id '.$table_parts[1].' have a blog</div>';
    }
  }
}
?>
