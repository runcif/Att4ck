# Att4ck


driver for aukey usb 5.0 ghz
https://github.com/diederikdehaas/rtl8812AU
or https://alexatnet.com/using-rtl8812-wi-fi-adapter-with-raspberry-pi/

ricordati all'errore del make di installare: sudo apt-get install raspberrypi-kernel-headers


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

