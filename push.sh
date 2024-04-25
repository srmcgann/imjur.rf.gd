#!/bin/bash
git pull
cd ~/imjur.rf.gd
cp ~/imjur.rf.gd/dist/. ~/imjur.rf.gd/dist_public/. -r
php ~/imjur.rf.gd/push_dir.php
git add .
git commit -m 'sync'
git push
