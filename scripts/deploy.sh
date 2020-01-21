#!/bin/bash
echo "Starting deployment"

is_deployed=$(wget --server-response https://forge.laravel.com/servers/129626/sites/680296/deploy/http?token=$FORGE_TOKEN -O ip-current 2>&1| grep -c 'HTTP/1.1 200 OK')

if [ $is_deployed == 1 ]; then
    echo "Deployed successfully"
    exit 0
else
    echo "Deploy failure"
    exit 1
fi