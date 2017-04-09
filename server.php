<?php 
/**
 * @author					Carl Victor C. Fontanos
 * @author_url				www.carlofontanos.com
 * 
 */
 
require_once('lib/wp-db.php');

global $wpdb;

$page = $_POST['page'];
$page -= 1;
$per_page = $_POST['per_page'];
$start = $page * $per_page;
$all_items = $wpdb->get_results( $wpdb->prepare("SELECT * FROM item LIMIT %d, %d", $start, $per_page ) );
$count = $wpdb->get_var("SELECT COUNT(id) FROM item" );
$total_pages = ceil( $count / $per_page );

$format_data = array(
	'content'	=> $all_items,
	'total_pages' => $total_pages
);

echo json_encode( $format_data );