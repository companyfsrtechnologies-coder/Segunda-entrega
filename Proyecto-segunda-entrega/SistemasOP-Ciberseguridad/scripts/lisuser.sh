#!/bin/bash
clear
echo "Usuarios:"
echo ""
less /etc/passwd | cut -d":" -f1
echo ""
read -p "Presione Enter para volver atrás " b
if [ -z $b ]; then
clear
sleep 3
else
clear
sleep 3
fi
echo "Volviendo al menú principal.."
sh menu.sh
echo "Volviendo al menú principal.."
sh menu.sh