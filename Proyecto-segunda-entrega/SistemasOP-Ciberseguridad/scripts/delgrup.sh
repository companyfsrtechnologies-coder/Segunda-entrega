#!/bin/bash
echo "ingrese nombre de grupo a eliminar"
read gr
gr=$(echo "$gr" | xargs)
sudo groupdel "$gr"

if [ $? -eq 0 ]; then
sed -i "/^$gr$/d" grupos_creados.txt
echo "grupo eliminado correctamente"
else
echo "el grupo no existe"
fi
sleep 4
sh menú.sh