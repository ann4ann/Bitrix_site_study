<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>

<div class="site-section">
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-8 mb-5">

	<? if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE']))
		{
			ShowMessage($arResult['ERROR_MESSAGE']);
		}
	?>

	<!-- ВХОД НА САЙТ (пользователь не залогинен) -->
	<?if($arResult["FORM_TYPE"] == "login"):?>

		<form 
			name="system_auth_form<?=$arResult["RND"]?>" 
			method="post" 
			target="_top" 
			action="<?=$arResult["AUTH_URL"]?>"
			class="p-5 bg-white border"
		>
			
			<!-- теги для работы компонента -->
			<?if($arResult["BACKURL"] <> ''):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif?>
			<?foreach ($arResult["POST"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="AUTH" />


			<!-- инпуты формы входа на сайт -->
			<div class="row form-group">
				<div class="col-md-12 mb-3 mb-md-0">
					<label class="font-weight-bold" for="login"><?=GetMessage("AUTH_LOGIN")?></label>
					<input name="USER_LOGIN" value="" type="text" id="login" class="form-control" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
					<script>
						BX.ready(function() {
							var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
							if (loginCookie)
							{
								var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
								var loginInput = form.elements["USER_LOGIN"];
								loginInput.value = loginCookie;
							}
						});
					</script>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-12">
					<label class="font-weight-bold" for="password"><?=GetMessage("AUTH_PASSWORD")?></label>
					<input name="USER_PASSWORD" autocomplete="off" type="password" id="password" class="form-control" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
				</div>
			</div>

			<!-- Запомнить пользователя -->
			<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
				<div class="row form-group">
					<div class="col-md-12">
						<input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
						<label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label>
					</div>
				</div>
			<?endif?>

			<!-- Капча -->
			<?if ($arResult["CAPTCHA_CODE"]):?>
				<div class="row form-group">
					<div class="col-md-12">
						<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
						<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
						<input type="text" name="captcha_word" maxlength="50" value="" />
					</div>
				</div>
			<?endif?>

			<!-- Кнопка submit -->
			<input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" class="btn btn-primary  py-2 px-4 rounded-0"/>
			
			<!-- ссылка зарегистрироваться -->
			<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
				<div class="row form-group">
					<div class="col-md-12">
						<noindex><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex>
					</div>
				</div>
			<?endif?>
			
		</form>

	<!-- ИНФО О ВХОДЕ (пользователь залогинен) -->
	<? else: ?>
		<div class="p-5 bg-white border">
			<div class="row form-group">
				<div class="col-md-12 mb-3 mb-md-0">
				
					<!-- Инфо о пользователе -->
					<div>
						<h4><?=$arResult["USER_NAME"]?></h4>
						<p>[<?=$arResult["USER_LOGIN"]?>]</p>
						<p><a href="<?=$arResult["PROFILE_URL"]?>"
									title="<?=GetMessage("AUTH_PROFILE")?>">
									<?=GetMessage("AUTH_PROFILE")?>
								</a><p>
					</div>

					<!-- Кнопка "Выйти"-->
					<a class="btn btn-primary py-2 px-4 rounded-0"
						href="<?=$APPLICATION->GetCurPageParam("logout=yes&".bitrix_sessid_get(), array(
									"login",
									"logout",
									"register",
									"forgot_password",
									"change_password",
									))
									?>"
						>
							<?=GetMessage("AUTH_LOGOUT_BUTTON")?>
					</a>
				</div>
			</div>
		</div>

	<?endif?>

</div></div></div></div>