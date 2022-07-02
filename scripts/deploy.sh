#!/bin/bash

set -xe

if [ $TRAVIS_BRANCH == 'master' ] ; then
#  eval "$(ssh-agent -s)"
#  ssh-add ~/.ssh/id_rsa
#
#  rsync -a --exclude={'/node_modules','/src','/public'} client/ travis@<droplet ipaddress>:/home/<sudo user>/demo/client
  echo "Deploying starts"
else
  echo "Not deploying, since the branch isn't master."
fi
