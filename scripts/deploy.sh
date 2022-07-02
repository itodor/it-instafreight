#!/bin/bash

set -xe

eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_rsa

rsync -a --exclude={'/vendor'} ./ travis@68.183.65.79:~/projects/it-instafreight/src
echo "Deploying starts"
