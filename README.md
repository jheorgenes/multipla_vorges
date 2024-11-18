# Laravel Nova

Aplicação feita em Laravel, utilizando o Ecossistema Laravel Nova.

### Instalações no composer

Após criar um projeto Laravel completo e rodar as migrações:

```sh
$ composer config repositories.nova '{"type": "composer", "url": "https://nova.laravel.com"}' --file composer.json
```

Depois, abrir o arquivo composer.json e incluir o require do Laravel nova:

```json
 "require": {
        "php": "^8.2",
        "laravel/framework": "^11.9",
        "laravel/tinker": "^2.9",
        "laravel/nova": "^4.0"  
},
```
Após require definido, execute o comando abaixo:

```sh
$ composer update --prefer-dist
```

Será solicitado para inserir o usuário da licença nova e a chave KEY.

OBS: Se preferir, pode ser adicionado ao config essas informações:

### Instalação do Nova (Artisan)

```sh
$ php artisan nova:install

$ php artisan migrate
```

### Configurações adicionais do Laravel Nova

Adicione no .env a variável NOVA_USERNAME com as informações de username <email da conta do laravel nova>
Adicione no .env a variável NOVA_LICENSE_KEY com as informações da chave key <key gerada do laravel nova>

Depois rode o comando abaixo:

```sh
$ composer config http-basic.nova.laravel.com "${NOVA_USERNAME}" "${NOVA_LICENSE_KEY}"
```




### Comandos adicionados em algum momento do projeto

Traduções do Laravel Nova
```sh
$ php artisan vendor:publish --provider="Laravel\Nova\NovaServiceProvider"
```

Adicionando migrations de alteração
```sh
$ php artisan make:migration add_foreign_keys_to_service_orders_table --table=service_orders
```
