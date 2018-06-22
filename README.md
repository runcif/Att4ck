# Att4ck

<<<<<<< .mine
||||||| .r20
Operazioni preliminari:
distro kali r4ven
installa apache 
installa aircrack-ng


=======
Operazioni preliminari:
distro kali r4ven
installa apache 
update-rc.d apache2 enable

>>>>>>> .r25
grep mac 
ifconfig eth0 | grep -Eo '([[:xdigit:]]{1,2}[:-]){5}[[:xdigit:]]{1,2}' | head -n1


https://github.com/jsh2134/iw_parse.git
https://github.com/iancoleman/python-iwlist.git

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

