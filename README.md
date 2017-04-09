# HighSpeed Pagination

Instead of relying on the server side to generate the HTML template and pagination buttons, it would be a lot easier and faster if we seprate each task like this:
+ Server side should only handle the queries then return the data in json format. 
+ JsRender will handle the rendering of HTML.
+ simplePagination will be the one generating the pagination button.

## Plugins used:
+ JsRender: https://www.jsviews.com/
+ SimplePagination: http://flaviusmatis.github.io/simplePagination.js/

In this example, I used PHP as my server side scripting. Feel free to use any other server-side programming languages.

