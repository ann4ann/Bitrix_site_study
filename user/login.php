<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Тестовая страница");
$APPLICATION->SetTitle("Тест");
?>

<? 
    global $USER;
    $userId = $USER->GetID(); 

		$curUser = CUser::GetByID($userId);
		$dbResUser = $curUser->Fetch();
		$curUserRoleId = $dbResUser['UF_ROLE'];

		$curUserRoleQuery = CUserFieldEnum::GetList(array(), array("ID" => $curUserRoleId));
		$curUserRoleEnum = $curUserRoleQuery->Fetch();
		// SELLER BUYER
		$curUserRole = $curUserRoleEnum['XML_ID'];

		GLOBAL $profile_URL;
		if ($curUserRole == "SELLER") {
			$profile_URL = "/seller-account/";
		} elseif ($curUserRole == "BUYER") {
			$profile_URL = "/buyer-account/";
		} else {
			$profile_URL = "";
		}
		//var_dump($profile_URL)
?>

<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth_home", Array(
	"FORGOT_PASSWORD_URL" => "/user/",	// Страница забытого пароля
		"PROFILE_URL" => $profile_URL,	// Страница профиля
		"REGISTER_URL" => "/user/registration.php",	// Страница регистрации
		"SHOW_ERRORS" => "N",	// Показывать ошибки
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>