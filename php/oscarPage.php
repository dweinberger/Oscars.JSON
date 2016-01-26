<?php

// a litle php script that outputs an oscars.json file
// as an html page. Very minimal.
// Use this little piece of crap any way you want.
// No attribution required.
// Just don't laugh at it in public. Thanks.
// - David Weinberger
// Jan. 26, 2015

$json_path = "../oscars.json.2016/oscars2016.json";

$f = file_get_contents($json_path);
$j = json_decode($f);
$noms = $j->nominations;//[0][categories;
$ct = count($noms);

$outputfile_name = "oscars.html";
$newf = fopen($outputfile_name, "w") or die("Unable to open file!");
fwrite ($newf, '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">');
fwrite ($newf, "<html><head><title>Oscars!</title><link type='text/css' rel='stylesheet' href='oscars.css'></head><body>");

$whichyear = $j->year_of_awards;

fwrite($newf,"<div id='pagetitle'>Oscar nominations for " . $whichyear . "</div>");


for ($i=0;$i < $ct; $i++){
	$cat = $noms[$i]->category->category_name;
	fwrite($newf,"<div class='category'>");
	fwrite($newf,"<div class='cat_title'>" . $cat . "</div>");
	$nominees = $noms[$i]->category->nominees;
	for ($j=0; $j < count($nominees); $j++){
		fwrite ($newf, "<div class='nominee'>");
		if (isset($nominees[$j]->person) && ($nominees[$j]->person != "-1")){
			fwrite ($newf, "<span class='person'>" . $nominees[$j]->person . ", </span> ");
		}
		fwrite ($newf, "<span class='title'>" . $nominees[$j]->title . "</span></div>");
			}
		fwrite($newf, "</div>");

}

fwrite($newf,"</body></html>");
fclose($newf);

echo "<p>Wrote " . $ct . " categories for the " . $whichyear . " Oscars to " . $outputfile_name . ".<p>"; 

?>



