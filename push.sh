#!/bin/bash
git pull
cd /home/scottmcgann4/imjur.rf.gd
cp /home/scottmcgann4/imjur.rf.gd/dist/. /home/scottmcgann4/imjur.rf.gd/dist_public/. -r
php /home/scottmcgann4/imjur.rf.gd/push_dir.php
git add .
git commit -m 'sync'
git push
