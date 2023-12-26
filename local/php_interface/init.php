<?

session_start();

CModule::AddAutoloadClasses(
	'', // не указываем имя модуля
	array(
		  // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
			'UserRegister' => '/local/php_interface/include/UserRegisterHandler.php',
		)
);

AddEventHandler("main", "OnAfterUserRegister", Array("UserRegister", "AfterUserRegister"));

?>