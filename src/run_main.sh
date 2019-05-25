#!/bin/sh

# run_main.sh

# Give some time for the other containers to start
sleep 3

# main PHP entry point on container startup
/usr/local/bin/php /app/src/main.php &

# Run cron in the foreground so the container won't exit
crond -f

# Should never reach here except when cron dies or is not run
tail -f /dev/null