#!/bin/sh

# run_main.sh

# Give some time for the other containers to start
# sleep 5

/usr/local/bin/php /app/src/main.php &

# Run cron in the foreground so the container won't exit
crond -f

# tail -f /dev/null