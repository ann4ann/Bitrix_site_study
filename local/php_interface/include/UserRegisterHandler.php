<?

class UserRegister
{
	public static function AfterUserRegister(&$arFields)
	{
    $userId = $arFields["USER_ID"];

		// если регистрация успешна то
		if( $userId > 0 )
		{
      $curUser = CUser::GetByID($userId);

      // Получаем User Role в виде string XML_ID
      $dbResUser = $curUser->Fetch();
      $curUserRoleId = $dbResUser['UF_ROLE'];

      $curUserRoleQuery = CUserFieldEnum::GetList(array(), array("ID" => $curUserRoleId));
      $curUserRoleEnum = $curUserRoleQuery->Fetch();
      $curUserRole = $curUserRoleEnum['XML_ID'];
  
      $arGroups = CUser::GetUserGroup($userId);
      // Добавляем пользователя в группу в зав-ти от Роли
      if ($curUserRole == "SELLER") {
        $arGroups[] = 7;
        CUser::SetUserGroup($userId, $arGroups);
      }
      elseif ($curUserRole == "BUYER") {
        $arGroups[] = 6;
        CUser::SetUserGroup($userId, $arGroups);
      }
      else {}
    }
  } 
};

?>