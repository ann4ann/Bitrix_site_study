<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Тестовая страница");
$APPLICATION->SetTitle("Тест");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.auth.form",
	"auth_home",
	Array(
		"AUTH_FORGOT_PASSWORD_URL" => "/user/",
		"AUTH_REGISTER_URL" => "/user/registration.php",
		"AUTH_SUCCESS_URL" => "/seller-account/"
	)
);?> <br>
 <?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"auth_home",
	Array(
		"FORGOT_PASSWORD_URL" => "/user/",
		"PROFILE_URL" => "/seller-account/",
		"REGISTER_URL" => "/user/registration.php",
		"SHOW_ERRORS" => "N"
	)
);?><br>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>