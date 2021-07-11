<?php

include_once 'common/common.php';
$db = new mysqli($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd,$cfg_dbname);
$queryPrepare = "insert into pic(url) values(?)";
$stmt = $db->prepare($queryPrepare);
$stmt->bind_param("s",$time);
$stmt->execute();


/*
$url = 'http://api.flickr.com/services/rest/'; // 请求的URL地址
$params = '?method=flickr.photos.search' . // method指明Flickr API所提供的某个方法
 '&api_key=0c4c00a9156c69e12e35593f436b7a2a' .  // Flickr分配的key
 '&tags='.$keyword.'&per_page=11'; // 关键字
//生成的URL
//http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=2f59b5e190101271213d4b636e30824f&text=sea
//如果把改URL黏贴到浏览器的地址栏里，同样可以得到XML文件
$contents = file_get_contents($url . $params);
$xml = new SimpleXMLElement($contents); // 解析XML文件
foreach ($xml->photos->photo as $value) {
	$src = 'http://farm' . $value['farm'] . ".static.flickr.com/" .
	$value['server'] . '/' . $value['id'] . '_' . $value['secret'] . '_m.jpg'; // _s用来控制显示图片的大小 reference:http://www.flickr.com/services/api/misc.urls.html
	$stmt->bind_param("s",$src);
	$stmt->execute();
	echo "<img src=\"$src\" />";
}
*/

$url = 'http://news.search.yahoo.com/news/rss?p='.$keyword; //Yahoo API to retrieve news feeds
$contents = file_get_contents($url);
$xml = new SimpleXMLElement($contents); // 解析XML文件
foreach ($xml->channel->item as $value) {
	$src= $value->link;
	$stmt->bind_param("s",$src);
	$stmt->execute();
        echo $src;

}

?>
