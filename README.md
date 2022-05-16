
# Laravel Word Trainer
![Word trainer](/public/images/logo.png?raw=true "Word trainer")

## Prepare environment
In file ~/.bashrc add strings:
```
alias sail='bash vendor/bin/sail'
export PATH="$HOME/.config/composer/vendor/bin:$PATH"
```

## How to use

- Clone the repository with __git clone__
- Copy __.env.dev__ file to __.env__ and edit database credentials there
- Run `sail up --build -d`
- Run `sail composer install`
- Run `sail artisan key:generate`
- Run `sail artisan migrate --seed` (it has some seeded data for your testing)
- Regenerate documentation with `sail artisan l5-swagger:generate` command
- Regenerate front with `sail npm i && sail npm run watch` command

## Dev Links
- http://localhost [Front]
```properties
login: test@mail.com
password: password
```
- http://localhost:8003 [Adminer]
```properties
server: mysql
user: sail
password: password
```
- http://localhost/api/documentation [Doc]


## AWS Beanstalk ssh
```bash
$ ssh -i ~/.ssh/word-trainer-bean-key.pem ec2-user@3.21.103.65
```

## VS Code extentions
- qvtec3.swagger-php-annotation
- bmewburn.vscode-intelephense-client
- hollowtree.vue-snippets
- mubaidr.vuejs-extension-pack
- xdebug.php-debug
- ms-azuretools.vscode-docker
- ms-vscode-remote.remote-containers

## Debug from VSCode
- in VSCode open debug (Ctrl+Shift+D)
- add configuration json file for PHP
```json
{
    // Use IntelliSense to learn about possible attributes.
    // Hover to view descriptions of existing attributes.
    // For more information, visit: https://go.microsoft.com/fwlink/?linkid=830387
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
- to debug api in Postman add url param
```properties
XDEBUG_SESSION_START=PHPSTORM
```

## AWS
1. install aws cli
```bash
$ curl "https://awscli.amazonaws.com/awscli-exe-linux-x86_64.zip" -o "awscliv2.zip"
$ unzip awscliv2.zip
$ sudo ./aws/install
```

2. aws cli config
```bash
$ aws configure
AWS Access Key ID [None]: env(AWS_ACCESS_KEY_ID)
AWS Secret Access Key [None]: env(AWS_SECRET_ACCESS_KEY)
Default region name [None]: env(AWS_DEFAULT_REGION)
Default output format [None]: json

```







