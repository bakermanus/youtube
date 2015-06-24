<?php

require 'youtube.php';

$v = isset($_GET['v']) ? $_GET['v'] : 'dQw4w9WgXcQ';

$youtube = new youtube($v);

echo '<h1>'.$youtube->title.'</h1>';

echo '<img src="'.$youtube->images['small'].'">';

echo '<br><br>';

echo date('i:s', $youtube->duration);

echo '<br><br>';

echo '<table>';

echo '<tr>';
echo '<td>iTag</td>';
echo '<td>Type</td>';
echo '<td>Extention</td>';
echo '<td>Size</td>';
echo '<td>FPS</td>';
echo '<td>Bitrate</td>';
echo '<td>Lenght</td>';
echo '<td>Link</td>';
echo '</tr>';

foreach($youtube->videos as $id => $video)
{
	if($video['lenght'] != '-') $video['lenght'] = round($video['lenght']/1048576, 2).' MB';
	if($video['bitrate'] != '-') $video['bitrate'] = round($video['bitrate']/1048576, 2).' Mb';
	
	echo '<tr>';
	echo '<td>'.$video['itag'].'</td>';
	echo '<td>'.$video['type'].'</td>';
	echo '<td>'.$video['extention'].'</td>';
	echo '<td>'.$video['size'].'</td>';
	echo '<td>'.$video['fps'].'</td>';
	echo '<td>'.$video['lenght'].'</td>';
	echo '<td>'.$video['bitrate'].'</td>';
	echo '<td><a id="link'.$id.'" href="'.$video['url'].'&title='.urlencode($youtube->title).'" download="'.$youtube->title.'.'.strtolower($video['extention']).'">Right click &gt; Save as</a></td>';
	echo '</tr>';
}

echo '</table>';

if(!empty($video['s']))
{
	echo '<script>';
	
	echo $youtube->script;
	
	foreach($youtube->videos as $id => $video)
	{
		echo 'document.getElementById("link'.$id.'").href += "&signature=" + '.$youtube->signature.'("'.$video['s'].'");';
	}
	
	echo '</script>';
}

?>