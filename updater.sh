#!/bin/bash
dirPath="$( cd -P "$( dirname "$SOURCE" )" >/dev/null 2>&1 && pwd )"
while [ true ]; do
  sleep 3 #set time period with second unit

  # do what you need to here
  php $dirPath/getUpdatesCLI.php
done
