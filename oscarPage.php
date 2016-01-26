<?php

$f = file_get_contents("./oscars.json.2016/oscars2016.json");
//echo $f;
$j = json_decode($f);
$noms = $j->nominations;//[0][categories;
$ct = count($noms);


$newf = fopen("oscars.html", "w") or die("Unable to open file!");
fwrite($newf, '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">');
fwrite($newf, "<html><head><title>Oscars!</title></head><body>");


fwrite($newf,"<h1>Oscar nominations for " . $j->year_of_awards . "</h2>");


for ($i=0;$i < $ct; $i++){
	$cat = $noms[$i]->category->category_name;
	fwrite($newf,"<h2>" . $cat . "</h2>");
	$nominees = $noms[$i]->category->nominees;
	for ($j=0; $j < count($nominees); $j++){
		fwrite($newf, "<div class='nominee'>");
		if ($nominees[$j]->person != "-1"){
		fwrite($newf, $nominees[$j]->person . ", ");
		}
		fwrite($newf, "<span class='title'>" . $nominees[$j]->title . "</span></div>");
			}

}

fwrite($newf,"</body></html>");
fclose($newf);

//echo $j["nominees"][0]['category']['category_name'];

// foreach ($j as $key => $value) {
// 	echo $j['category']['category_name'];
//           
//         }

?>



