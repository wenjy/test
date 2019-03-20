#!/bin/bash
read -p 'Please input date (YYYYMMDD ex>20180512) :' date2
date_d=$(echo $date2 | grep '[0-9]\{8\}')
if [ $date_d == '' ]; then
	echo 'You input the wrong date format...'
	exit 1
fi

declare -i date_dem=`date -j -f %Y%M%d $date2 +%s`
declare -i date_now=`date +%s`
declare -i date_total_s=$(($date_dem-$date_now)) # $与括号，括号与括号不能有空格
declare -i date_d=$(($date_total_s/60/60/24))
if [ "$date_total_s" -lt '0' ]; then
	echo 'before: '$((-1*$date_d))' ago'
else
	declare -i date_h=$(($(($date_total_s-$date_d*60*60*24))/60/60))
	echo "after $date_d days and $date_h hours"
fi
