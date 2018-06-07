#!/bin/bash

if [ "$#" -ne 2 ]; then
 echo "Le nombre d'arguments est invalide"
fi

image_file=$1
password=$2

#echo p | sudo -S
steghide extract -sf $image_file -p $password