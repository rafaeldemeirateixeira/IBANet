<?php /* Smarty version Smarty-3.1.13, created on 2015-04-21 13:58:54
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18346949375530a5f8eb78c0-18931310%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61676bb48f4b46bfa8b40ba87503a88a1ba88917' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/menu.tpl',
      1 => 1429635531,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18346949375530a5f8eb78c0-18931310',
  'function' => 
  array (
  ),
  'cache_lifetime' => 7200,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5530a5f906a714_07144074',
  'variables' => 
  array (
    'hostImage' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5530a5f906a714_07144074')) {function content_5530a5f906a714_07144074($_smarty_tpl) {?><div>
    <img src="<?php echo $_smarty_tpl->tpl_vars['hostImage']->value;?>
logo.png" style="padding-left: 35px; margin-top: 3px; position: absolute;">
</div>
<ul style="padding-left: 150px;">
    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

    <li>
        <div  id="horas" style="color: #090; position: relative; top: 0;">
            Sessão: <img src="<?php echo $_smarty_tpl->tpl_vars['hostImage']->value;?>
ajax-loader-circle.gif">
        </div>
    </li>
</ul><?php }} ?>