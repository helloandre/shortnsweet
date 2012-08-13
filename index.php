<?php
// and then paste your analytics code below starting at line 16

include("lib.php");

Db::init();

$redirect = false;
if (array_key_exists('i', $_GET)){
    $view = new View($_GET['i']);
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
