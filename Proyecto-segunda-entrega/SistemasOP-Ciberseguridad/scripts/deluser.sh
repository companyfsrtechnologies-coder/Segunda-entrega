#!/bin/bash
clear
read -p 'Ingrese usuario a borrar: ' user
if [ $(cat /etc/passwd | cut -d":" -f1 | grep -w $user) = $user ]; then
sudo userdel -f $user
fecha_actual=$(date)
echo "(BORRAR:USUARIO) (USUARIO) $user (FECHA) $fecha_actual"
>> Logs.txt
clear
echo "El usuario $user ha sido borrado"
sleep 2
clear
echo -n "Volviendo al Menu Principal.."
sleep 2
clear
sh menu.sh
else
clear
echo "El usuario no existe"
sleep 2
echo -n "Volviendo al Menu Principal.."
sleep 2
clear
sh menu.sh
fi