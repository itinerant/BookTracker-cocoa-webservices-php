<?php header("Content-type: text/html; charset=utf-8");
$connection = mysql_connect("localhost", "user", "pass") or die(mysql_error());
mysql_set_charset("utf8", $connection);
mysql_select_db("tracker") or die(mysql_error());

# Example service call
# http://localhost/booktracker/getTags.php?bookid=83

$book_id = (empty($_GET['bookid'])) ? 'All' : $_GET['bookid'];

if($book_id == 'All')
{
  $result = mysql_query("SELECT distinct tag FROM tags order by upper(tag)")
  or die(mysql_error());  
}
else
{
  $result = mysql_query("SELECT distinct tag FROM tags where book_id = '".$book_id."' order by upper(tag)")
  or die(mysql_error());  
}

print "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
print "<tags>\n";
while($row = mysql_fetch_array($result))
{
        print "\t<tag><![CDATA[".$row['tag']."]]></tag>\n";
}
print "</tags>\n";
?>

