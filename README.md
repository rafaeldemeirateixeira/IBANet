IBAlianca
=========

Repositório principal da aplicação, este é um documento para desenvolvedores logo
se você achar que alguma coisa deveria estar aqui e não esta, sinta-se obrigado
a acrecentá-la! :)

A documentação leva em consideração principalmente ambientes [*nix](https://pt.wikipedia.org/wiki/Sistema_operacional_tipo_Unix).
Algumas coisas em outros ambientes pode não funcionar.

Caso hajam problemas de permissão, execute:

````shell
make permissions
````

Para limpar o cache do Smarty, execute:

````shell
make clean-smarty-cache
````

# Composer

O [composer](http://getcomposer.org) é responsável por administrar dependências externas da aplicação, as dependências
atuais são:

- [Monolog](https://github.com/Seldaek/monolog): Componente de log
- [PHPUnit](http://www.phpunit.de/manual/current/en/index.html): Ferramenta de testes

Para instalar as dependências, você pode usar o [Make](https://pt.wikipedia.org/wiki/Make) executando:

```shell
make dev
```

Arquivos com configuraço de banco de dados
------------------------------------------

* app/config/database.php

Arquivos responsáveis por autenticação
--------------------------------------

* deia/DeiaAuthenticate.php
* app/controller/LoginController.php
* app/model/LoginModel.php


# Versao Alpha 1.4 22/04/2015

- Cria permissões de acesso e envia Email para o usuário criar senha;
- Permite atualizar a senha no link "Esqueceu sua senha?";
- Alteração da tela de Autenticação;
- Adicionado campo obrigatório Latitude e Longitude no cadastro de eventos de célula;
- Correção do redimencionamento do mapa na visualização dos eventos de célula;
- Correção do redimencionamento dos formularios;