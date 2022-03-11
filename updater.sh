#!/bin/bash

# -------------------------------------------------------------
#  Linux Updater "longman php telegram bot".
# 
#  @zickkeen <zickkeen@gmail.com>
#  @link http://bojez.com/
#  @copyright Copyright (c) 2020 Bojez Creative
#  @license MIT License
# -------------------------------------------------------------
dirPath="$( cd -P "$( dirname "$SOURCE" )" >/dev/null 2>&1 && pwd )"
while [ true ]; do
  sleep 3 #set time period with second unit

  # do what you need to here
  php $dirPath/getUpdatesCLI.php
done
