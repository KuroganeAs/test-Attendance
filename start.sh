#!/bin/sh
cd php-login-register
exec php -S 0.0.0.0:${PORT} -t .

