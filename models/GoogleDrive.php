<?php

namespace app\models;

use Yii;
use yii\base\Model;
//use yii\base\Exception;
//use yii\authclient\OAuth2;
//use app\models\GoogleAuth;
//use app\vendor\google\apiclient;
//use app\vendor\google\apiclientServices;
//use app\vendor\google\auth;

/**
 * 
 */
class GoogleDrive
{


	public static function saveFile($xlsfile = null)
	{

		$scriptUri = "http://".$_SERVER["HTTP_HOST"]."/contracts/export";


		$client = new \Google_Client();
		$client->setApplicationName('Google Drive Save Application');
		$client->setClientId('xxxxxx');
		$client->setClientSecret('xxxxx');
		$client->setRedirectUri($scriptUri);
		$client->setDeveloperKey('xxxxxxx');
		$client->addScope(\Google_Service_Drive::DRIVE_METADATA_READONLY);
		$client->addScope(\Google_Service_Drive::DRIVE_FILE);
		$client->addScope(\Google_Service_Drive::DRIVE);
		$client->addScope(\Google_Service_Drive::DRIVE_APPDATA);

		$code = $_GET['code'];
		if ($code) {

			$client->authenticate($code);
			$access_token = $client->getAccessToken();
			Yii::$app->session->set('goole_access_token', $access_token);
			header('Location: ' . filter_var($scriptUri, FILTER_SANITIZE_URL));
		} 

		$access_token = Yii::$app->session->get('goole_access_token');
		if ($access_token) {
		    $client->setAccessToken($access_token);
		} else {
			$url = $client->createAuthUrl();
			header("Location: ".$url);
		}
		//echo 'accesstoken '.print_r($access_token,true);


		if ($xlsfile) {
			$service = new \Google_Service_Drive($client);
		    $file = new \Google_Service_Drive_DriveFile();
		    $file->setName('Contracts.xlsx');
		    $file->setDescription('Contracts');
		    $data = file_get_contents($xlsfile);

		    $result = $createdFile = $service->files->create($file, array(
		          'data' => $data,
		          'mimeType' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		          'uploadType' => 'multipart'
        		));
		} 
	}



}