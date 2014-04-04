<?php header("Content-type: text/html; charset=utf-8");
$connection = mysql_connect("localhost", "user", "pass") or die(mysql_error());
mysql_set_charset("utf8", $connection);
mysql_select_db("tracker") or die(mysql_error());

$query = "select * from books where id = 23";
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
  print "\t<isbn>".$row['isbn']."</isbn>\n";
  print "\t<goodreads_id>".$row['goodreads_id']."</goodreads_id>\n";
  print "\t<image_small>".$row['image_small']."</image_small>\n";
  print "\t<image_large>".$row['image_large']."</image_large>\n";
  print "\t<description>".$row['description']."</description>\n";
  print "\t<own_paperback>".$row['own_paperback']."</own_paperback>\n";
  print "\t<own_hardback>".$row['own_hardback']."</own_hardback>\n";
  print "\t<own_audiobook>".$row['own_audiobook']."</own_audiobook>\n";
  print "\t<own_ebook>".$row['own_ebook']."</own_ebook>\n";

  $tag_query = "select * from tags where book_id = '" .$row['id']."'";
  $tag_result = mysql_query($tag_query) or die(mysql_error());
  print "\t<tags>\n";
  while($tag_row = mysql_fetch_array($tag_result))
  {
    print "\t\t<tag>".$tag_row['tag']."</tag>\n";
  }
  print "\t</tags>\n";
  print "</book>\n";
}
print "</books>\n";
?>