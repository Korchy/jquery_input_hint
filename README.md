# InputHint
InputHint is the JQUERY plugin that adds an ability to help the user with hints when he is typing text in the input field.

<img src="https://progr.interplanety.org/wp-content/upload_content/2021/02/preview_00_1200x600-400x200.jpg"><p>

Current vertsion
-
1.0.0.

Tested in
-
Google Chrome 88, Firefox 85, Opera 74

Requirements
-
- PHP must be available on your site
- JQUERY must be linked to your page

Plugin files
-
InputHint plugin requires the following files to work:

- <b>page.html</b>

Your page where you place the input field.

- <b>inputhint/inputhint.js</b>

The main plugin file must be included on the main page.

- <b>inputhint/inputhint.css</b>

File with CSS-styles to make the hints looks like you need. Must be included on the main page.

- <b>query.php</b>

File with a query that executes each time the user types text in the input field to return the relevant hints.

Plugin functionality
-
To include the InputHint plugin to your page, you need:

1. Modify your main page.

In the "head" block include the link to the .css file:

    <head>
        <link
            href="inputhint/inputhint.css"
            type="text/css" rel="stylesheet"
        >
    </head>

Add the "inputhint" class, and "hint_query" and "limit" paramenters to the input field which requires hints:

    <input type="text"
        class="inputhint"
        hint_query="query.php"
        limit="5"
    >

In the "hint_query" parameter specify the path to the query.php file.

Link the js-script to your page: 

    <script type="text/javascript"
        src="inputhint/inputhint.js"
    ></script>

Don't forget to link the JQUERY to your page:

    <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"
    ></script>

2. Change the query.php file so that it returns valid hints for the text, typed by the user.

PHP is required on your site!

It could be an SQL request to the database or any other code, that returns the two-dimensional array with hints.

The simplest example:

    $query_rez = [
            ['a' => 'Text_A'],
            ['b' => 'Text_B'],
            ['c' => 'Text_C'],
            ['d' => 'Text_D']
        ];

The first value of each row would be shown and the input field would be filled with it if the user clicks on the hint.

3. Modify the "inputhint.css" file.

You can change the CSS to make the hint looks like as you need.

4. That's all.

Now, every time when the user types a text in the input field (with 3 of more letters), the query.php file is executed and the result of its execution shows to the user as hints.

If the user clicks on any hint item, the input field fills with the selected text and the custom event "inputhint_item_selected" generates to process the selection by another script if it needs.

More Info
-
For additional information please visit the <a href="progr.interplanety.org/en/inputhint/">InputHint</a> web page.
