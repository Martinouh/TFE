#!/bin/bash

# myvar = nombre de vps dans la db
# myvar=$(sqlite3 tfe.db "select max(id) from VPS")
# echo $myvar

# for((i=0; i<$myvar; i++))
# do
#
# 	pass=$(sqlite3 tfe.db "select password from VPS where id = ($i+1)")
#
# 	echo $pass
#
# done


for((i=1; i<3; i++))
do
   ip=$(sqlite3 tfe.db "select ip from VPS where id = $i")
    echo $ip

   pass=$(sqlite3 tfe.db "select password from VPS where id = $i")
    echo $pass

   SCRIPT="useradd vvandens --home /home/vvandens --create-home; echo vvandens:$pass | chpasswd; usermod -s /bin/bash vvandens; usermod -aG sudo vvandens; usermod -aG docker vvandens;"

   sshpass -p $pass ssh -o StrictHostKeyChecking=no root@$ip	"${SCRIPT}"

   sshpass -p $pass ssh-copy-id -i /var/www/html/OVH/id_rsa.pub vvandens@$ip
done
