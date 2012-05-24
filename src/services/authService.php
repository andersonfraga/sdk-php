<?php
require_once(realpath(dirname(__FILE__) . "/../classes/accessData.php"));

class AuthService {

    public function create_access_data ($clientId, $clientSecret) {//both must be string
        $appClientValues = array (
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => 'client_credentials'
        );

        foreach ($appClientValues as $name=>$value) {
            $elements[] = "{$name}=" . urlencode($value);
        }

        $appClientValues = implode ("&", $elements);//set url format to data

        // START Request
        $oauthConect = curl_init();
        curl_setopt($oauthConect, CURLOPT_RETURNTRANSFER, 1);//returns the transference value like a string
        curl_setopt($oauthConect, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/x-www-form-urlencoded'));//sets the header
        curl_setopt($oauthConect, CURLOPT_URL, "https://api.mercadolibre.com/oauth/token"); //oauth API
        curl_setopt($oauthConect, CURLOPT_POSTFIELDS, $appClientValues);

        $oauthContent = curl_exec($oauthConect);//execute the conection
        $oauthHttpcode = curl_getinfo($oauthConect, CURLINFO_HTTP_CODE);//status


            if($oauthHttpcode != 200)
        {
            throw new Exception($oauthContent);//throw the exception
        }

        curl_close($oauthConect); //conection close

        // Request OK
        $oauthContent = json_decode($oauthContent, true); //converts string to json
        //set object properties
        $accessData = new AccessData(); //AccessData class instance
        $accessData->setAccessToken(isset($oauthContent['access_token']) ? $oauthContent['access_token'] : "");
        $accessData->setTokenType(isset($oauthContent['token_type']) ? $oauthContent['token_type'] : "");
        $accessData->setExpiresIn(isset($oauthContent['expires_in']) ? $oauthContent['expires_in'] : "");
        $accessData->setScope(isset($oauthContent['scope']) ? $oauthContent['scope'] : "");
        $accessData->setRefreshToken(isset($oauthContent['refresh_token']) ? $oauthContent['refresh_token'] : "");

        return $accessData; //returns an AccessData Object
    }

    public function refresh_access_token ($clientId, $clientSecret, $refreshToken) {//the three must be string
        $refreshValues = array (
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken
        );


        foreach ($refreshValues as $name=>$value) {
            $elements[] = "{$name}=".urlencode($value);
        }

        $refreshValues = implode ("&", $elements);//set url format to data

        // START Request
        $oauthConect = curl_init();
        curl_setopt($oauthConect, CURLOPT_RETURNTRANSFER, 1);//returns the transference value like a string
        curl_setopt($oauthConect, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/x-www-form-urlencoded'));//sets the header
        curl_setopt($oauthConect, CURLOPT_URL, "https://api.mercadolibre.com/oauth/token");//oauth API
        curl_setopt($oauthConect, CURLOPT_POSTFIELDS, $refreshValues);

        $oauthContent = curl_exec($oauthConect);//execute the conection
        $oauthHttpcode = curl_getinfo($oauthConect, CURLINFO_HTTP_CODE);//status

        if($oauthHttpcode != 200)
        {
            throw new Exception($oauthContent);//throw the exception
        }

        curl_close($oauthConect); //conection close

        // Request OK
        $oauthContent = json_decode($oauthContent, true);//converts string to json
        //set object properties
        $accessData = new AccessData(); //AccessData class instance
        $accessData->setAccessToken(isset($oauthContent['access_token']) ? $oauthContent['access_token'] : "");
        $accessData->setTokenType(isset($oauthContent['token_type']) ? $oauthContent['token_type'] : "");
        $accessData->setExpiresIn(isset($oauthContent['expires_in']) ? $oauthContent['expires_in'] : "");
        $accessData->setScope(isset($oauthContent['scope']) ? $oauthContent['scope'] : "");
        $accessData->setRefreshToken(isset($oauthContent['refresh_token']) ? $oauthContent['refresh_token'] : "");

        return $accessData; //returns an AccessData Object
    }
}


?>
