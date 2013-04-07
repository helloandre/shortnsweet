<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo View::$name ?></title>
    <meta name="description" content="andre bluehs file upload hosting">
    <meta name="author" content="Andre Bluehs">

    <link rel="shortcut icon" href="http://abcdn.us/img/andrebluehs/favicon.png" />
    <link rel="stylesheet" href="http://abcdn.us/css/andrebluehs/style.css">
    <style>
        #image-container {
            padding-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id='header'>
        <div id='header-left'>
            <h2>Short 'n Sweet</h2>
        </div>
        <div id='header-right'>
            <ul class='horizontal'>
                <li><a href='http://github.com/helloandre/shortnsweet/' target='_blank'>view source on github</a></li>
            </ul>
        </div>
    </div>
    <?php if (!View::found()): ?>
        <div id='sub-header'>
            <h1>Oops</h1>
        </div>
        <div id='center' class='post'>
            <h3>Hrm, couldn't find that.</h3>
        </div>
    <?php else: ?>
		<script src="http://abcdn.us/js/jquery.js"></script>
		<script>
            /**
             *
             * PUT YOUR ANALYTICS HERE
             *
             */
             
             
             
             
            /**
             * 
             * DON'T TOUCH BELOW HERE
             *
             */
            var orig_height = 999999;
            var orig_width = 999999;
			var adjust = function(img) {
				var max_height = $(window).height() - $('#header').height() - $('#sub-header').height() - 10,
                    max_width = $(window).width() - 20,
                    img_height = $(img).height(),
                    img_width = $(img).width(),
                    new_height = img_height,
                    new_width = img_width,
                    ratio = img_width / img_height;
                
                if (img_height > max_height) {
                    new_height = max_height;
                    new_width = ratio * new_height;
                } else if (img_width > max_width){
                    new_width = max_width;
                    new_height = new_width / ratio;
                }
                
				$("#image").attr('width', new_width);
				$("#image").attr('height', new_height);
			}
            
            $(function(){
                orig_height = $('#image').height();
                orig_width = $('#image').width();
            });
		</script>
        <div id='sub-header'>
            <h1><?php echo View::$name ?> - <small><?php echo View::$date ?></small></h1>
        </div>
        <div id='image-container'>
            <img id="image" src="<?php echo View::$url ?>" onload="adjust(this);" />
        </div>
    <?php endif; ?>
</body>