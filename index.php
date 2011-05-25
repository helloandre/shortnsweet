<?php
// if you want to include some kind of analytics (google analytics, mixpanel, piwik, etc), set this variable to true:
$analytics = false;
// and then paste your analytics code below starting at line 16

include("config.php");
$redirect = false;
if ($_GET['i']){
    include("view.php");
}
else {
	include("main.php");
}
if ($redirect):?>
<!-- YOUR ANALYTICS CODE BELOW HERE -->




<!-- YOUR ANALYTICS CODE ABOVE HERE -->
window.location = "<?php echo $redirect; ?>";
<?php endif; ?>
</body>
</html>
