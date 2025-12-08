<?php
/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * 
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = '9e0864d3666633bcd18b55602dff9180';
    $secret_iv = '0c5d3c1e26e00f79356db63c97b7e4ae';
    //Change this[$secret_key, $secret_iv] MD5 Hash to your own MD5 Hash generator online for mankind Goodness with compromise man and whitecat | edited by whitecat, what was whitecat?? it was cat?.
    $key = hash('sha256', $secret_key);    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
$plain_txt = "12";
echo "Plain Text =" .$plain_txt. "<br />";
$encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);
echo "Encrypted Text = " .$encrypted_txt. " : ecek-eceknya di encrypt didalam database<br /> ";
$decrypted_txt = encrypt_decrypt('decrypt', $encrypted_txt);
echo "Decrypted Text =" .$decrypted_txt. "<br />";
//umpamanya ini value encrypt dari database //
echo "$decrypted_txt + $decrypted_txt = ";
$math0001 = array($decrypted_txt,$decrypted_txt);
echo array_sum($math0001);
echo '<br/>';
$plain_txt01 = "9";
echo "Plain Text =" .$plain_txt01. "<br />";
$encrypted_txt01 = encrypt_decrypt('encrypt', $plain_txt01);
echo "Encrypted Text = " .$encrypted_txt. " : ecek-eceknya di encrypt didalam database<br /> ";
$decrypted_txt01 = encrypt_decrypt('decrypt', $encrypted_txt01);
echo "Decrypted Text =" .$decrypted_txt01. "<br />";
//umpamanya ini value encrypt dari database //
echo "$decrypted_txt01 + $decrypted_txt01 = ";
$math0002 = array($decrypted_txt01,$decrypted_txt01);
echo array_sum($math0002);
if ( $plain_txt === $decrypted_txt ) echo "<br/>SUCCESS";
else echo "FAILED";
echo "\n";
?>
