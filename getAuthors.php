<?php header("Content-type: text/html; charset=utf-8");
$connection = mysql_connect("localhost", "user", "pass") or die(mysql_error());
mysql_set_charset("utf8", $connection);
mysql_select_db("tracker") or die(mysql_error());

$result = mysql_query("SELECT distinct author FROM books order by author")
or die(mysql_error());  

print "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
print "<authors>\n";
while($row = mysql_fetch_array($result))
{
        print "\t<author><![CDATA[".$row['author']."]]></author>\n";
}
print "</authors>\n";
?>
