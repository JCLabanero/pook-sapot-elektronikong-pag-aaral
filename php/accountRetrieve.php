<?php
 $xmlDoc = new DOMDocument();
 $xmlDoc -> load("../xml/accounts.xml");

 $accounts = $xmlDoc->getElementsByTagName("account");
 foreach ($accounts as $account) {
    print $account->getElementsByTagName("email")->item(0)->nodeValue;
 }

?>