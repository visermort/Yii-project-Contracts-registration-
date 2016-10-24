<?php

//use yii;
use yii\db\Migration;

class m161024_113601_update_user_table extends Migration
{
    public function up()
    {
        $this->insert('{{%user}}', array(
            'username' => 'admin',
            'display_name' => 'Administrator',
            'password_hash' => Yii::$app->security->generatePasswordHash('rucnqo'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            )); 
        $this->insert('{{%user}}', array(
            'username' => '01 Dep Chisinau Bd. Ștefan cel Mare 71',
            'display_name' => '01 Dep Chisinau Bd. Ștefan cel Mare 71',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));  
        $this->insert('{{%user}}', array(
            'username' => '02 Dep Chisinau Str. Independentei 13',
            'display_name' => '02 Dep Chisinau Str. Independentei 13',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '04 Dep Chisinau Str. Arborilor 21',
            'display_name' => '04 Dep Chisinau Str. Arborilor 21',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '07 Dep Chisinau Bd Stefan cel Mare 128/1',
            'display_name' => '07 Dep Chisinau Bd Stefan cel Mare 128/1',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
       $this->insert('{{%user}}', array(
            'username' => '09 Dep Chisinau Str. A. Russo 1/1',
            'display_name' => '09 Dep Chisinau Str. A. Russo 1/1',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '10 Dep Chisinau Str. Dacia 23',
            'display_name' => '10 Dep Chisinau Str. Dacia 23',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
         $this->insert('{{%user}}', array(
            'username' => '11 Dep Chisinau Str. Bucuriei 1/6',
            'display_name' => '11 Dep Chisinau Str. Bucuriei 1/6',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '12 Dep Chisinau Pasaj Subteran str. Izmail 62101612',
            'display_name' => '12 Dep Chisinau Pasaj Subteran str. Izmail 62101612',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '22 Dep Chisinau Pasaj Subteran str. Izmail 62101622',
            'display_name' => '22 Dep Chisinau Pasaj Subteran str. Izmail 62101622',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '23 Dep Chisinau Bd. Ştefan cel Mare 132 62101623',
            'display_name' => '23 Dep Chisinau Bd. Ştefan cel Mare 132 62101623',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '27 Dep Chisinau str. Kiev 16/1',
            'display_name' => '27 Dep Chisinau str. Kiev 16/1',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '30 Dep Orhei Str. Vasile Lupu 37',
            'display_name' => '30 Dep Orhei Str. Vasile Lupu 37',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '31 Dep Comrat Str. Lenin 178',
            'display_name' => '31 Dep Comrat Str. Lenin 178',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
         $this->insert('{{%user}}', array(
            'username' => '32 Dep Balti Piaţa Vasile Alecsandri 4',
            'display_name' => '32 Dep Balti Piaţa Vasile Alecsandri 4',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
         $this->insert('{{%user}}', array(
            'username' => '36 Dep Edinet Str. 31 August 1989, 11',
            'display_name' => '36 Dep Edinet Str. 31 August 1989, 11',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '37 Dep Drochia Str. 31 August 1989, 33',
            'display_name' => '37 Dep Drochia Str. 31 August 1989, 33',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '38 Dep Straseni Str. M. Eminescu 25',
            'display_name' => '38 Dep Straseni Str. M. Eminescu 25',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '39 Dep Cahul Str. Republicii 20/11',
            'display_name' => '39 Dep Cahul Str. Republicii 20/11',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
         $this->insert('{{%user}}', array(
            'username' => '40 Dep Causeni Str. M. Eminescu 12',
            'display_name' => '40 Dep Causeni Str. M. Eminescu 12',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
         $this->insert('{{%user}}', array(
            'username' => '41 Dep Balti Bd. Ștefan cel Mare 37',
            'display_name' => '41 Dep Balti Bd. Ștefan cel Mare 37',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
         $this->insert('{{%user}}', array(
            'username' => '42 Dep Soroca Str. Grigore Vieru 5',
            'display_name' => '42 Dep Soroca Str. Grigore Vieru 5',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '43 Dep Hancesti Str. Chisinaului 10A',
            'display_name' => '43 Dep Hancesti Str. Chisinaului 10A',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
         $this->insert('{{%user}}', array(
            'username' => '47 Dep Ungheni Str. Nationala 15',
            'display_name' => '47 Dep Ungheni Str. Nationala 15',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
        $this->insert('{{%user}}', array(
            'username' => '51 Dep Glodeni Str. Suveranitatii 17/2',
            'display_name' => '51 Dep Glodeni Str. Suveranitatii 17/2',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
         $this->insert('{{%user}}', array(
            'username' => '52 Dep Ceadar-Lunga Str. Lenin 79',
            'display_name' => '52 Dep Ceadar-Lunga Str. Lenin 79',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
         $this->insert('{{%user}}', array(
            'username' => '53 Dep Calarasi Str. M. Eminescu 23',
            'display_name' => '53 Dep Calarasi Str. M. Eminescu 23',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'status' => '10',
            ));    
    
    }

    public function down()
    {
        $this->truncateTable('{{%user}}');
    }

}


