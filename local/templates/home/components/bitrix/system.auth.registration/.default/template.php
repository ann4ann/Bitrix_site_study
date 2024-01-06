<?
	/**
	 * Bitrix Framework
	 * @package bitrix
	 * @subpackage main
	 * @copyright 2001-2014 Bitrix
	 */

	/**
	 * Bitrix vars
	 * @global CMain $APPLICATION
	 * @var array $arParams
	 * @var array $arResult
	 * @var CBitrixComponentTemplate $this
	 */

	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	if($arResult["SHOW_SMS_FIELD"] == true)
	{
		CJSCore::Init('phone_auth');
	}
?>

<div class="site-section">
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-8 mb-5">

<? if (!empty($arParams["~AUTH_RESULT"]))
	{
		ShowMessage($arParams["~AUTH_RESULT"]);
	}
?>

<?if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
	<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?endif;?>

<?if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>

<noindex>
	<?if($arResult["SHOW_SMS_FIELD"] == true):?>

		<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="regform">
			<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
			<table class="data-table bx-registration-table">
				<tbody>
					<tr>
						<td><span class="starrequired">*</span><?echo GetMessage("main_register_sms_code")?></td>
						<td><input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" /></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td><input type="submit" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" /></td>
					</tr>
				</tfoot>
			</table>
		</form>

		<script>
			new BX.PhoneAuth({
				containerId: 'bx_register_resend',
				errorContainerId: 'bx_register_error',
				interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
				data:
					<?=CUtil::PhpToJSObject([
						'signedData' => $arResult["SIGNED_DATA"],
					])?>,
				onError:
					function(response)
					{
						var errorDiv = BX('bx_register_error');
						var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
						errorNode.innerHTML = '';
						for(var i = 0; i < response.errors.length; i++)
						{
							errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
						}
						errorDiv.style.display = '';
					}
			});
		</script>

		<div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

		<div id="bx_register_resend"></div>

	<?elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>

		<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="REGISTRATION" />

			<h3><?=GetMessage("AUTH_REGISTER")?></h3>

			<div class="row form-group"><!-- Имя юзера -->
				<div class="col-md-12 mb-3 mb-md-0">
					<label class="font-weight-bold" for="name"><?=GetMessage("AUTH_NAME")?></label>
					<input type="text" name="USER_NAME" maxlength="50" 
						value="<?=$arResult["USER_NAME"]?>"
						class="form-control"
						id="name"  />
				</div>
			</div>
			<div class="row form-group"><!-- Фамилия юзера -->
				<div class="col-md-12 mb-3 mb-md-0">
					<label class="font-weight-bold" for="lname"><?=GetMessage("AUTH_LAST_NAME")?></label>
					<input type="text" name="USER_LAST_NAME" maxlength="50" 
						value="<?=$arResult["USER_LAST_NAME"]?>"
						class="form-control"
						id="lname"  />
				</div>
			</div>

			<div class="row form-group"><!-- Логин юзера -->
				<div class="col-md-12 mb-3 mb-md-0">
					<span>*</span>
					<label class="font-weight-bold" for="login"><?=GetMessage("AUTH_LOGIN_MIN")?></label>
					<input type="text" name="USER_LOGIN" maxlength="50" 
						value="<?=$arResult["USER_LOGIN"]?>"
						class="form-control"
						id="login"  />
				</div>
			</div>
			<div class="row form-group"><!-- Пароль юзера -->
				<div class="col-md-12 mb-3 mb-md-0">
					<span>*</span>
					<label class="font-weight-bold" for="pwd"><?=GetMessage("AUTH_PASSWORD_REQ")?></label>
					<input type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off"
						value="<?=$arResult["USER_PASSWORD"]?>" 
						class="form-control"
						id="pwd"  />

					<?if($arResult["SECURE_AUTH"]):?>
						<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
							<div class="bx-auth-secure-icon"></div>
						</span>

						<noscript>
							<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
								<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
							</span>
						</noscript>
						
						<script type="text/javascript">
							document.getElementById('bx_auth_secure').style.display = 'inline-block';
						</script>
					<?endif?>
				</div>
			</div>

			<div class="row form-group"><!-- Подтверждение пароля юзера -->
				<div class="col-md-12 mb-3 mb-md-0">
					<span>*</span>
					<label class="font-weight-bold" for="pwd_conf"><?=GetMessage("AUTH_CONFIRM")?></label>
					<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" autocomplete="off"
						value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" 
						class="form-control"
						id="pwd_conf"  />
				</div>
			</div>

			<?if($arResult["EMAIL_REGISTRATION"]):?> <!-- mail registr -->
				<div class="row form-group"><!-- Мейл -->
						<div class="col-md-12 mb-3 mb-md-0">
							<?if($arResult["EMAIL_REQUIRED"]):?>
								<span>*</span>
							<?endif?>
							<label class="font-weight-bold" for="mail"><?=GetMessage("AUTH_EMAIL")?></label>
							<input type="text" name="USER_EMAIL" maxlength="255"
								value="<?=$arResult["USER_EMAIL"]?>"
								class="form-control"
								id="mail"  />
						</div>
					</div>	
			<?endif?>

			<?if($arResult["PHONE_REGISTRATION"]):?> <!-- phone register -->
				<div class="row form-group">
					<div class="col-md-12 mb-3 mb-md-0">
							<?if($arResult["PHONE_REQUIRED"]):?>
								<span>*</span>
							<?endif?>
							<label class="font-weight-bold" for="phone_reg"><?=GetMessage("main_register_phone_number")?></label>
							<input type="text" name="USER_PHONE_NUMBER" maxlength="255" 
								value="<?=$arResult["USER_PHONE_NUMBER"]?>" 
								class="form-control" 
								id="phone_reg"/>
					</div>
				</div>	
			<?endif?>

			<!--  User properties -->
			<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
				<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $arUserField):?>
					<div class="row form-group">
						<div class="col-md-12 mb-3 mb-md-0">
							<?if ($arUserField["MANDATORY"]=="Y"):?>
								<span>*</span>
							<?endif;?>
							<label class="font-weight-bold" for="phone_reg"><?=$arUserField["EDIT_FORM_LABEL"]?>:</label>

							<?$APPLICATION->IncludeComponent(
								"bitrix:system.field.edit",
								$arUserField["USER_TYPE"]["USER_TYPE_ID"],
								array(
									"bVarsFromForm" => $arResult["bVarsFromForm"],
									"arUserField" => $arUserField,
									"form_name" => "bform"),
								null, array("HIDE_ICONS"=>"Y"));?>
						</div>
					</div>
				<?endforeach;?>
			<?endif;?>

			<!--  Capcha -->
			<?if ($arResult["USE_CAPTCHA"] == "Y"):?>
				<!--  Лейбл -->
				<div class="row form-group">
					<div class="col-md-12">
						<label class="font-weight-bold" for="captha"><?=GetMessage("CAPTCHA_REGF_TITLE")?></label>
					</div>					
				</div>

				<!--  Картинка капчи -->
				<div class="row form-group">
					<div class="col-md-12">
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
					</div>					
				</div>

				<!--  Поле для ввода капчи -->
				<div class="row form-group">
					<div class="col-md-12">
						<span class="starrequired">*</span>
						<label class="font-weight-bold" for="captha"><?=GetMessage("CAPTCHA_REGF_PROMT")?>:</label>
						<input type="text" name="captcha_word" maxlength="255" autocomplete="off"
							class="form-control"
							id="captha"  />
					</div>					
				</div>
			<?endif;?>

			<!--  User consent компонент -->
			<div class="row form-group">
				<div class="col-md-12">
					<?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
						array(
							"ID" => COption::getOptionString("main", "new_user_agreement", ""),
							"IS_CHECKED" => "Y",
							"AUTO_SAVE" => "N",
							"IS_LOADED" => "Y",
							"ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
							"ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
							"INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
							"REPLACE" => array(
								"button_caption" => GetMessage("AUTH_REGISTER"),
								"fields" => array(
									rtrim(GetMessage("AUTH_NAME"), ":"),
									rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
									rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
									rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
									rtrim(GetMessage("AUTH_EMAIL"), ":"),
								)
							),
						)
					);?>
				</div>					
			</div>

			<!--  Кнопка Сабмит "Регистрация"  -->
			<div class="row form-group">
				<div class="col-md-12">
						<input  class="btn btn-primary  py-2 px-4 rounded-0"
							type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" />
				</div>					
			</div>

		</form>

		<!--  Доп информация - просто текст -->
		<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
		<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

		<script type="text/javascript">
			document.bform.USER_NAME.focus();
		</script>

	<?endif?>
</noindex>

</div></div></div></div>