<?php
if ($view->found):
    if ($view->is_site):
        if (!$analytics) {
            header("Location: {$view->long}");
        } else {
            Config::set_redirect($view->long);
        }
    else:
    ?>
		<!DOCTYPE html>
		<html>
		<head>
   		<?php if ($view->is_mobile): ?>
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
		    <title><?php echo $view->long ?></title>
		</head>
		<body>
		<?php if (!$view->is_mobile):?>
            <a href='index.php'>Home</a>
            <p>
                <?php echo $view->name ?> - hotlink: http://<?php echo Config::$site_url ?>/files/<?php echo $view->name ?>
            </p>
            <p>
	    <?php endif; ?>
        <?php if ($view->name === 'image_data'): ?>
            <img id='image' src='<?php echo file_get_contents("files/".$view->name); ?>' onload='adjust()'/>
        <?php else: ?>
            <img id='image' src='<?php echo "files/".$view->name?>' onload='adjust()'/>
        <?php endif; ?>
        <?php if ($view->message):?>
            <p>
                <?php echo $this->message ?>
            </p>
        <?php endif;
    endif; // $view->is_site
else: ?>
<title>File Not Found</title>
</head>
<body>
	<a href='index.php'>Home</a>
	<p>file not found</p>
<?php endif; ?>