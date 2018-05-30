<?php
require_once __DIR__ . '/vendor/autoload.php';
date_default_timezone_set('UTC');
// Bootstrap the JMS custom annotations for Object to Json mapping
\Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
    'JMS\Serializer\Annotation', __DIR__ . '/vendor/jms/serializer/src'
);

$env = ['TenantID' => '76978cbb-8289-4c62-9bdd-74f09dfee4a0'];
$env['ClientID'] = "b6bc4bee-531d-4422-bc39-95b6bbf57f01";
$env['ClientSecret'] = "845w84SDbccifUW/2IeCZpYQ67GBKTNoANjlicu8vPQ=";
$env['RESTAPIEndpoint'] = "https://ydimedia.restv2.southeastasia.media.azure.net/api/";
$env['AzureADSTSEndpoint'] = "https://login.microsoftonline.com/{$env['TenantID']}/oauth2/token";
$env['resource'] = 'https://rest.media.azure.net';

$env['AccessToken'] = "";//dynamic generated period
$env['LastAssetId'] = "nb:cid:UUID:f70f83c0-9af5-47d6-8bcd-42f1d0fd046e";
$env['LastAccessPolicyId'] = "nb:pid:UUID:bc976ab4-944a-4070-bfdd-0df0be24c5a3";
$env['UploadURL'] = "https://ydistorage.blob.core.windows.net/asset-f70f83c0-9af5-47d6-8bcd-42f1d0fd046e/ydimedia?sv=2015-07-08&sr=c&si=974e20ac-dd6b-4c3b-ad57-be9dfccd6274&sig=QFETUsdWM%2B5WvlI5iLy%2FFNrpooZKI3tynPhl5ArAeTs%3D&se=2018-04-10T17%3A01%3A50Z";
$env['MediaFileName'] = "ydimedia-test.mp4";
$env['LastChannelId'] = "";


$lifetime = strtotime('+30 minutes', 0);
session_set_cookie_params($lifetime);
session_start();

$provider  = new  \TheNetworg\OAuth2\Client\Provider\Azure([
    'clientId'          => $env['ClientID'],
    'clientSecret'      => $env['ClientSecret'],
    'urlResourceOwnerDetails' => 'https://rest.media.azure.net',
]);
$provider->resource = $env['resource'];
$provider->tenant = $env['TenantID'];
$provider->urlAPI = $env['RESTAPIEndpoint'];
$provider->API_VERSION = '2.15';

if (!isset($_SESSION['azure_auth_grant_code'])) {
    $provider->getAuthorizationUrl();
    $token = $provider->getAccessToken('client_credentials', [
        'code' => $provider->getState(),
        'resource' => 'https://rest.media.azure.net',
    ]);
    $_SESSION['azure_access_token'] = serialize($token);
}

$token = unserialize($_SESSION['azure_access_token']);

$assets = $provider->get('Assets',$token );
var_dump($assets);
//var_dump(
//    $provider->getAccessToken('client_credentials')
//);

/*
url: {{AzureADSTSEndpoint}}
body:
grant_type:client_credentials
client_id:{{ClientID}}
client_secret:{{ClientSecret}}
resource:https://rest.media.azure.net
    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code'],
        'resource' => 'https://graph.windows.net',
    ]);
POST /76978cbb-8289-4c62-9bdd-74f09dfee4a0/oauth2/token HTTP/1.1
Host: login.microsoftonline.com
Content-Type: application/x-www-form-urlencoded
Keep-Alive: true
Cache-Control: no-cache
Postman-Token: 75bf581f-3bbd-62f2-6f3b-f6b7c0dd4e4d

grant_type=client_credentials
&client_id=b6bc4bee-531d-4422-bc39-95b6bbf57f01
&client_secret=845w84SDbccifUW%2F2IeCZpYQ67GBKTNoANjlicu8vPQ%3D
&resource=https%3A%2F%2Frest.media.azure.net
 */

