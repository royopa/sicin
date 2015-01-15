SICIN - Controle de Investimentos
=================================

http://sicin.esy.es/

1) Using the application
------------------------

    $ git clone https://github.com/royopa/sicin.git
    $ cd sicin
    $ composer update
    $ bower update
    $ composer run

To see a real-live page in action, start the PHP built-in web server with
command:

    $ composer run

Then, browse to http://localhost:8888/.

parameters.yaml sample
----------------------

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
