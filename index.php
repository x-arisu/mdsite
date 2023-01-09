<?php
include 'static/config.php';
include 'static/Parsedown.php';
// Start HTML
echo <<< HTML
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="$MetaDesc">

	<meta property="og:type" content="website">
	<meta property="og:url" content="$URL">
	<meta property="og:title" content="$MetaTitle">
	<meta property="og:description" content="$MetaDesc">
	<meta property="og:image" content="$MetaImg">

	<meta property="twitter:card" content="summary">
	<meta property="twitter:url" content="$URL">
	<meta property="twitter:title" content="$MetaTitle">
	<meta property="twitter:description" content="$MetaDesc">
	<meta property="twitter:image" content="$MetaImg">
	<title>$SiteTitle</title>
	<link rel="stylesheet" type="text/css" href="$CSS">
	<link rel="icon" type="image/x-icon" href="$Favicon">
	</head>
	<body>
HTML;
//Begin parsing markdown
$Parsedown = new Parsedown(); 
$path = $_SERVER["DOCUMENT_ROOT"] . '/' ;
//Adds nav if exists
if ($Nav != "" && is_file($path . $Nav . ".md")){
	$file = file_get_contents($path . $Nav . ".md");
	echo $Parsedown->text($file);
}
//no path set, direct to index
if (empty($_GET["page"])) { $_GET["page"] = "index"; } 
elseif (is_dir($path . $_GET["page"]) && (!is_file($path . $_GET["page"] . "/index.md")) && (str_contains($_GET["page"], "screenshots_"))) {
	foreach (scandir($path . $_GET["page"], 1) as $item){
		if ($item == "." || $item == ".." || $item == "header.md" || $item == "footer.md" || is_dir($path . $_GET["page"] . "/" . $item)) { continue; }
		if (!is_file($path . $_GET["page"] . "/thumbs/" . $item))
		{	
			shell_exec("/usr/bin/ffmpeg -i " . $path . $_GET["page"] . "/". $item . " -vf scale=250:140,crop=140:140 " . $path . $_GET["page"] ."/thumbs/" . $item);
		}
		echo "<a href=\"" . $_GET["page"] . "/" . $item . "\">";
		echo "<img style=\"float: left; margin: 8px 15px;\" src=\"/" . $_GET["page"] . "/thumbs/" . $item . "\">";
		echo "</a>";
	}

}
//A directory without an index, lists other MD files and directorys 
elseif (is_dir($path . $_GET["page"]) && (!is_file($path . $_GET["page"] . "/index.md"))) {
	if (is_file($path . $_GET["page"] . "/header.md")){
		$file = file_get_contents($path . $_GET["page"] . '/header.md');
		echo $Parsedown->text($file);
	}
	echo "<ul>";
	foreach (scandir($path . $_GET["page"], 1) as $item){
		if ($item == "." || $item == ".." || $item == "header.md" || $item == "footer.md") { continue; }
		elseif ((is_file($path . $_GET["page"] . '/' . $item) && (pathinfo($path . $_GET["page"] . '/' . $item)['extension'] != "md"))) { continue; }
		echo "<li><a href=\"?page=" . $_GET["page"] . '/' . pathinfo($path . $_GET["page"] . '/' . $item)['filename'] . "\">" . pathinfo($path . $_GET["page"] . '/' . $item)['filename'] . "</a></li>";
	}
	echo "</ul>";
	if (is_file($path . $_GET["page"] . "/footer.md")){
		$file = file_get_contents($path . $_GET["page"] . '/footer.md');
		echo $Parsedown->text($file);
	}
}
// a direct link to a md page
elseif (is_file($_GET["page"] . ".md")){} 
// directory with an index
elseif (is_dir($path . $_GET["page"])){ $_GET["page"] .= "/index"; } 
if ((!is_dir($path . $_GET["page"])) && !is_file($path . $_GET["page"] . ".md")){
	$file = file_get_contents($path . $FileNotFound . '.md');
	echo $Parsedown->text($file);
}
elseif (!is_dir($path . $_GET["page"])) {
	$file = file_get_contents($path . $_GET["page"] . '.md');
	echo $Parsedown->text($file);
}
//echo "DEBUG: " . $path . $_GET["page"] . '.md'; 
// End HTML
echo <<< HTML
	</body>
</html>
HTML;
?>
