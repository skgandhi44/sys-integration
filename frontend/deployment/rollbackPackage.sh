
#!/bin/bash

#runs php script with 1 argument
sshpass -p "'" ssh db-qa@192.168.1.117 "php /home/db-qa/git/sys-intgration/deployment/deployFunction.php 'rollback' '' '' ''"

#changes to where all the bundles are stored
#cd /home/$USER/bundles

#gets the directory of the latest file and prints it
data=$(sshpass -p "'" ssh db-qa@192.168.1.117 "cat /home/db-qa/bin/latest")
echo $data

#creates temporary folder to store extractions
rm -rf /tmp/data
mkdir /tmp/data

#downloads the .tar file
#cd /home/$USER/bundles
sshpass -p "'" scp db-qa@192.168.117:$data /tmp/data

#extracts latest bundle to temp folder
tar xvf /tmp/data/$(basename $data) -C /tmp/data

#removes old versions
#rm -rf /home/$USER/git
rm -rf /var/www/html/sys-integration/

#moves files from temp folder to correct directories
#mv /tmp/data/git/ /home/$USER/git/
mv /tmp/data/var/www/html/sys-integration/ /var/www/sys-integration/

#deletes temp folder
rm -rf /tmp/data
