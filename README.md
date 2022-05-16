
# Laravel Word Trainer


## Prepare environment
In file ~/.bashrc add strings:
```
alias sail='bash vendor/bin/sail'
export PATH="$HOME/.config/composer/vendor/bin:$PATH"
```

## How to use

- Clone the repository with __git clone__
- Copy __.env.dev__ file to __.env__ and edit database credentials there
- Run `sail up -d`
- Run `sail composer install`
- Run `sail artisan key:generate`
- Run `sail artisan migrate --seed` (it has some seeded data for your testing)
- Regenerate documentation with `sail artisan l5-swagger:generate` command
- Regenerate front with `sail npm i && sail npm run watch` command

## Dev Links
- http://localhost
- http://localhost/api/documentation

## AWS Beanstalk ssh
```bash
$ ssh -i ~/.ssh/word-trainer-bean-key.pem ec2-user@3.21.103.65
```

## VS Code extentions
- qvtec3.swagger-php-annotation
- bmewburn.vscode-intelephense-client
- hollowtree.vue-snippets
- mubaidr.vuejs-extension-pack


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







