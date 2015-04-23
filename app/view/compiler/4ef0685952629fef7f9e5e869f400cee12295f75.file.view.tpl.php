<?php /* Smarty version Smarty-3.1.13, created on 2015-04-22 20:16:41
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:434619853552c1e6b726a12-81279038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ef0685952629fef7f9e5e869f400cee12295f75' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/view.tpl',
      1 => 1429744599,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '434619853552c1e6b726a12-81279038',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_552c1e6b7a8428_38305379',
  'variables' => 
  array (
    'title' => 0,
    'subTitle' => 0,
    'dateTime' => 0,
    'section' => 0,
    'line' => 0,
    'text' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_552c1e6b7a8428_38305379')) {function content_552c1e6b7a8428_38305379($_smarty_tpl) {?><article class="box page-content view_back">
    <header>
        <h2><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
        <p><?php echo $_smarty_tpl->tpl_vars['subTitle']->value;?>
</p>
        <ul class="meta">
            <li class="icon fa-clock-o"><?php echo $_smarty_tpl->tpl_vars['dateTime']->value;?>
</li>
        </ul>
    </header>
    <?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['line']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['section']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value){
$_smarty_tpl->tpl_vars['line']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['line']->key;
?>
        <h3 class="icon fa-asterisk"> <?php echo $_smarty_tpl->tpl_vars['line']->value['title'];?>
</h3>
        <table>
            <?php  $_smarty_tpl->tpl_vars['text'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['text']->_loop = false;
 $_smarty_tpl->tpl_vars['idL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['line']->value['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['text']->key => $_smarty_tpl->tpl_vars['text']->value){
$_smarty_tpl->tpl_vars['text']->_loop = true;
 $_smarty_tpl->tpl_vars['idL']->value = $_smarty_tpl->tpl_vars['text']->key;
?>

                <?php if ($_smarty_tpl->tpl_vars['text']->value['mapa']==true){?>
                    <tr>
                        <td colspan="2">
                            <div id="map-canvas" style="height: 300px;" class="box page-content view_back"></div>
                            <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
                            <script>
                                function initialize() {
                                    var mapOptions = {
                                        scaleControl: true,
                                        center: new google.maps.LatLng(<?php echo $_smarty_tpl->tpl_vars['text']->value['latlon'];?>
),
                                        zoom: 16
                                    };

                                    var map = new google.maps.Map(document.getElementById('map-canvas'),
                                            mapOptions);

                                    var marker = new google.maps.Marker({
                                        map: map,
                                        position: map.getCenter()
                                    });
                                    var infowindow = new google.maps.InfoWindow();
                                    google.maps.event.addListener(marker, 'click', function() {
                                        infowindow.open(map, marker);
                                    });
                                }
                                google.maps.event.addDomListener(window, 'load', initialize);
                            </script>
                        </td>
                    </tr>
                <?php }else{ ?>
                    <tr>
                        <td width="10%" align="left"><h5><?php echo $_smarty_tpl->tpl_vars['text']->value['label'];?>
: </h5></td>
                        <td width="90%" align="left"><i><?php echo $_smarty_tpl->tpl_vars['text']->value['value'];?>
</i></td>
                    </tr>
                <?php }?>
            <?php } ?>
        </table>
    <?php } ?>
</article><?php }} ?>