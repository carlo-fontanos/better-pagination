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
			this.get_pagination({
				server: 'server.php',
				navigation: '.pagination-nav', 
				content: '.pagination-content',
				template: '#pagination-template',
				perpage: 100
			});
		}
		
		this.get_pagination = function(data) {
			var _this = this;
			var current_page = window.location.hash.split('-')[1]; /* Get current page from the hash or default to 1 */
			
			$(data.navigation).pagination({
				displayedPages: 5, /* Items between first and last buttons */
				ellipsePageSet: false, /* Remove page input field */
				edges: 1, /* Number of buttons to display on the edges */
				cssStyle: 'light-theme',
				currentPage: current_page ? current_page : 1, 
				onInit: _this.render_content(1, data), /* Get content via ajax */
				onPageClick: function(page, event){
					/* Load clicked page number via ajax */
					_this.render_content(page, data);
				}
			});
		}
		
		this.render_content = function(page, data) {
			/* Hide the pagination by default */
			$(data.navigation).hide()
			
			/* AJAX request. */
			jQuery.ajax({
				type: 'POST',
				url: data.server,
				data: {page: page, per_page: data.perpage},
				success: function(response) {
					response = JSON.parse(response);
					/* Append the content to the screen */
					var template = $.templates(data.template);
					var htmlOutput = template.render(response.data);
					$(data.content).html(htmlOutput);

					/* Only update total pages on first load. */
					if(page == 1){
						$(data.navigation).pagination('updateItems', response.total_pages);
					}
					
					/* Display the pagination */
					$(data.navigation).show();
					
					/* Scroll to the top. */
					jQuery('html, body').animate({scrollTop: jQuery(data.content).offset().top-100}, 150);
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