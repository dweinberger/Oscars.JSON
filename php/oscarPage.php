<?php

// a small php script that outputs an oscars.json file
// as an html page. Very minimal.
// Use this little piece of crap any way you want.
// No attribution required.
// Just don't laugh at it in public. Thanks.
// - David Weinberger
// Jan. 26, 2015

// where the json file lives
$json_path = "../oscars.json.2016/oscars2016.json";

// get the contents
$f = file_get_contents($json_path);
$j = json_decode($f);
//get the array of nominations -- E.g., "Best Picture" consists of 7 nominated films
$noms = $j->nominations;
// how many categories of nomination are there?
$ct = count($noms);

// Give the output file a name
$outputfile_name = "oscars.html";
// Create and open the output file
$newf = fopen($outputfile_name, "w") or die("Unable to open file!");
// Write the HTML header into it
fwrite ($newf, '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">');
fwrite ($newf, "<html><head><title>Oscars!</title><link type='text/css' rel='stylesheet' href='oscars.css'></head><body>");

// Get the year of these nominations -- this is the year the award
//     is given which is one more than the year when the films were released
$whichyear = $j->year_of_awards;

// Write the title of the page
fwrite($newf,"<div id='pagetitle'>Oscar nominations for " . $whichyear . "</div>");

// cycle through all the nominations
for ($i=0;$i < $ct; $i++){
	// get the category name, e.g., "Best Picture"
	$cat = $noms[$i]->category->category_name;
	// Create a div to contain the entire set of nominations for that category
	fwrite($newf,"<div class='category'>");
	// Add the name of the category
	fwrite($newf,"<div class='cat_title'>" . $cat . "</div>");
	// Get all the nominees for that category
	$nominees = $noms[$i]->category->nominees;
	// Within a category, cycle through the nominations
	for ($j=0; $j < count($nominees); $j++){
		// create a div for each nominee
		fwrite ($newf, "<div class='nominee'>");
		// If there's a "person" key, then write it out, and add a comma
		if (isset($nominees[$j]->person) && ($nominees[$j]->person != "-1")){
			fwrite ($newf, "<span class='person'>" . $nominees[$j]->person . ", </span> ");
		}
		// write the title of the movie
		fwrite ($newf, "<span class='title'>" . $nominees[$j]->title . "</span></div>");
			}
		// end that category's div
		fwrite($newf, "</div>");

}

// close up the html code
fwrite($newf,"</body></html>");
// close the file
fclose($newf);

// Note on the page visible to the user that the process is over
echo "<p>Wrote " . $ct . " categories for the " . $whichyear . " Oscars to " . $outputfile_name . ".<p>"; 

// Open the html file in a browser and do a File > Save to save it.

?>



