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

AddEventHandler("main", "OnAfterUserRegister", Array("UserRegister", "AfterUserRegister"));

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("main", "EstateAgentsOnAfterAdd", Array("HLBlockChange", "OnChange"));
$eventManager->addEventHandler("main", "EstateAgentsOnAfterUpdate", Array("HLBlockChange", "OnChange"));
$eventManager->addEventHandler("main", "EstateAgentsOnAfterDelete", Array("HLBlockChange", "OnChange"));

?>