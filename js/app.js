/**
 * App Class
 *
 * @author					Carl Victor C. Fontanos
 * @author_url				www.carlofontanos.com
 *
 */

/**
 * Setup a App namespace to prevent JS conflicts.
 */
var app = {
      
	
	/**
     * Pagination
     */
    Pagination: function () {
		
		this.init = function() {
			this.get_pagination('.pagination-nav', '.pagination-content');
		}
		
		this.get_pagination = function(navigation_element, content_element) {
			var _this = this;
			var current_page = window.location.hash.split('-')[1]; /* Get current page from the hash or default to 1 */
			
			$(navigation_element).pagination({
				displayedPages: 5, /* Items between first and last buttons */
				ellipsePageSet: false, /* Remove page input field */
				edges: 1, /* Number of buttons to display on the edges */
				cssStyle: 'light-theme',
				currentPage: current_page ? current_page : 1, 
				onInit: _this.render_content(1, navigation_element, content_element), /* Get content via ajax */
				onPageClick: function(page, event){
					/* Load clicked page via ajax */
					_this.render_content(page, navigation_element, content_element);
				}
			});
		}
		
		this.render_content = function(page, navigation_element, content_element) {
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

					/* Only update total pages on first load. */
					if(page == 1){
						$(navigation_element).pagination('updateItems', data.total_pages);
					}
					
					/* Display the pagination */
					$(navigation_element).show();
					
					/* Scroll to the top. */
					jQuery('html, body').animate({scrollTop: jQuery(content_element).offset().top-100}, 150);
				}
			});		
		}
	}
}

/**
 * When the document has been loaded...
 *
 */
jQuery(document).ready( function () {
	pagination = new app.Pagination(); /* Instantiate the Pagination Class */
    pagination.init(); /* Load Pagination class methods */
});