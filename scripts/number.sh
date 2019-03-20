#!/bin/bash
read -p 'first number:' firstnu
read -p 'second number:' secnu
total=$(( $firstnu*$secnu ))
echo -e "The result of $firstnu x $secnu is => $total"

