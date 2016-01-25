<?php

$f = file_get_contents("./oscars.json.2015/oscars2015.json");
//echo $f;
$j = json_decode($f);
$noms = $j["nominations"];//[0][categories;
$ct = count($noms);
echo $ct;
for ($i=0;$i < $ct; $i++){
	$cat = $noms[$i]->category->category_name;
	echo $cat;

}

//echo $j["nominees"][0]['category']['category_name'];

// foreach ($j as $key => $value) {
// 	echo $j['category']['category_name'];
//           
//         }

?>



