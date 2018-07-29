<?php
session_start();
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;


define('CONSUMER_KEY','k04M9fywieytfJ0COxRrN4Wxv');
define('CONSUMER_SECRET','EQDH6hWA6ULjwpNXrxsRJKIIlmThKdl8bTyTAAnBPXz2eXgsJ0');
define('QAUTH_CALLBACK','http://rttwitterlocal.epizy.com/callback.php');

if (!isset($_SESSION['access_token'])) {
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
    echo $connection;
    echo "<pre>";
    print_r($connection);
    echo "</pre>";
    die;
    $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
    $_SESSION['oauth_token'] = $request_token['oauth_token'];
    $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
    $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
    echo 2;die;
    echo $url;
} else {
    $access_token = $_SESSION['access_token'];
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
    $user = $connection->get("account/verify_credentials");
    echo $user->screen_name;
}
?>