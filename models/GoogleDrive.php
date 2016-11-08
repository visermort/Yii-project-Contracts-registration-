<?php

namespace app\models;


/**
 * Работа с API Google Drive
 */
class GoogleDrive
{

	private $client;
	private $haveToken = false;

	/**
	* при создании - авторизация к сервису - 2 этапа : 1.запрос на получение ключа 2. получение ключа и запись в сессию
	*/
	public function __construct()
	{
		$scriptUri = "http://".$_SERVER["HTTP_HOST"]."/contracts/export";


		$client = new \Google_Client();
		$client->setApplicationName('Google Drive Save Application');
		$client->setClientId(\yii::$app->params['googleClientId']);
		$client->setClientSecret(\yii::$app->params['googleClientSecret']);
		$client->setDeveloperKey(\yii::$app->params['googleApi']);
		$client->setRedirectUri($scriptUri);
		$client->addScope(\Google_Service_Drive::DRIVE_METADATA_READONLY);
		$client->addScope(\Google_Service_Drive::DRIVE_FILE);
		$client->addScope(\Google_Service_Drive::DRIVE);
		$client->addScope(\Google_Service_Drive::DRIVE_APPDATA);

		$code = $_GET['code'];
		if ($code) {

			$client->authenticate($code);
			$access_token = $client->getAccessToken();
			\Yii::$app->session->set('goole_access_token', $access_token);
			header('Location: ' . filter_var($scriptUri, FILTER_SANITIZE_URL));
		} 

		$access_token = \Yii::$app->session->get('goole_access_token');
		if ($access_token) {
		    $client->setAccessToken($access_token);
		    $this->client =  $client;
		    $this->haveToken = true;
		   
		} else {

			$url = $client->createAuthUrl();
			//header("Location: ".$url);
			\Yii::$app->getResponse()->redirect($url);
		}
	}

	/**
	* сообщаем, что ключ имеется
	*/
	public function hasToken()
	{
		return $this->haveToken;
	}


	/**
	* сохраниение документа в Гугл драйв
	*/
	public function saveFile($xlsfile = null)
	{
		if ($xlsfile && $this->client) {
			$service = new \Google_Service_Drive($this->client);
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
		\Yii::$app->session->remove('goole_access_token');

	}

}