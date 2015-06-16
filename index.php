<html>
<head>
<title>Automatic Slideshow</title>
<style type="text/css">
#anim{
background:url(img/ban-restaurant.jpg) center no-repeat;
height:368px;
}
</style>
<body>
<div id="anim"></div>
<?php include('inc/script.php'); ?>
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/jquery.cross-slide.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){	
$('#anim').crossSlide({
  speed: 40,
  fade: 1
}, [
<?php
ScanDirectory4Anim('restaurant');
?>
]);
});
</script>

</body>
</html>