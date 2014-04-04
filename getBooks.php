<?php header("Content-type: text/html; charset=utf-8");
$connection = mysql_connect("localhost", "user", "pass") or die(mysql_error());
mysql_set_charset("utf8", $connection);
mysql_select_db("tracker") or die(mysql_error());

# Example service call
# http://localhost/booktracker/getBooks.php?reader=Jane&title=&author=&series=&genre=&age=&month=&year=&format=paperback

(empty($_POST['action'])) ? 'default' : $_POST['action'];

$reader = (empty($_GET['reader'])) ? '%' : $_GET['reader'];
$title = (empty($_GET['title'])) ? '%' : $_GET['title'];
$author = (empty($_GET['author'])) ? '%' : $_GET['author'];
$series = (empty($_GET['series'])) ? '%' : $_GET['series'];
$genre = (empty($_GET['genre'])) ? '%' : $_GET['genre'];
$age = (empty($_GET['age'])) ? '%' : $_GET['age'];
$month = (empty($_GET['month'])) ? '%' : $_GET['month'];
$year = (empty($_GET['year'])) ? '%' : $_GET['year'];
$format = (empty($_GET['format'])) ? '%' : $_GET['format'];

$title = str_replace("'", "''", $title);
$author = str_replace("'", "''", $author);
$series = str_replace("'", "''", $series);
$genre = str_replace("'", "''", $genre);

$query = "select * from books where reader like '".$reader."' and title like upper('%".$title.
	"%') and author like upper('%".$author."%') and series like upper('%".$series."%') and genre like '".$genre.
	"' and age like '".$age."'"
	"' and date like '".$month."%' and date like '%".$year."' and format like '".$format."'";

$result = mysql_query($query) or die(mysql_error());

print "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
print "<books>\n";
while($row = mysql_fetch_array($result))
{
	print "<book>\n";
	print "\t<book_id><![CDATA[".$row['id']."]]></book_id>\n";
	print "\t<title><![CDATA[".$row['title']."]]></title>\n";
	print "\t<author><![CDATA[".$row['author']."]]></author>\n";
	print "\t<series><![CDATA[".$row['series']."]]></series>\n";
	print "\t<book_num>".$row['book_num']."</book_num>\n";
	print "\t<genre><![CDATA[".$row['genre']."]]></genre>\n";
	print "\t<age>".$row['age']."</age>\n";
	print "\t<pages>".$row['pages']."</pages>\n";
	print "\t<audiobook>".$row['audiobook']."</audiobook>\n";
	print "\t<isbn>".$row['isbn']."</isbn>\n";
	print "\t<image_small>".$row['image_small']."</image_small>\n";
	print "\t<image_large>".$row['image_small']."</image_small>\n";
	print "\t<description>".$row['description']."</description>\n";
	print "\t<own_paperback>".$row['own_paperback']."</own_paperback>\n";
	print "\t<own_hardback>".$row['own_hardback']."</own_hardback>\n";
	print "\t<own_audiobook>".$row['own_audiobook']."</own_audiobook>\n";
	print "\t<own_ebook>".$row['own_ebook']."</own_ebook>\n";
	print "</book>\n";
}
print "</books>\n";
?>
