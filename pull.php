<?php shell_exec( 'git pull origin master && php artisan cache:clear && php artisan view:clear && php artisan route:clear && php artisan config:cache' ); ?>
<h2>pulled</h2>
