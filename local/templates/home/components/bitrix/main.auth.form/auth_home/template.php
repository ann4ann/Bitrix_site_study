<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

\Bitrix\Main\Page\Asset::getInstance()->addCss(
	'/bitrix/css/main/system.auth/flat/style.css'
);

if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_FORM_SUCCESS');
	return;
}
?>

<div class="site-section">
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-8 mb-5">

	<?if ($arResult['ERRORS']):?>
		<div class="alert alert-danger">
			<? foreach ($arResult['ERRORS'] as $error)
				{ echo $error; }
			?>
		</div>
	<?endif;?>

	<h3><?= Loc::getMessage('MAIN_AUTH_FORM_HEADER');?></h3>

	<?if ($arResult['AUTH_SERVICES']):?>
		<?$APPLICATION->IncludeComponent('bitrix:socserv.auth.form',
			'flat',
			array(
				'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
				'AUTH_URL' => $arResult['CURR_URI']
	   		),
			$component,
			array('HIDE_ICONS' => 'Y')
		);
		?>
	<?endif?>

	<form name="<?= $arResult['FORM_ID'];?>" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>" 
		class="p-5 bg-white border">
		
		<!-- Поле логин -->
		<div class="row form-group">
    	<div class="col-md-12 mb-3 mb-md-0">
				<!-- label -->
				<label class="font-weight-bold" for="fullname"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?></label>
				<!-- input -->
				<input 
					type="text" id="fullname" class="form-control" placeholder="Full Name" maxlength="255"
					name="<?= $arResult['FIELDS']['login'];?>"
					value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>"
				>
			</div>
		</div>

		<!-- Поле пароль -->
    <div class="row form-group">
			<div class="col-md-12 mb-3 mb-md-0">
				<!-- label -->
				<label class="font-weight-bold" for="pwd"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS');?></label>
				<!-- secure auth -->
				<?if ($arResult['SECURE_AUTH']):?>
					<div id="bx_auth_secure" style="display:none">
						<div><span></span>
						<?= Loc::getMessage('MAIN_AUTH_FORM_SECURE_NOTE');?>
					</div>
				</div>
				<script type="text/javascript">
					document.getElementById('bx_auth_secure').style.display = '';
				</script>
				<?endif?>
				<!-- input (in fact) -->
				<input type="password" id="pwd" class="form-control" placeholder="Password" maxlength="255" 
				name="<?= $arResult['FIELDS']['password'];?>" autocomplete="off" />
			</div>
    </div>

		<!-- Капча -->
		<?if ($arResult['CAPTCHA_CODE']):?>
			<input type="hidden" name="captcha_sid" value="<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" />
			<div class="row form-group">
				<div class="col-md-12 mb-3 mb-md-0">
					<label class="font-weight-bold">
						<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_CAPTCHA');?>
					</label>
					<div><img src="/bitrix/tools/captcha.php?captcha_sid=<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" width="180" height="40" alt="CAPTCHA" /></div>
					<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" class="form-control"/>
				</div>
			</div>
		<?endif;?>

		<!-- Чекбокс "Запомнить меня" -->
		<?if ($arResult['STORE_PASSWORD'] == 'Y'):?>
			<div class="row form-group">
				<div class="col-md-12 mb-3 mb-md-0">
					<label class="font-weight-bold">
						<input type="checkbox" id="USER_REMEMBER" name="<?= $arResult['FIELDS']['remember'];?>" value="Y" />
						<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_REMEMBER');?>
					</label>
					
				</div>
			</div>
		<?endif?>

		<!-- submit btn -->
		<div class="row form-group">
			<div class="col-md-12">
				<input type="submit" class="btn btn-primary  py-2 px-4 rounded-0" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUBMIT');?>" />
			</div>
		</div>
		
		<!-- 2 ссылки на страницы: "Забыли пароль" и "Регистрация" -->
		<?if ($arResult['AUTH_FORGOT_PASSWORD_URL'] || $arResult['AUTH_REGISTER_URL']):?>
			<hr>
			<noindex>

			<?if ($arResult['AUTH_FORGOT_PASSWORD_URL']):?>
				<div class="row form-group">
					<div class="col-md-12 mb-3 mb-md-0">
						<a href="<?= $arResult['AUTH_FORGOT_PASSWORD_URL'];?>" rel="nofollow">
							<?= Loc::getMessage('MAIN_AUTH_FORM_URL_FORGOT_PASSWORD');?>
						</a>
					</div>
				</div>
			<?endif;?>

			<?if ($arResult['AUTH_REGISTER_URL']):?>
				<div class="row form-group">
					<div class="col-md-12 mb-3 mb-md-0">
						<a href="<?= $arResult['AUTH_REGISTER_URL'];?>" rel="nofollow">
							<?= Loc::getMessage('MAIN_AUTH_FORM_URL_REGISTER_URL');?>
						</a>
					</div>
				</div>
			<?endif;?>

			</noindex>
		<?endif;?>

	</form>

</div>
</div>
</div>
</div>

<script type="text/javascript">
	<?if ($arResult['LAST_LOGIN'] != ''):?>
			try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
			try{document.<?= $arResult['FORM_ID'];?>.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>