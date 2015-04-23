<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>IBANet - Autenticação</title>
        <script src="{$host}public/javascript/jquery.min.js"></script>
        <script type="text/javascript" src="{$host}public/javascript/login.js"></script>
        <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=pt"></script>
        <link rel="stylesheet" href="{$host}public/css/login.css">
        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <div id="formulario" style="display: block;">
            <form id="form_login" method="post" action="{$host}Login/Authentic/" class="login">
                <table class="table" width="100%" border="0" cellpadding="5">
                    <tr>
                        <td colspan="2">
                            <section class="about">
                                <p class="about-links">
                                    <img src="{$host}public/image/logo.png">
                                </p>
                                <p class="about-author">
                                    &copy; 2012&ndash;2015 Criare Development<br>Todos os Direitos Reservados
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            Email:<br>
                            <input type="text" name="psa_email" id="psa_email" value="">
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            Senha:<br>
                            <input type="password" name="psa_pwd" id="psa_pwd" value="">
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            <div class="g-recaptcha" data-sitekey="6LeruwMTAAAAAGv0tqeK9EpbjSJHWv2J6d9IdyWF"></div>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            <button type="submit" class="login-button"></button>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <section class="td">
                            <p class="forgot-password">
                                <a href="{$host}Login/Forgot">Esqueceu sua senha?</a>
                            </p>
                            </section>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="carregando" class="carregando" style="display: none;">
            <img src="{$host}public/image/ajax-loader.gif">
        </div>
    </body>
</html>