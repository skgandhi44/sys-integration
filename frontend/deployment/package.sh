#!/bin/bash

#checks for arguments when the script is ran
status="pendingTest"

if [ $# -lt 1 ] ; then
        #if more than 2 arguments script stops
        echo "Please provide version number"
        #echo $heckStatus
        exit
elif [ $# -ge 2 ] ; then
        #if more than 2 arguments script stops
        echo "Too many arguments, only one argument accepted"
        #echo $heckStatus
        exit
fi

#sets the version variable to the current date/time
version=$1;
echo "Version: "$version

#bundles the two directories into a .tar file and appends the version variable to the file name
cd /home/$USER/Documents
tar -cf fe_$version.tar frontend

#directory of bundle created
tardir=/home/git/sys-integration/deployment/bundles/fe_$version.tar
echo "Directory: "$tardir

pwd
ls

#send .tar file to deployment server
sshpass -p "'" rsync -v -e ssh fe_$version.tar db-qa@192.168.1.117:/home/db-qa/git/sys-integration/deployment/bundles
rm -rf fe_$version.tar


ls
