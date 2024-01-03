<?

//session_start();

CModule::AddAutoloadClasses(
	'', // не указываем имя модуля
	array(
		  // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
			'UserRegister' => '/local/php_interface/include/UserRegisterHandler.php',
			'HLBlockChange' => '/local/php_interface/include/HLBlockChangeHandler.php',
		)
);

\Bitrix\Main\Loader::includeModule('highloadblock');

AddEventHandler("main", "OnAfterUserRegister", Array("UserRegister", "AfterUserRegister"));
//AddEventHandler("", "EstateAgentsOnAfterUpdate", Array("HLBlockChange", "OnChange"));

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("", "EstateAgentsOnAfterUpdate", Array("HLBlockChange", "OnChange"));
$eventManager->addEventHandler("", "EstateAgentsOnAfterAdd", Array("HLBlockChange", "OnChange"));
$eventManager->addEventHandler("", "EstateAgentsOnAfterDelete", Array("HLBlockChange", "OnChange"));

?>