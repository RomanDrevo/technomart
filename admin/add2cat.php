<?
require "secure/session.inc.php";
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Add to catalog form</title>
    </head>
    <body>

<form action="save2cat.php" method="post">
    <p>Manufacturer: <input type="text" name="title" size="100">
    <p>Model: <input type="text" name="author" size="50">
    <p>Price: <input type="text" name="price" size="6"> $.
    <p><input type="submit" value="Add">
</form>

    </body>
</html>