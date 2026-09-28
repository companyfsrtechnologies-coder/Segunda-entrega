#!/bin/bash
clear
while [ -z "$user" ]
do
read -p "Ingrese Nuevo Usuario: " user
sleep 2
clear
if [ -z "$user" ]; then
echo -n "El campo no puede estar vacío."
sleep 2
clear
fi
done
verif_user=$(cat /etc/passwd | cut -d":" -f1 | grep -w "$user")
if ! [ -z "$verif_user" ]; then
echo -n "El usuario $user ya existe"
sleep 2
clear
echo -n "Volviendo al Menu Principal.."
sleep 2
clear
sh menu.sh
else
echo "Seleccione una opcion: "
echo "1- Crear un nuevo grupo para el usuario"
echo "2- Usar un grupo existente para el usuario"
read opc
case $opc in
1)
clear
while [[ -z "$grupoID" ]] || [[ "$grupoID" == "$verif_grupoID" ]]
do
echo -n "Ingrese ID de Grupo: "
read grupoID
verif_grupoID=$(cat /etc/group | cut -d":" -f3 | grep -w $grupoID)
if [ -z "$grupoID" ]; then
clear
echo -n "El campo no puede estar vacío."
sleep 2
clear
fi
if [[ "$grupoID" -eq "$verif_grupoID" ]]; then
echo -n "El ID de Grupo ingresado ya existe."
sleep 2
clear
fi
done
while [ -z "$grupoNombre" ]
do
echo -n "Ingrese Nombre de Grupo: "
read grupoNombre
if [ -z "$grupoNombre" ]; then
echo -n "El campo no puede estar vacío."
sleep 2
clear
fi
done
sudo groupadd -g "$grupoID" "$grupoNombre"
;;
2)
clear
echo -n "Ingrese Nombre de Grupo existente: "
read grupoNombre
verif_grupo=$(cat /etc/group | cut -d":" -f1 | grep -w $grupoNombre)
clear
if [ -z "$verif_grupo" ]; then
clear
echo -n "El grupo $grupoNombre no existe"
sleep 2
clear
echo -n "Volviendo al Menu Principal.."
sleep 2
clear
sh menu.sh
fi
esac
echo "Creando usuario $user.."
sleep 3
clear
sudo useradd -d /home/$user -g $grupoNombre -p $user -m -s /bin/bash $user
fecha_actual=$(date)
echo "(CREAR:USUARIO) (USUARIO) $user (FECHA) $fecha_actual" >> Logs.txt
echo "Volviendo al Menu Principal.."
sleep 3
clear
sh menu.sh
fi