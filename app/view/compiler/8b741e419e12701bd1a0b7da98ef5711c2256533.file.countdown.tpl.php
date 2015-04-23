<?php /* Smarty version Smarty-3.1.13, created on 2015-04-23 13:34:14
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/test/countdown.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3838945645538f9dd0991c7-25492218%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b741e419e12701bd1a0b7da98ef5711c2256533' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/test/countdown.tpl',
      1 => 1429806852,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3838945645538f9dd0991c7-25492218',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5538f9dd0f7d13_13307244',
  'variables' => 
  array (
    'host' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5538f9dd0f7d13_13307244')) {function content_5538f9dd0f7d13_13307244($_smarty_tpl) {?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>jQuery Countdown</title>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/css/jquery.countdown.css">
<style type="text/css">
#defaultCountdown { width: 240px; height: 45px; }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery.plugin.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery.countdown.min.js"></script>
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
</html><?php }} ?>