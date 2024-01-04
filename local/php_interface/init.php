<?

use Bitrix\Main\Loader;

Loader::includeModule('highloadblock');

//session_start();

CModule::AddAutoloadClasses(
	'', // не указываем имя модуля
	array(
		  // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
			'UserEvents' => '/local/php_interface/include/UserEventsHandler.php',
			'HLBlockChange' => '/local/php_interface/include/HLBlockChangeHandler.php',
		)
);

AddEventHandler("main", "OnAfterUserRegister", Array("UserEvents", "AfterUserRegister"));
AddEventHandler("main", "OnAfterUserLogout", Array("UserEvents", "AfterUserLogout"));

//AddEventHandler("", "EstateAgentsOnAfterUpdate", Array("HLBlockChange", "OnChange"));

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("", "EstateAgentsOnAfterUpdate", Array("HLBlockChange", "OnChange"));
$eventManager->addEventHandler("", "EstateAgentsOnAfterAdd", Array("HLBlockChange", "OnChange"));
$eventManager->addEventHandler("", "EstateAgentsOnAfterDelete", Array("HLBlockChange", "OnChange"));

?>