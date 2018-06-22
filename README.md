# Att4ck

Operazioni preliminari:
distro kali r4ven
installa apache 
update-rc.d apache2 enable

grep mac 
ifconfig eth0 | grep -Eo '([[:xdigit:]]{1,2}[:-]){5}[[:xdigit:]]{1,2}' | head -n1

deuth manuale https://oneguyoneblog.com/2017/01/12/wifi-jamming-wireless-kali-linux/

Possibile utilizzo di wifijummer già testato su raspberry
(https://dephace.com/how-to-disable-onboard-wifi-for-raspberry-pi-3/)
git clone https://github.com/secdev/scapy
cd scapy
sudo python setup.py install

git clone https://github.com/DanMcInerney/wifijammer


https://github.com/jsh2134/iw_parse.git
https://github.com/iancoleman/python-iwlist.git

pip install csvfilter //importantissimo




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

e poi una volta scovato (se vuoi farlo cadere) fai il deuth dei pacchetti verso il mac.
