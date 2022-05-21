![Word trainer](/public/images/logo.png)

## Laravel sail

-   Prepare environment
    In file ~/.bashrc add strings:

```
alias sail='bash vendor/bin/sail'
export PATH="$HOME/.config/composer/vendor/bin:$PATH"
```

-   Clone the repository with **git clone**
-   Copy **.env.dev** file to **.env**
-   Copy **./docker/docker-compose-sail.yml** file to **docker-compose.yml**
-   Run `sail up --build -d`
-   Run `sail composer install`
-   Run `sail artisan key:generate`
-   Run `sail artisan migrate --seed`
-   Run `sail artisan l5-swagger:generate` (Regenerate documentation)
-   Run `sail npm i && sail npm run watch` (Regenerate front)

## Laravel docker

-   Clone the repository with **git clone**
-   Copy **.env.dev** file to **.env**
-   Copy **./docker/docker-compose-docker.yml** file to **docker-compose.yml**
-   Run `docker-compose up --build -d`
-   Run `docker-compose exec --user $(id -u):$(id -g) app composer install`
-   Run `docker-compose exec --user $(id -u):$(id -g) app php artisan key:generate`
-   Run `docker-compose exec --user $(id -u):$(id -g) app php artisan migrate --seed`
-   Run `docker-compose exec --user $(id -u):$(id -g) app php artisan l5-swagger:generate` (Regenerate documentation)
-   Run `docker-compose run --rm npm i`
-   Run `docker-compose run --rm npm run watch` (Regenerate front)

## Links

```properties
login: test@mail.com
password: password
```

-   http://localhost [Front]
-   http://localhost:8003 [DbAdminer]
-   http://localhost/api/documentation [Doc]
-   http://localhost/nova [AdminPanel]

## VS Code extentions

-   qvtec3.swagger-php-annotation
-   bmewburn.vscode-intelephense-client
-   hollowtree.vue-snippets
-   mubaidr.vuejs-extension-pack
-   xdebug.php-debug
-   ms-azuretools.vscode-docker
-   ms-vscode-remote.remote-containers

## Debug from VSCode

-   in VSCode open debug (Ctrl+Shift+D)
-   add configuration json file for PHP

```json
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9003,
            "pathMappings": {
                "/var/www/html": "${workspaceFolder}"
            }
        }
    ]
}
```

-   to debug api in Postman add url param

```properties
XDEBUG_SESSION_START=PHPSTORM
```
