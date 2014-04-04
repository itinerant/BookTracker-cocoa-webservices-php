<?php header("Content-type: text/html; charset=utf-8");
$connection = mysql_connect("localhost", "user", "pass") or die(mysql_error());
mysql_set_charset("utf8", $connection);
mysql_select_db("tracker") or die(mysql_error());

$title = str_replace("'", "''", $_GET['title']);
$author = str_replace("'", "''", $_GET['author']);
$series = str_replace("'", "''", $_GET['series']);
$genre = str_replace("'", "''", $_GET['genre']);
$tags = str_replace("'", "''", $_GET['tags']);

$query = "INSERT INTO books (reader, title, author, series, book_num, genre, age, pages, isbn, goodreads_id, ";
$query += "image_small, image_large, description, own_paperback, own_hardback, own_audiobook, own_ebook) "; 
$query += "VALUES ('".$_GET['reader']."', '".$title."', '".$author."', '".$series."', '".$_GET['booknum'].
		"', '".$genre."', '".$_GET['age']."', '".$_GET['pages']."', '".$_GET['isbn']."', '".$_GET['goodreads_id']."', '".
		$_GET['image_small']."', '".$_GET['image_large']."', '".$_GET['description']."', '".$_GET['own_paperback']."', '".
    .$_GET['own_hardback']."', '".$_GET['own_audiobook']."', '".$_GET['own_ebook']."'')";

mysql_query($query);

print "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
print "<message>".$query."</message>\n";
?>


