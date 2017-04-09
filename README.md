# HighSpeed Pagination

Instead of relying on the server side to generate the HTML template and pagination buttons, it would be a lot easier and faster if we seprate each task like this:
+ Server side should only handle the queries then return the data in json format. 
+ JsRender will handle the rendering of HTML.
+ simplePagination will be responsible for generating the pagination buttons.

## Plugins used:
+ JsRender: https://www.jsviews.com/
+ SimplePagination: http://flaviusmatis.github.io/simplePagination.js/

## Advantages:
+ Very fast server response time. 
+ Easier to format the template.
+ Easier for other applications to interface with your data because the return type is in JSON format.
+ Server side is so much lighter, we only need to focus on the queries and nothing else!

In this example I used PHP as my server side scripting. Feel free to use any other server-side programming languages.

