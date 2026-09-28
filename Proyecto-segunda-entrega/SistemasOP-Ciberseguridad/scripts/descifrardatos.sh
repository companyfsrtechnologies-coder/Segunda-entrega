#!/bin/bash
clear
read -p "ingrese la cedula del paciente: " ci
cat "${ci}.enc" | openssl enc -aes-256-cbc -d -a -pbkdf2
sleep 5
bash menu.sh