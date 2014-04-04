<?php header("Content-type: text/html; charset=utf-8");
$connection = mysql_connect("localhost", "user", "pass") or die(mysql_error());
mysql_set_charset("utf8", $connection);
mysql_select_db("tracker") or die(mysql_error());

$result = mysql_query("SELECT distinct genre FROM books order by genre")
or die(mysql_error());  

print "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
print "<genres>\n";
while($row = mysql_fetch_array($result))
{
        print "\t<genre><![CDATA[".$row['genre']."]]></genre>\n";
}
print "</genres>\n";
?>

