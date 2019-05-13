#!/bin/bash

php artisan --env=production --timeout=240 queue:listen

#php artisan schedule:run 1>> NUL 2>&1

#service redis start