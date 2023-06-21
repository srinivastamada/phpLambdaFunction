<?php
function validateEmail($email)
{
    // Step 1: Check the email address format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    // Step 2: Extract the domain from the email address
    $domain = substr(strrchr($email, "@"), 1);
    // Step 3: Check the MX records of the domain
    $mxRecords = [];
    if (getmxrr($domain, $mxRecords) === false) {
        return false;
    }
    return true;
}
?>