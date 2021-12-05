#!/bin/bash

#Purpose: To  carve the DHCP address and apply it to the Cockpit.conf file
# Author: Michael Verdi
IP_ADD=$(hostname -I | cut -f1 -d' ')

sed -i "s/ServerAlias/ServerAlias $IP_ADD/" /etc/apache2/sites-available/cockpit.conf

unset IP_ADD
