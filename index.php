<?php 
/**
 * SimplePagination: 		http://flaviusmatis.github.io/simplePagination.js/
 * Wordpress WPDB Class: 	http://perials.com/using-wpdb-in-core-php-non-wordpress-projects/
 * JsRender: 				https://www.jsviews.com/
 * 
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="lib/simplePagination/simplePagination.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jsrender/0.9.84/jsrender.min.js"></script>
    <script src="lib/simplePagination/simplePagination.js" type="text/javascript"></script>
	<script id="pagination-template" type="text/x-jsrender">
		<div class="col-sm-3 item-{{:id}}">
			<div class="panel panel-default">
				<div class="panel-heading item-name">{{:iname}}</div>
				<div class="panel-body p-0 p-b">
					<a href="#">
						<img src="//placeholdit.imgix.net/~text?txtsize=33&txt=150%C3%97150&w=300&h=300" width="100%" class="img-responsive item-featured">
					</a>
					<div class="list-group m-0">
						<div class="list-group-item b-0 b-t">
							<i class="fa fa-calendar-o fa-2x pull-left ml-r"></i>
							<p class="list-group-item-text">Price</p>
							<h4 class="list-group-item-heading">$<span class="item-price">{{:minbid}}</span></h4>
						</div>
						<div class="list-group-item b-0 b-t">
							<i class="fa fa-calendar fa-2x pull-left ml-r"></i>
							<p class="list-group-item-text">Quantity</p>
							<h4 class="list-group-item-heading item-stock">{{:quantity}}</h4>
						</div>
					</div>
				</div>
				<div class="panel-footer">	
					<a href="#" class="btn btn-success btn-block">View Item</a>
				</div>
			</div>
		</div>
		{{if (#index+1)%4 == 0}}
			<!-- Add clearfix every 4 items -->
			<div class = "clearfix"></div>
		{{/if}}
	</script>
</head>
<body>
	<br />
	<div class="container">
		<div class="clearfix">
			<div class="pagination-content"></div>
		</div>
		<div class="clearfix">
			<div class="pagination-nav clearfix"></div>
		</div>
	</div>
	<br />

	<script type="text/javascript">
		$(document).ready(function () {
			/* Load the pagination when DOM rendering is complete */
			get_pagination('.pagination-nav', '.pagination-content');
		});
		
		function get_pagination(navigation_element, content_element){
			var current_page = window.location.hash.split('-')[1]; /* Get current page from the hash or default to 1 */
			
			$(navigation_element).pagination({
				displayedPages: 5, /* Items between first and last buttons */
				ellipsePageSet: false, /* Remove page input field */
				edges: 1, /* Number of buttons to display on the edges */
				cssStyle: 'light-theme',
				currentPage: current_page ? current_page : 1, 
				onInit: render_content(1, navigation_element, content_element), /* Get content via ajax */
				onPageClick: function(page, event){
					/* Load clicked page via ajax */
					render_content(page, navigation_element, content_element);
				}
			});
		}
		
		function render_content(page, navigation_element, content_element){
			/* Hide the pagination by default */
			$(navigation_element).hide()
			
			/* AJAX request. */
			jQuery.ajax({
				type: 'POST',
				url: 'server.php',
				data: {page: page, per_page: 100},
				success: function(data) {
					data = JSON.parse(data);
					/* Append the content to the screen */
					var template = $.templates("#pagination-template");
					var htmlOutput = template.render(data.content);
					$(content_element).html(htmlOutput);

					/* Only update total pages on first load or when performing filters. */
					if(page == 1){
						$(navigation_element).pagination('updateItems', data.total_pages);
					}
					
					/* Display the pagination */
					$(navigation_element).show();
				}
			});		
		}
	</script>
</body>
</html>