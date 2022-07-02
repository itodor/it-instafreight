#!/bin/bash

set -xe

eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_rsa

rsync -a --exclude={'/vendor'} ./ travis@ivan-todorovic.com:~/projects/it-instafreight/src
echo "Deploying starts"
