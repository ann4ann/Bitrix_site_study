<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use \Bitrix\Main\Localization\Loc as Lc; 
Lc::loadMessages(__FILE__);

// echo '<pre>';
// var_export($arResult['STAR_AGENTS']); // для разработки в конечном коде убрать
// echo '</pre>';
?>


<div class="site-section site-section-sm bg-light">
	<div class="container agents-list">

		<div class="row mb-5">
			<div class="col-12">
				<div class="site-section-title">
					<h2>Агенты по Недвижимости</h2>
				</div>
			</div>
		</div>

		<!-- Блок с агентами -->
		<div class="mb-5">
		<? foreach($arResult["AGENTS"]["ITEMS"] as $arItem): ?>

			<div class="agent__card">
				<div class="small-info">
						<div class="avatar" style="background-image: url(<?= $arItem['UF_PHOTO'] ?>);"></div>
						<div class="info">
								<div class="name">
									<?=$arItem['UF_FULLNAME'] ?>
								</div>
						</div>
				</div>
				<div class="agent__card_item">
						<div class="agent__card_info">
								<div class="card__info_item">
										<div class="position">Электронная почта: </div>
										<div class="name">
											<?= $arItem['UF_MAIL'] ?>
										</div>
								</div>
								<div class="card__info_item">
										<div class="position">Телефон: </div>
										<div class="name">
											<?= $arItem['UF_PHONE'] ?>
										</div>
								</div>
								<div class="card__info_item">
										<div class="position">Вид деятельности:</div>
										<div class="name">
											<?= $arItem['UF_TYPE_OF_ACTIVITY'] ?>
										</div>
								</div>
						</div>
				</div>
				<?php
					$isStarred = false;

					$starAgents = $arResult['STAR_AGENTS'];
					if ( $starAgents !== null && is_array($starAgents) )
					{
						// Проверка: есть ли Id агента в списке Избранного
						$isStarred = in_array($arItem['ID'], $starAgents, false);
					}

					// echo '<pre>';
					// var_export($arResult['STAR_AGENTS']);
					// echo '</pre>';

					// Если Агент в избранном, добавим класс Active
					$sAddClass = $isStarred ? 'active': '';
				?>
				<a class="star <?=$sAddClass?>" data-id=<?=$arItem['ID'];?>>
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 4L14.472 9.26604L20 10.1157L16 14.2124L16.944 20L12 17.266L7.056 20L8 14.2124L4 10.1157L9.528 9.26604L12 4Z" stroke="#95929A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
				</a>	
			</div>

		<? endforeach; ?>
		</div>

		<?php // Компонент bitrix:main.pagenavigation
			/*
			* Для постраничной навигации использовать компонент bitrix:main.pagenavigation
			*/
			$APPLICATION->IncludeComponent(
				"bitrix:main.pagenavigation",
				"agents_page_nav",
					array(
					"NAV_OBJECT" => $arResult['AGENTS']['NAV_OBJECT'],
					"SEF_MODE" => false,
					"SHOW_ALWAYS" => true,
				),
				false
			);
		?>
	</div>
</div>



