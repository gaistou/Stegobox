#!/bin/bash

if [ "$#" -ne 3 ]; then
 echo "Le nombre d'arguments est invalide"
fi

image_file=$1
text_file=$2
password=$3


#echo p | sudo -S
steghide embed -cf $image_file -ef $text_file -p $password