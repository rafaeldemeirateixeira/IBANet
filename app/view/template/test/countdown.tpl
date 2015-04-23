
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>jQuery Countdown</title>
<link rel="stylesheet" href="{$host}public/css/jquery.countdown.css">
<style type="text/css">
#defaultCountdown { width: 240px; height: 45px; }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{$host}public/javascript/jquery.plugin.min.js"></script>
<script src="{$host}public/javascript/jquery.countdown.min.js"></script>
<script>
$(function () {
	var data = new Date();
	var count = new Date(data.getFullYear(), data.getMonth(), data.getUTCDate(), data.getHours(), 0, 7200);
	$('#defaultCountdown').countdown({
        until: count,
        format: 'HMS',
        compact: true,
        description: ''
    });
    $('#day').text(data.getUTCDate());
    $('#mouth').text(data.getMonth());
	$('#year').text(data.getFullYear());

});
</script>
</head>
<body>
<h1>jQuery Countdown Basics</h1>
<p>This page demonstrates the very basics of the
	<a href="http://keith-wood.name/countdown.html">jQuery Countdown plugin</a>.
	It contains the minimum requirements for using the plugin and
	can be used as the basis for your own experimentation.</p>
<p>For more detail see the <a href="http://keith-wood.name/countdownRef.html">documentation reference</a> page.</p>
<p>Counting down to <span id="day">0</span> <span id="mouth">0</span> <span id="year">2014</span>.</p>
<div id="defaultCountdown"></div>
</body>
</html>