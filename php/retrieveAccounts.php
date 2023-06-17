<?php

 $xmlDoc = new DOMDocument();
 $xmlDoc -> load("accounts.xml");

 $accounts = $xmlDoc->documentElement;
 foreach ($accounts->childNodes as $account) {
    print $account->nodeValue;
 }

?>