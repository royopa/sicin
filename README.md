SICIN - Controle de Investimentos
=================================

Welcome to the Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

This document contains information on how to download, install, and start
using Symfony. For a more detailed explanation, see the [Installation][1]
chapter of the Symfony Documentation.

1) Using the application
----------------------------------

git clone https://github.com/royopa/sicin.git

cd sicin

composer update

bower update

vagrant up

http://192.168.33.100/web/app_dev.php

parameters.yaml
------

```
# This file is auto-generated during the composer install
parameters:
    database_driver: pdo_sqlite
    database_path : %kernel.root_dir%/data/sqlite.db
    database_host: 127.0.0.1
    database_port: null
    database_name: sicin
    database_user: root
    database_password: null
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    locale: pt_BR
    secret: 01dd8653d3790f5193069322c59c202c9f5a08ea
```
