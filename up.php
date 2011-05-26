<?php
include('config.php');
$file = null;
$site = null;
if (empty($_FILES['media']['name']) && empty($_GET['site'])){
	echo "empty";
	exit();
}
else {
	$file = $_FILES['media'];
	$site = $_GET['site'];
}

$names = array();
$shorts = mysql_query("SELECT `long`, `short` FROM `shorten`");
// build array of previously used names
while ($row = mysql_fetch_assoc($shorts)){
    $names[$row['long']] = $row['short'];
}

// if we've already shortened it before, don't duplicate the entry
if (array_key_exists($site, $names)){
    echo "http://$site_url/".$names[$site];
    exit;
}

/**
 * before we proceed, check to make sure the url is legit
 **/
if ($site && $gsb_url){
    $gsb_url = 'https://sb-ssl.google.com/safebrowsing/api/lookup?client=shortnsweet&apikey='.$gsb_key.'&appver=1.5.2&pver=3.0&url='.urlencode($site);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gsb_url);
    curl_exec($ch);
    $resp = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // for codes:
    // http://code.google.com/apis/safebrowsing/lookup_guide.html#HTTPGETRequestResponseCode
    if ($resp != 204){
        echo "bad url";
        exit;
    }
}

// set filename initially
$filename = "";
$count = 0;

// spiffy loop to generate unique name
do {
	for ($i = 0; $i < $url_length; $i++){
		$num = rand(0, 25);
		$filename .= $usable[$num];
	}
	$count++;
} while (in_array($filename, $names) && $count < 100);

if ($file){
	// twitter iOS client doesn't give name
	if ($_POST['message']){
		$file['name'] = substr(strtolower(preg_replace('/[^a-z0-9]+/i', '-', $_POST['message'])), 0, 15).'.jpg';
	}
	// move file to randomly generated name for uniqueness
	if (!move_uploaded_file($file['tmp_name'], "files/$filename-".$file['name'])){
		echo "cannot save file";
        exit;
	}
	else {
	    if (mysql_query("INSERT INTO `shorten` (`long`, `short`, `site`, `ip`, `tweet`) VALUES ('".mysql_escape_string($file['name'])."', '$filename', 0, '$_SERVER[REMOTE_ADDR]', '".mysql_escape_string($_POST['message'])."')")){
            if (!$_POST['message']) header("Location: $filename");
            else echo "http://$site_url/$filename";
	    }
	    else {
			echo "error with database";
            exit;
	    }
	}
}
else {
	if (!mysql_query("INSERT INTO `shorten` (`long`, `short`, `site`, `ip`, `tweet`) VALUES ('".mysql_escape_string($_GET['site'])."', '$filename', 1, '$_SERVER[REMOTE_ADDR]', '".mysql_escape_string($_POST['message'])."')")){
		echo "error with database";
        exit;
    }
}
echo "http://$site_url/$filename";
?>
