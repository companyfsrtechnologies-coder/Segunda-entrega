#!/bin/bash
clear
verif_Logs="$(ls Logs.txt)"
clear
if [ -z "$verif_Logs" ]; then
> Logs.txt
fi
echo "Menú Gestión de Usuarios y datos de pacientes:"
echo ""
echo "1- Agregar Usuario"
echo "2- Borrar Usuario"
echo "3- Borrar grupo"
echo "4- Modificar Usuario"
echo "5- Lista de Usuarios"
echo "6- ingresar datos de paciente"
echo "7- decifrar datos de paciente"
echo ""
echo "0- Salir"
echo ""
read -p "Seleccione opción: " x
case $x in
1)
bash useradd.sh
;;
2)
bash deluser.sh
;;
3)
bash delgrup.sh
;;
4)
bash moduser.sh
;;
5)
bash lisuser.sh;;
6)
bash ingresodatos.sh;;
7)
bash descifrardatos.sh
;;
0)
clear
echo "Cerrando menu.."
sleep 1
clear
exit
;;
*)
clear
echo "Opción incorrecta"
sleep 2
clear
sh menu.sh
;;
esac