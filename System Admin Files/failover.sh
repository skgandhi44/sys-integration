#!/bin/sh

while true;
do
  ping -c1 "192.168.1.125" > /dev/null
  if [ $? -eq 0 ]
  then 
	echo "Ping Successful"
	sudo systemctl stop dmz

else 
	echo "Ping failed: Starting dmz"
	sudo systemctl start dmz
	sleep 1

fi
done
