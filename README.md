# Better Pagination

Instead of relying on the server side to generate the HTML template and pagination buttons, it would be a lot easier and faster if we seprate each task like this:
+ Server side will handle the queries then return the data in json format. 
+ JsRender will use the json data to render the HTML.
+ simplePagination will be responsible for generating the pagination buttons.

## Advantages:
+ Faster paging response time. 
+ Easier to format HTML template.
+ Easier for other applications to interface with your data because the return type is in standard JSON format.
+ Server side is so much lighter, we only need to focus on the queries and nothing else!

In this example I made use of PHP as my server side scripting.

## Plugins used:
+ JsRender: https://www.jsviews.com/
+ SimplePagination: http://flaviusmatis.github.io/simplePagination.js/
