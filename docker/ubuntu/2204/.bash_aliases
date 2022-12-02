## apt
alias a='apt-get install'
alias ac='apt-cache search'
alias aud='apt-get update'
alias aug='apt-get upgrade'
alias audg='apt-get update && apt-get upgrade -y'

## cmd
alias dp='dpkg -l | grep "^rc"'
alias dus='du -sh * | sort -h'
alias gr='grep -R --exclude-dir=vendor --exclude-dir=storage --exclude-dir=node_modules'
alias l='ls -al'
alias p='ps -ae'
alias nst='netstat -ltup '

## env
export PATH=${PATH}:$(composer global config bin-dir --absolute --quiet)

## php
alias pa='php artisan'
alias pt='php artisan tinker'
alias pu='./vendor/bin/phpunit'

## python
alias pi='pip3'
alias py='python3'