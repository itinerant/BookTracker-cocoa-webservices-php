<?php header("Content-type: text/html; charset=utf-8");
$db=new SQLite3("booktracker.db", 0666);
(empty($_POST['action'])) ? 'default' : $_POST['action'];

# Example service call
# http://localhost/booktracker/getBooks.php?reader=Jane&title=&author=&series=&genre=&age=&month=&year=&format=paperback

$reader = (empty($_GET['reader'])) ? '%' : $_GET['reader'];
$title = (empty($_GET['title'])) ? '%' : $_GET['title'];
$author = (empty($_GET['author'])) ? '%' : $_GET['author'];
$series = (empty($_GET['series'])) ? '%' : $_GET['series'];
$genre = (empty($_GET['genre'])) ? '%' : $_GET['genre'];
#$category = (empty($_GET['category'])) ? '%' : $_GET['category'];
$age = (empty($_GET['age'])) ? '%' : $_GET['age'];
$month = (empty($_GET['month'])) ? '%' : $_GET['month'];
$year = (empty($_GET['year'])) ? '%' : $_GET['year'];
$format = (empty($_GET['format'])) ? '%' : $_GET['format'];

$title = str_replace("'", "''", $title);
$author = str_replace("'", "''", $author);
$series = str_replace("'", "''", $series);
$genre = str_replace("'", "''", $genre);
#$category = str_replace("'", "''", $category);

$query = "select * from readings r join books b on b.id = r.book";
$query .= " where reader like '".$reader."' and title like upper('%".$title."%')";
$query .= " and author like upper('%".$author."%') and series like upper('%".$series."%')";
$query .= " and genre like '".$genre."' and age like '".$age;
#$query .= " #' and category like '".$category."'";
$query .= " and month like '".$month."' and year like '".$year."' and format like '".$format."'";

$result = $db->query($query);

print "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
print "<books>\n";
while($row = $result->fetchArray())
{
	print "<book>\n";
	print "\t<title><![CDATA[".$row['title']."]]></title>\n";
	print "\t<author><![CDATA[".$row['author']."]]></author>\n";
	print "\t<series><![CDATA[".$row['series']."]]></series>\n";
	print "\t<book_num>".$row['book_num']."</book_num>\n";
	print "\t<genre><![CDATA[".$row['genre']."]]></genre>\n";
	print "\t<date><![CDATA[".$row['month']." ".$row['year']"]]></date>\n";
	print "\t<agegroup><![CDATA[".$row['age']."]]></agegroup>\n";
	print "\t<pages>".$row['pages']."</pages>\n";
	print "\t<isbn>".$row['isbn']."</isbn>\n";
	print "</book>\n";
}
print "</books>\n";

$db->close();
?>
