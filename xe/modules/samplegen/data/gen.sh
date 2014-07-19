#!/bin/bash

if [ "$#" -ne "3" ]
then
    echo "$0 <modulename> <Modulename> <rootpath>"
    exit
fi

modulename="$1"
Modulename="$2"
rootpath="$3"

cd $rootpath

find ./ -type f \( -name "*.php" -o -name "*.html" -o -name "*.js" -o -name "*.css" -o -name "*.xml" \) -exec sed -i -e "s/{\$modulename}/$modulename/g" {} \;
find ./ -type f \( -name "*.php" -o -name "*.html" -o -name "*.js" -o -name "*.css" -o -name "*.xml" \) -exec sed -i -e "s/{\$Modulename}/$Modulename/g" {} \;
find ./ -type f \( -name "*.php" -o -name "*.html" -o -name "*.js" -o -name "*.css" -o -name "*.xml" \) -exec sed -i -e "s/{\$moduletitle}/$modulename/g" {} \;

tar -zcf $modulename.tar.gz ./$modulename