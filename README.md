
# Laravel Word Trainer


## Prepare environment
In file ~/.bashrc add strings:
```
alias sail='bash vendor/bin/sail'
export PATH="$HOME/.config/composer/vendor/bin:$PATH"
```

## Setup
```
sail up -d
sail artisan l5-swagger:generate
npm run watch
```

## AWS Beanstalk ssh
```
ssh -i ./deploy/word-trainer-bean-key.pem ec2-user@3.21.103.65
```


## VS Code
install VS Code extention "Swagger-PHP Annotation"