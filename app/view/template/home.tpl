<!DOCTYPE HTML>
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
        <script src="{$host}public/javascript/jquery-1.10.2.js"></script>
        <script src="{$host}public/javascript/jquery.dropotron.min.js"></script>
        <script src="{$host}public/javascript/jquery-ui-1.10.4.custom.js"></script>
        <script src="{$host}public/javascript/skel.min.js"></script>
        <script src="{$host}public/javascript/skel-layers.min.js"></script>
        <script src="{$host}public/javascript/init.js"></script>
        <script src="{$host}public/javascript/jquery.colorbox.js"></script>
        <script src="{$host}public/javascript/time-session.js"></script>
        <script>
            $(document).ready(function() {
                $(".iframe").colorbox({
                    iframe: true, width: "80%", height: "80%"
                });
            }
        </script>
        <link rel="stylesheet" href="{$host}public/css/jquery-ui-1.10.4.custom.css" />
        <noscript>
        <link rel="stylesheet" href="{$host}public/css/skel.css" />
        <link rel="stylesheet" href="{$host}public/css/style.css" />
        <link rel="stylesheet" href="{$host}public/css/style-desktop.css" />
        </noscript>
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
    </head>
    <body>
        <!-- Nav -->
        <nav id="nav" class="skel-layers-fixed">
            {$menu}
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
                                    <p>{$caption}</p>
                                    <ul class="meta">
                                        <li>{$subcaption}</li>
                                    </ul>
                                    <ul class="meta">
                                        {if $action.add.enable eq true}
                                            <li>
                                                <a href="{$action.add.href}">
                                                    <img src="{$hostImage}add.png" title="Adiciona novo registro"/>
                                                </a>
                                            </li>
                                        {/if}
                                        {if $action.list.enable eq true}
                                            <li>
                                                <a href="{$action.list.href}">
                                                    <img src="{$hostImage}lista.png" title="Lista registros salvos"/>
                                                </a>
                                            </li>
                                        {/if}
                                    </ul>
                                </header>
                                <section>
                                    {$content}
                                </section>
                            </article>
                        </div>
                    </div>
                    <div class="3u">
                        <div class="sidebar">
                            <!-- Sidebar -->
                            <!-- Recent Posts -->
                            <section>
                                <h2 class="major"><span>IBANet</span></h2>
                                <ul class="divided">
                                    <li>
                                        <article class="box post-summary">
                                            <ul class="meta">
                                                <li><a href="{$host}Log">Meus acessos</a></li>
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
                                                <li>
                                                    <b># Versao Alpha 1.4</b><br><br>
                                                    - Cria permissões de acesso e envia Email para o usuário criar senha;<br>
                                                    - Permite atualizar a senha no link "Esqueceu sua senha?";<br>
                                                    - Alteração da tela de Autenticação;<br>
                                                    - Adicionado campo obrigatório Latitude e Longitude no cadastro de eventos de célula;
                                                </li>
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
</html>