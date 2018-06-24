# Att4ck

grep mac 
ifconfig eth0 | grep -Eo '([[:xdigit:]]{1,2}[:-]){5}[[:xdigit:]]{1,2}' | head -n1


https://github.com/jsh2134/iw_parse.git
https://github.com/iancoleman/python-iwlist.git


sudo apt-get install python-pip python-dev build-essential
pip install csvfiter
https://github.com/codeinthehole/csvfilter.git

sudo apt-get install php-curl

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

