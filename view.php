<?php
$query = "SELECT * FROM `shorten` WHERE `short` = '".mysql_escape_string($_GET['i'])."' LIMIT 1";
$result = mysql_query($query);
if ($row = mysql_fetch_assoc($result)):
    if ($row['site']):
        if (!$analytics) header("Location: $row[long]");
        else $redirect = $row['long'];
    else:
    	// not-very-sophisticated browser detection
		$mobile = (stripos($_SERVER['HTTP_USER_AGENT'], 'iphone') || stripos($_SERVER['HTTP_USER_AGENT'], 'blackberry') || stripos($_SERVER['HTTP_USER_AGENT'], 'android')); ?>
		<!DOCTYPE html>
		<html>
		<head>
   		<?php
        // for mobile browsers
        if ($mobile): ?>
            <meta name='viewport' content="width=320">
            <style>
                img{width:310px}
				body{width:320px;text-align:center;color:#40404;padding:5px 0px 0px 0px;margin: 0;}
				a{text-decoration:none;color:#a8a8a8;}
            </style>
        <?php else: ?>
			<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
			<script>
				function adjust(){
					var height = $(window).height();
					var width = $(window).width();
					var img_height = $("#image").height();
					var img_width = $("#image").width();

					// adjust size
					if ((img_width >= width || img_height >= (height - 100)) && $("#image").attr("rel") != 'mkm'){
						var ratio = img_width / img_height;

						// adjust by width
						if (img_width > img_height){
							//console.log("by width");
							var desired_width = (width - 50);
							var desired_height = desired_width / ratio;
						}
						else {
							//console.log("by height");
							var desired_height = (height - 100);
							var desired_width = ratio * desired_height;
						}
						//console.log("dh "+desired_height+" dw "+desired_width+" ih "+img_height+" iw "+img_width);
						$("#image").attr('width', desired_width);
						$("#image").attr('height', desired_height);
					}
				}
			</script>
			<style>
				body{background:white url(name_side.png) no-repeat;text-align:center;color:#40404;}
				a{text-decoration: none;color: #a8a8a8;}
			</style>
		<?php endif; // end else statement for non-mobile browser ?>
		    <title><?php echo $row['long'] ?></title>
		</head>
		<body>
		<?php if (!$mobile):?>
            <a href='index.php'>Home</a><br>
            <?php echo $row['long']." - hotlink: http://$_SERVER[SERVER_NAME]/files/".$row['short']."-".htmlspecialchars($row['long']); ?>
            <br><br>
	    <?php endif; ?>
	        <img id='image' rel='<?php echo $_GET['i']?>' src='<?php echo "files/".$row['short']."-".$row['long'] ?>' onload='adjust()'/>
	        <?php
				if ($row['tweet']):
	                // replace all @ mentions
	                $tweet = preg_replace('/\@([a-z0-9]+)/i', '@<a href="http://twitter.com/$1">$1</a>', $row['tweet']);
					echo '<br><br>'.$tweet;
				endif;
	    endif; // else non-site
// error?
else: ?>
<title>File Not Found</title>
</head>
<body>
	<a href='index.php'>Home</a>
	<p>file not found</p>
<?php endif; ?>