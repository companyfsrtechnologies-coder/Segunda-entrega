#!/bin/bash
clear
read -p "ingrese nombre del paciente:" nom
read -p "ingrese apellido del paciente:" ape
read -p "ingrese la cedula:" ci
read -p "ingrese el tefono del paciente:" tel
echo "el paciente ¿posee problemas de salud (1-si/2-no)?"
read -p "seleccione una opción:" op
case $op in
1)
read -p "ingrese la enfermedad del paciente:" enf
read -s -p "ingrese una contraceña de acceso para los datos" clave
archivo="${ci}.txt"
echo "nombre: $nom" > "$archivo"
echo "apellido: $ape" >> "$archivo"
echo "cedula: $ci" >> "$archivo"
echo "telefono: $tel" >> "$archivo"
echo "enfermedad $enf" >> "$archivo"
openssl enc -aes-256-cbc -a -salt -pbkdf2 \
-pass pass:"$clave" \
-in "$archivo" \
-out "${ci}.enc"
rm "$archivo"
echo "se estan cifrando los dato...."
sleep 5
echo "los datos se han cifrado correctamente."
sleep 5
bash menu.sh
;;
2)
read -s -p "ingrese una contraceña de acceso para los datos" clave
archivo="${ci}.txt"
echo "nombre: $nom" > "$archivo"
echo "apellido: $ape" >> "$archivo"
echo "cedula: $ci" >> "$archivo"
echo "telefono: $tel" >> "$archivo"
echo "enfermedad: no tiene" >> "$archivo"
openssl enc -aes-256-cbc -a -salt -pbkdf2 \
-pass pass:"$clave" \
-in "$archivo" \
-out "${ci}.enc"
rm "$archivo"
echo "se estan cifrando los dato...."
sleep 5
echo "los datos se han cifrado correctamente."
sleep 5
bash menu.sh
;;
*)echo "error: bebe escribir 1 o 2"
;;
esac
sh menu.sh