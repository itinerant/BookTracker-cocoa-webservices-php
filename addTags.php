<?php header("Content-type: text/html; charset=utf-8");
$connection = mysql_connect("localhost", "user", "pass") or die(mysql_error());
mysql_set_charset("utf8", $connection);
mysql_select_db("tracker") or die(mysql_error());

# Example service call
# http://localhost/booktracker/addTags.php?tags=dystopia,french,pastoral

$tags = str_replace("'", "''", $_GET['tags']);

$tag_list = explode(",", $tags);
forach ($tag_list as $tag)
{

# check for current book_id/tag combination

  $query = "INSERT INTO tags (book_id, tag) ";
  $query += "VALUES ('".$_GET['book_id']."', '".$tag."')";

  mysql_query($query);
}

print "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
print "<message>".$query."</message>\n";
?>