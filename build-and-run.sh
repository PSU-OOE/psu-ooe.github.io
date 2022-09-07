#! /bin/bash

npm run build && php -S localhost:8001 -t public
