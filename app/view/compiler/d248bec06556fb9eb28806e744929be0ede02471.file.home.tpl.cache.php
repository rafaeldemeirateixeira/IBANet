<?php /* Smarty version Smarty-3.1.13, created on 2015-04-17 14:09:20
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37223569553114106b6f99-11072481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd248bec06556fb9eb28806e744929be0ede02471' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/home.tpl',
      1 => 1429250100,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37223569553114106b6f99-11072481',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'host' => 0,
    'menu' => 0,
    'caption' => 0,
    'subcaption' => 0,
    'action' => 0,
    'hostImage' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_55311410846346_89232373',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55311410846346_89232373')) {function content_55311410846346_89232373($_smarty_tpl) {?><!DOCTYPE HTML>
<!--
	TXT by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>IBANet</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery-1.10.2.js"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery.dropotron.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery-ui-1.10.4.custom.js"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/skel.min.js"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/skel-layers.min.js"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/init.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery.colorbox.js"></script>
        <script>
            $(document).ready(function(){
                $(".iframe").colorbox({
                    iframe:true, width:"80%", height:"80%"
                });
            }
        </script>
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/css/jquery-ui-1.10.4.custom.css" />
		<noscript>

			<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/css/skel.css" />
			<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/css/style.css" />
			<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body>
		<!-- Nav -->
			<nav id="nav" class="skel-layers-fixed">
				<?php echo $_smarty_tpl->tpl_vars['menu']->value;?>

			</nav>
		<!-- Main -->
			<div id="main-wrapper">
				<div id="main" class="container">

					<div class="row">
						<div class="9u important(collapse)">
							<div class="content content-left">

								<!-- Content -->

									<article class="box page-content">

										<header>
											<p><?php echo $_smarty_tpl->tpl_vars['caption']->value;?>
</p>
											<ul class="meta">
												<li><?php echo $_smarty_tpl->tpl_vars['subcaption']->value;?>
</li>
											</ul>
                                            <ul class="meta">
                                                <?php if ($_smarty_tpl->tpl_vars['action']->value['add']['enable']==true){?>
                                                    <li>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['action']->value['add']['href'];?>
">
                                                            <img src="<?php echo $_smarty_tpl->tpl_vars['hostImage']->value;?>
add.png" title="Adiciona novo registro"/>
                                                        </a>
                                                    </li>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['action']->value['list']['enable']==true){?>
                                                    <li>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['action']->value['list']['href'];?>
">
                                                            <img src="<?php echo $_smarty_tpl->tpl_vars['hostImage']->value;?>
lista.png" title="Lista registros salvos"/>
                                                        </a>
                                                    </li>
                                                <?php }?>
											</ul>
										</header>

										<section>
                                            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

										</section>
                                    </article>
                            </div>
                        </div>

                        	<div class="3u">
							<div class="sidebar">

								<!-- Sidebar -->

									<!-- Recent Posts -->
										<section>
											<h2 class="major"><span>Menu Rápido</span></h2>
											<ul class="divided">
												<li>
													<article class="box post-summary">
														<ul class="meta">
                                                            <li><a href="#">Célula</a></li>
                                                            <li><a href="#">Célula Semanal</a></li>
														</ul>
													</article>
												</li>
												<li>
													<article class="box post-summary">
														<h3><a href="#">Últimos Acessos</a></h3>
														<ul class="meta">
															<li>04/04/2015 17:00:00</li>
															<li>204.34.156.76</li>
														</ul>
													</article>
												</li>
												<li>
													<article class="box post-summary">
														<h3><a href="#">Avisos</a></h3>
														<ul class="meta">
															<li>Nenhum aviso</li>
														</ul>
													</article>
												</li>
											</ul>
										</section>
							</div>
						</div>

                    </div>
				</div>
			</div>

		<!-- Footer -->
			<footer id="footer" class="container">


				<!-- Copyright -->
					<div id="copyright">
						<ul class="menu">
							<li>&copy; Criare Development. Todos os direitos reservados</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</div>

			</footer>

	</body>
</html><?php }} ?>