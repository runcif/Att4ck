# Att4ck

grep mac 
ifconfig eth0 | grep -Eo '([[:xdigit:]]{1,2}[:-]){5}[[:xdigit:]]{1,2}' | head -n1

sudo apt-get install apache2
sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql


sudo pico /etc/sudoers
www-data ALL=(ALL) NOPASSWD:ALL

sudo apt-get install git python-pip python-dev build-essential
pip install csvfiter
git clone https://github.com/codeinthehole/csvfilter.git

sudo apt-get install php-curl

https://github.com/DanMcInerney/wifijammer.git
sudo python setup.py install


return mac vendor https://macvendors.com/api
<?php
  $mac_address = "FC:FB:FB:01:FA:21";
  $url = "http://api.macvendors.com/" . urlencode($mac_address);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($ch);
  if($response) {
    echo "Vendor: $response";
  } else {
    echo "Not Found";
  }
?>

