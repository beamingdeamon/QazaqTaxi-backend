<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SmsGatewaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sms_gateways = array(
            array('name' => 'TWILLIO','params' => '{"api_key":"SID","sender_number":"Twillio Number","auth_token":"Auth Token"}','description' => 'twillio','status' => '1','environment' => NULL,'created_at' => '2019-04-24 09:55:52','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'KUTILITY','params' => '{"api_key":"Public Key","sender":"Sender"}','description' => 'KUTILITY','status' => '1','environment' => NULL,'created_at' => '2019-01-18 07:08:56','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'MobiReach','params' => '{"api_key":"Username","sender_number":"Sender","auth_token":"Password"}','description' => 'MobiReach','status' => '1','environment' => NULL,'created_at' => '2019-02-04 10:25:39','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'AFRICATALKING','params' => '{"api_key":"Username","auth_token":"Password"}','description' => 'AFRICATALKING','status' => '1','environment' => NULL,'created_at' => '2019-02-08 11:23:53','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'SENANGPAY','params' => '{"api_key":"Username","auth_token":"Password"}','description' => 'SENANGPAY','status' => '1','environment' => NULL,'created_at' => '2019-03-04 13:18:26','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'ONEWAYSMS','params' => '{"api_key":"Username","sender":"Sender Id","auth_token":"Password","usermessage":"Enter User Message","drivermessage":"Enter Driver Message"}','description' => 'ONEWAYSMS','status' => '1','environment' => '1','created_at' => '2019-03-28 10:27:10','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'KNOWLARITY','params' => '{"api_key":"Username","sender":"Sender Id","auth_token":"Password"}','description' => 'knowlarity','status' => '1','environment' => '1','created_at' => '2019-03-19 05:12:13','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'ROUTESMS','params' => '{"api_key":"Username","sender":"Sender Id","auth_token":"Password"}','description' => 'RouteSms','status' => '1','environment' => '1','created_at' => '2019-03-19 05:56:53','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'JAVNA','params' => '{"api_key":"Username","auth_token":"Password"}','description' => 'Javna','status' => '1','environment' => '1','created_at' => '2019-03-19 06:33:27','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'EASYSENDSMS','params' => '{"api_key":"Username","sender":"Sender Id","auth_token":"Password"}','description' => 'EASYSENDSMS','status' => '1','environment' => '1','created_at' => '2019-04-03 05:51:37','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'ROBISEARCH','params' => '{"api_key":"Username","auth_token":"Password","sender":"Sender Id"}','description' => 'Robisearch','status' => '1','environment' => '1','created_at' => '2019-04-04 13:14:21','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'EXOTEL','params' => '{"api_key":"Exotel Sid","auth_token":"Exotel token","sender":"Sender Number"}','description' => 'EXOTEL','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'TEXTLOCAL','params' => '{"api_key": "API Key", "sender": "Sender"}','description' => 'TEXTLOCAL','status' => '1','environment' => '1','created_at' => '2019-05-28 07:24:15','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'CLICKATELL','params' => '{"api_key": "API Key"}','description' => 'CLICKATELL','status' => '1','environment' => NULL,'created_at' => '2019-05-07 08:55:56','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'NEXMO','params' => '{"api_key": "API Key", "api_secret_key": "API Secret Key" }','description' => 'NEXMO','status' => '1','environment' => NULL,'created_at' => '2019-05-07 11:22:15','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'SMSLIVE247','params' => '{"api_key": "Main Account Login Email","subacct":"Sub Account","auth_token": "Sub Password","sender":"Sender"}','description' => 'SMSLIVE247','status' => '1','environment' => NULL,'created_at' => '2019-05-13 09:23:07','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'NRSGATEWAY','params' => '{"api_key": "Username", "auth_token": "Password","sender":"Sender"}','description' => 'NRSGATEWAY','status' => '1','environment' => NULL,'created_at' => '2019-05-15 09:23:07','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'EASYSERVICE','params' => '{"api_key": "Api key", "sender":"Sender", "api_secret_key" : "Message Type"}','description' => 'EASYSERVICE','status' => '1','environment' => NULL,'created_at' => '2019-05-17 11:19:43','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'DATASOFT','params' => '{ "api_key": "Username", "sender":"Sender","auth_token" : "Password" }','description' => 'DATASOFT','status' => '1','environment' => NULL,'created_at' => '2019-05-21 12:00:23','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'CELLSYNT','params' => '{ "api_key": "Username", "sender":"Sender","auth_token" : "Password"}','description' => 'CELLSYNT','status' => '1','environment' => NULL,'created_at' => '2019-05-21 12:00:23','updated_at' => '2019-05-21 12:00:23'),
            array('name' => 'SERVICIO','params' => '{"api_key": "Username","auth_token" : "Password" }','description' => 'SERVICIO','status' => '1','environment' => NULL,'created_at' => '2019-05-21 12:00:23','updated_at' => '2019-05-21 12:00:23'),
            array('name' => 'SENDPULSE','params' => '{"api_key": "Client ID","sender":"Sender","auth_token" : "Client Secret","account_id":"Address Book ID"}','description' => 'SENDPULSE','status' => '1','environment' => NULL,'created_at' => '2019-06-10 13:04:32','updated_at' => '2019-05-21 12:00:23'),
            array('name' => 'SMSCOUNTRY','params' => '{"api_key": "Username","sender":"Sender","auth_token" : "Password"}','description' => 'SMSCOUNTRY','status' => '1','environment' => NULL,'created_at' => '2019-06-10 13:04:32','updated_at' => '2019-05-21 12:00:23'),
            array('name' => 'EBULKSMS','params' => '{ "api_key": "","sender":"SMASHRIDES", "auth_token" : "Password" }','description' => 'SMSCOUNTRY','status' => '1','environment' => NULL,'created_at' => '2019-06-10 13:04:32','updated_at' => '2019-05-21 12:00:23'),
            array('name' => 'ENGAGE SPARK','params' => '{"api_key":"engageSPARK Organization ID","auth_token":"engageSPARK Authorization","sender":"engageSPARK Sender"}','description' => 'ENGAGE SPARK','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'POSTAGUVERCINI','params' => '{"api_key":"POSTAGUVERCINI Username","auth_token":"POSTAGUVERCINI Password","sender":"POSTAGUVERCINI Sender"}','description' => 'POSTAGUVERCINI','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'SMARTSMSSOLUTIONS','params' => '{"api_key":"SMARTSMSSOLUTIONS SenderId","auth_token":"SMARTSMSSOLUTIONS Token","sender":"SMARTSMSSOLUTIONS Sender"}','description' => 'SMARTSMSSOLUTIONS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'SMSVIRO','params' => '{"api_key":"SMSVIRO SenderId","auth_token":"SMSVIRO Token"}','description' => 'SMSVIRO','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'AAKASHSMS','params' => '{"api_key":"AAKASHSMS SenderId","auth_token":"AAKASHSMS Token"}','description' => 'AAKASHSMS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'BULKSMSNIGERIA','params' => '{"api_key":"BULKSMSNIGERIA SenderId","auth_token":"BULKSMSNIGERIA Token"}','description' => 'BULKSMSNIGERIA','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'BULKSMSZAMTEL','params' => '{"api_key":"BULKSMSZAMTEL Api Key","sender":"BULKSMSZAMTEL SenderId"}','description' => 'BULKSMSZAMTEL','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'SSLWIRELESS','params' => '{"api_key":"SSLWIRELESS SenderId","auth_token":"SSLWIRELESS Username","api_secret_key":"SSLWIRELESS Password"}','description' => 'SSLWIRELESS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'MYTELESOM','params' => '{"api_key":"MYTELESOM Api Key","auth_token":"MYTELESOM Username","api_secret_key":"MYTELESOM Password","sender":"MYTELESOM Sender"}','description' => 'SSLWIRELESS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'SELCOMSMS','params' => '{"api_key":"SELCOMSMS Username","api_secret_key":"SELCOMSMS Password"}','description' => 'SELCOMSMS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'NSEMFUA','params' => '{"api_key":"NSEMFUA Api Key","sender":"NSEMFUA Sender"}','description' => 'NSEMFUA','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'PLIVO','params' => '{"api_key":"PLIVO AuthId","auth_token":"PLIVO Auth Token","sender":"PLIVO Sender"}','description' => 'PLIVO','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'BULKSMSBD','params' => '{"api_key":"BULKSMSBD Username","auth_token":"BULKSMSBD Password"}','description' => 'BULKSMSBD','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'MULTITEXTER','params' => '{"api_key":"MULTITEXTER Username","auth_token":"MULTITEXTER Password","sender":"MULTITEXTER Sender"}','description' => 'MULTITEXTER','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'MSG91','params' => '{"auth_token":"MSG91 AuthKey","sender":"MSG91 Sender"}','description' => 'MSG91','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '0000-00-00 00:00:00'),
            array('name' => 'OUTREACH','params' => '{"api_key":"OUTREACH Username","auth_token":"OUTREACH Password","sender":"OUTREACH Masking"}','description' => 'OUTREACH','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'BUDGETSMS','params' => '{"api_key":"BUDGETSMS Username","auth_token":"BUDGETSMS Handle","sender":"BUDGETSMS SenderId","api_secret_key" : "BUDGETSMS UserId"}','description' => 'BUDGETSMS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'CLICKATELLAPI','params' => '{"api_key":"CLICKATELLAPI Username","api_secret_key":"CLICKATELLAPI Password","sender":"CLICKATELLAPI ApiId"}','description' => 'CLICKATELLAPI','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'SHAMELSMS','params' => '{"api_key":"SHAMELSMS Username","api_secret_key":"SHAMELSMS Password","sender":"SHAMELSMS ApiId"}','description' => 'SHAMELSMS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'INFOBIP','params' => '{"api_key":"INFOBIP Username","api_secret_key":"INFOBIP Password"}','description' => 'INFOBIP','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'TWWWIRELESS','params' => '{"api_key":"TWWWIRELESS Username","api_secret_key":"TWWWIRELESS Password","sender":"TWWWIRELESS Sender"}','description' => 'TWWWIRELESS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'SMS123','params' => '{"api_key":"SMS123 Api Key","sender":"SMS123 Company Name"}','description' => 'SMS123','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'BULKSMS','params' => '{"api_key":"BULKSMS Username","api_secret_key":"BULKSMS Password"}','description' => 'BULKSMS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'TEXTINGHOUSE','params' => '{"api_key":"TEXTINGHOUSE Username","api_secret_key":"TEXTINGHOUSE Password"}','description' => 'TEXTINGHOUSE','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'MOBILE360','params' => '{"api_key":"Mobile360 Username","api_secret_key":"Mobile360 Password","sender":"Mobile360 Shote Code Mask"}','description' => 'Mobile360','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'FACILITA_MOVEL','params' => '{"api_key":"FACILITA_MOVEL Username","api_secret_key":"FACILITA_MOVEL Password"}','description' => 'FACILITA_MOVEL','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'E_SMS','params' => '{"api_key":"E_SMS Api key","api_secret_key":"E_SMS Secret Key","sender":"E_SMS Brand name"}','description' => 'E_SMS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'INFOBIP_SMS','params' => '{"api_key":"INFOBIP_SMS Api key","api_secret_key":"INFOBIP_SMS Base url","sender":"INFOBIP_SMS Sender"}','description' => 'INFOBIP_SMS','status' => '1','environment' => NULL,'created_at' => '2019-04-11 11:58:44','updated_at' => '2019-04-11 11:58:44'),
            array('name' => 'iSmart','params' => '{"api_key":"User Id","api_secret_key":"Password"}','description' => 'iSmart','status' => '1','environment' => NULL,'created_at' => '2021-03-02 12:32:34','updated_at' => '2021-03-02 12:32:34'),
            array('name' => 'smsportal','params' => '{"api_key":"Client ID","api_secret_key":"API Secret"}','description' => 'smsportal smsworx','status' => '1','environment' => NULL,'created_at' => '2021-03-02 12:32:34','updated_at' => '2021-03-02 12:32:34'),
            array('name' => 'ArkeselSMS','params' => '{"api_key":"Api Key","sender":"Sender"}','description' => 'ArkeselSMS','status' => '1','environment' => NULL,'created_at' => '2021-03-02 12:32:34','updated_at' => '2021-03-02 12:32:34'),
            array('name' => 'BurstSMS','params' => '{"api_key":"Api Key","sender":"Sender"}','description' => 'BurstSMS','status' => '1','environment' => NULL,'created_at' => '2021-03-02 12:32:34','updated_at' => '2021-03-02 12:32:34'),
            array('name' => 'SMSBOX','params' => '{"api_key":"SMSBOX UserName","api_secret_key":"SMSBOX Password","account_id":"SMSBOX Gateway Id","sender":"SMSBOX Sender Name"}','description' => 'SMSBOX','status' => '1','environment' => '1','created_at' => '2021-02-10 18:07:02','updated_at' => '2021-02-10 18:07:02'),
            array('name' => 'WhatsAppTodo','params' => NULL,'description' => 'WhatsAppTodo','status' => '1','environment' => '1','created_at' => '2021-02-10 18:07:02','updated_at' => '2021-02-10 18:07:02'),
            array('name' => 'mymobileapi','params' => '{"api_key":"Client ID","api_secret_key":"API Secret"}','description' => 'mymobileapi smsworx','status' => '1','environment' => NULL,'created_at' => '2021-03-02 12:32:34','updated_at' => '2021-03-02 12:32:34'),
            array('name' => 'SMSCTP','params' => '{"api_key":"Username","api_secret_key":"Password","sender":"Originator/Sender"}','description' => 'SMSCTP','status' => '1','environment' => NULL,'created_at' => '2021-07-16 12:32:34','updated_at' => '2021-07-16 12:32:34'),
            array('name' => 'SMSDEV','params' => '{"api_key":"Api Key"}','description' => 'SMSDEV','status' => '1','environment' => NULL,'created_at' => '2021-07-16 12:32:34','updated_at' => '2021-07-16 12:32:34'),
            array('name' => 'MUTHOFUN','params' => '{"api_key":"Username","api_secret_key":"Password"}','description' => 'MUTHOFUN','status' => '1','environment' => NULL,'created_at' => '2021-07-19 12:32:34','updated_at' => '2021-07-19 12:32:34'),
            array('name' => 'KINGSMS','params' => '{"api_key":"Username","api_secret_key":"Token"}','description' => 'KINGSMS','status' => '1','environment' => NULL,'created_at' => '2021-07-19 12:32:34','updated_at' => '2021-07-19 12:32:34'),
            array('name' => 'GLOBELABS','params' => '{"api_key":"App Id","api_secret_key":"App Secret","sender_number":"Short Code","auth_token":"Pass Phrase"}','description' => 'GLOBELABS','status' => '1','environment' => NULL,'created_at' => '2021-07-19 12:32:34','updated_at' => '2021-07-19 12:32:34'),
            array('name' => 'MULTITEXTERSMS','params' => '{"api_key":"Email","api_secret_key":"Password","sender":"Sender Name Of Your Choice"}','description' => 'MULTITEXTERSMS','status' => '1','environment' => NULL,'created_at' => '2021-08-17 12:32:34','updated_at' => '2021-08-17 12:32:34'),
            array('name' => 'SMSPRO_NIKITA','params' => '{"api_key":"User Name","api_secret_key":"Password","sender":"Sender Name Of Your Choice"}','description' => 'SMSPRO_NIKITA','status' => '1','environment' => NULL,'created_at' => '2021-08-17 12:32:34','updated_at' => '2021-09-17 12:32:34'),
            array('name' => 'MESSAGEBIRD','params' => '{"api_key":"Access Token","sender":"Sender Name Of Your Choice(Project\'s name)"}','description' => 'Message Bird','status' => '1','environment' => NULL,'created_at' => '2021-09-30 12:32:34','updated_at' => '2021-09-30 12:32:34'),
            array('name' => 'FLOPPYSEND','params' => '{"api_key":"Api Key","sender":"Sender Name Of Your Choice(Project name)"}','description' => 'Floppy Send','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'RICHCOMMUNICATION','params' => '{"api_secret_key":"Auth Key","sender":"Sender Id"}','description' => 'Rich Communication','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'SMSTO','params' => '{"api_secret_key":"Api Key","sender":"Sender Name"}','description' => 'SMS To','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'TELESOM','params' => '{"api_key":"User Name","api_secret_key":"Password","sender":"Sender","auth_token":"Key"}','description' => 'My Telesom','status' => '1','environment' =>NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'SUDACELLBULKSMS','params' => '{"api_key":"User Name","api_secret_key":"Password","sender":"Sender"}','description' => 'SUDACELLBULKSMS','status' => '1','environment' =>NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'TELESOM','params' => '{"api_key":"User Name","api_secret_key":"Password","sender":"Sender","auth_token":"Key"}','description' => 'My Telesom','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'BULKSMSSERVICES','params' => '{"api_key":"User Name","api_secret_key":"Password","sender":"Sender"}','description' => 'BulkSMSServices','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'ORANGESMS','params' => '{"api_key":"ORANGESMS SenderAddress","sender":"ORANGESMS sender","auth_token":"ORANGESMS AuthToken"}','description' => 'ORANGESMS','status' => '1','environment' => NULL,'created_at' => '','updated_at' => ''),
            array('name' => 'CLICKSEND','params' => '{"api_key":"User Name","api_secret_key":"Api Key"}','description' => 'ClickSend','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'SINCH','params' => '{"api_key":"Service Plan Id","api_secret_key":"Bearer Token","sender":"Virtual Number"}','description' => 'Sinch','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'SMSBUS','params' => '{"api_key":"Username","api_secret_key":"Password","sender":"Sender"}','description' => 'SmsBus','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'NIGERIABULKSMS','params' => '{"api_key":"Username","api_secret_key":"Password","sender":"Sender"}','description' => 'nigeriabulksms','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'MESSAGEMEDIA','params' => '{"api_key":"Api Key","api_secret_key":"Api Secret"}','description' => 'MessageMedia','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'ORANGESMSPRO','params' => '{"api_key":"OrangeSMSPro Username","api_secret_key":"OrangeSMSPro Private Key","auth_token":"OrangeSMSPro Token","sender":"OrangeSMSPro Subject","subacct":"OrangeSMSPro Signature"}','description' => 'OrangeSMSPro','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'SMSZEDEKAA','params' => '{"api_key":"SmsZedekaa ApiKey","api_secret_key":"SmsZedekaa ClientId","sender":"SmsZedekaa SenderId"}','description' => 'SmsZedekaa','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'NOTIFY','params' => '{"api_key":"User ID","api_secret_key":"Api Key","sender":"Sender"}','description' => 'App Notify Lk','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'NIGERIABULKSMS','params' => '{"api_key":"Username","api_secret_key":"Password","sender":"Sender"}','description' => 'nigeriabulksms','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'MESSAGEMEDIA','params' => '{"api_key":"Api Key","api_secret_key":"Api Secret"}','description' => 'MessageMedia','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'ORANGESMSPRO','params' => '{"api_key":"OrangeSMSPro Username","api_secret_key":"OrangeSMSPro Private Key","auth_token":"OrangeSMSPro Token","sender":"OrangeSMSPro Subject","subacct":"OrangeSMSPro Signature"}','description' => 'OrangeSMSPro','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'SMSZEDEKAA','params' => '{"api_key":"SmsZedekaa ApiKey","api_secret_key":"SmsZedekaa ClientId","sender":"SmsZedekaa SenderId"}','description' => 'SmsZedekaa','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'BEEMAFRICA','params' => '{"api_key":"BeemAfrica Api Key","api_secret_key":"BeemAfrica Secret Key"}','description' => 'BeemAfrica','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'MULTITEXTER_V2','params' => '{"api_key":"MultiTexterV2 Api Key","sender":"MultiTexterV2 SenderId"}','description' => 'MultiTexterV2','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'LINXSMS','params' => '{"api_key":"5LinxSms Username","api_secret_key":"5LinxSms Password","sender":"5LinxSms SenderId"}','description' => '5LinxSms','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'BULKSMSDHIRAAGU','params' => '{"api_key":"BulkSMSDhiraagu Username","api_secret_key":"BulkSMSDhiraagu Password"}','description' => 'BulkSMSDhiraagu','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'CLOUDWEBSMS','params' => '{"api_key":"CloudWebSMS Api Key","api_secret_key":"CloudWebSMS Password","sender":"CloudWebSMS SenderId"}','description' => 'CloudWebSMS','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'SMSPOH','params' => '{"api_secret_key":"SMSPoh Api Ke","sender":"SMSPoh SenderId"}','description' => 'SMSPoh','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'CMTELECOME','params' => '{"api_secret_key":"Api token","sender":"SMS SenderId"}','description' => 'cmtelecom','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'GEEZSMS', 'params' => '{"api_secret_key":"Api token","sender":"ShortCode"}', 'description' => 'GeezSMS', 'status' => '1', 'environment' => NULL, 'created_at' => '2022-10-10 00:33:18', 'updated_at' => '2022-10-10 00:33:18'),
            array('name' => 'BULKSMSPLANS','params' => '{"api_key":"API Id","api_secret_key":"Api Password","sender":"Sender","sender_number":"Template Id"}','description' => 'BulkSMSPlans','status' => '1','environment' => NULL,'created_at' => '2022-09-05 15:51:18','updated_at' => '2022-09-05 15:51:18'),
            array('name' => 'WEBLINE','params' => '{"auth_token":"API Token","sender":"Sender"}','description' => 'WEBLINE','status' => '1','environment' => NULL,'created_at' => '2022-09-05 15:51:18','updated_at' => '2022-09-05 15:51:18'),
            array('name' => 'SMSTEKNIK','params' => '{"api_key":"Teknik Username","api_secret_key":"Teknik Password","sender":"Company"}','description' => 'SMSTeknik','status' => '1','environment' => NULL,'created_at' => '2022-09-05 15:51:18','updated_at' => '2022-09-05 15:51:18'),
            array('name' => 'INTOUCHSMS','params' => '{"api_key":"Username","api_secret_key":"Password","sender":"Sender"}','description' => 'IntouchSMS','status' => '1','environment' => NULL,'created_at' => '2022-09-05 15:51:18','updated_at' => '2022-09-05 15:51:18'),
            array('name' => 'NALOSOLUTIONSMS','params' => '{"api_key":"Username","api_secret_key":"Password","sender":"Sender Id"}','description' => 'NaloSolutionsSMS','status' => '1','environment' => NULL,'created_at' => '2022-09-05 15:51:18','updated_at' => '2022-09-05 15:51:18'),
            array('name' => 'TWILIO_WHATSAPP','params' => '{"api_key":"Twilio SID","api_secret_key":"Twilio AuthToken","sender":"Twilio Whatsapp Number"}','description' => 'Twilio Whatsapp','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'TERMII','params' => '{"api_key":"TERMII API KEY","sender":"Sender"}','description' => 'Termii','status' => '1','environment' => NULL,'created_at' => '2022-11-18 17:48:19','updated_at' => '2022-11-18 17:48:19'),
            array('name' => 'MOBIWEB','params' => '{"api_key":"MOBIWEB Username","api_secret_key":"Mobiweb Password","sender":"Sender"}','description' => 'MOBIWEB','status' => '1','environment' => NULL,'created_at' => '2022-12-23 16:47:09','updated_at' => '2022-12-23 16:47:09'),
            array('name' => 'SMS_ETHIOPIA','params' => '{"auth_token":"API URL","api_key":"Api Username","api_secret_key":"Api Password"}','description' => 'SMS Ethiopia','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'ETECH','params' => '{"api_key":"Api Username","api_secret_key":"Api Password","sender":"Sender"}','description' => 'eTech','status' => '1','environment' => NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'ADERASMS','params' => '{"api_key":"User Name","api_secret_key":"Password"}','description' => 'For Adera client','status' => '1','environment' =>NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
            array('name' => 'VONAGE_SMS','params' => '{"api_key":"Api Key","api_secret_key":"Api Secret","sender":"Sender"}','description' => 'Vonage SMS Gateway','status' => '1','environment' =>NULL,'created_at' => '2021-10-07 00:33:18','updated_at' => '2021-10-07 00:33:18'),
        );
        //        nigeriabulksms
        DB::table('sms_gateways')->insert($sms_gateways);
    }
}
