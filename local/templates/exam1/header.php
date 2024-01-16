<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
  // Найти где это в документации
  use \Bitrix\Main\Localization\Loc as Lc; 
  Lc::loadMessages(__FILE__);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <?$APPLICATION->ShowHead();?>
  <title><?$APPLICATION->ShowTitle()?></title>

  <? 
    // <meta http-equiv="X-UA-Compatible" content="IE=edge">
    // <meta charset="utf-8" />
    // <meta name="viewport" content="width=device-width, initial-scale=1.0">

    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/reset.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/style.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/owl.carousel.css");

    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/owl.carousel.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/scripts.js");

    $curHour = date("H", time());

  ?>

    <link rel="icon" type="image/vnd.microsoft.icon" href="<?=$SITE_TEMPLATE_PATH?>/img/favicon.ico">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?=$SITE_TEMPLATE_PATH?>/img/favicon.ico">

</head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

  <!-- wrap -->
  <div class="wrap">
    <!-- Поиск, контакты, вход/регистрация -->
    <header class="header">
        <div class="inner-wrap">
            <div class="logo-block">
              <a href="" class="logo">Мебельный магазин</a>
            </div>
            <div class="main-phone-block">
              <? if ($curHour >= "9" && $curHour <= "18"): ?>
                <a href="tel:84952128506" class="phone">8 (495) 212-85-06</a>
              <? else: ?>
                <a href="mailto:store@store.ru" class="phone">store@store.ru</a>
              <? endif ?>
              <div class="shedule">время работы с 9-00 до 18-00</div>
            </div>
            <div class="actions-block">
                <form action="/" class="main-frm-search">
                    <input type="text" placeholder="Поиск">
                    <button type="submit"></button>
                </form>
                <?$APPLICATION->IncludeComponent(
                  "bitrix:system.auth.form",
                  "demo",
                  Array(
                    "FORGOT_PASSWORD_URL" => "https://" . SITE_SERVER_NAME . "/login/?forgot_password=yes",
                    "PROFILE_URL" => "https://" . SITE_SERVER_NAME . "/login/user.php",
                    "REGISTER_URL" => "https://" . SITE_SERVER_NAME . "/login/?register=yes",
                    "SHOW_ERRORS" => "N",
                    "AUTH_SERVICES" => "Y",
                  )
                );?>
            </div>
        </div>
    </header>
    <!-- /Поиск, контакты, вход/регистрация -->

    <!-- Верхнее меню / nav  -->
    <nav class="nav">
      <div class="inner-wrap">
        <?$APPLICATION->IncludeComponent(
          "bitrix:menu", 
          "top_menu_ex1", 
          array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "3",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "top",
            "USE_EXT" => "Y",
            "COMPONENT_TEMPLATE" => "top_menu_ex1"
          ),
          false
        );?>
      </div>
    </nav>
    <!-- /Верхнее меню -->

    <!-- Навигация под верхним меню - Breadcrumbs  -->
    <? if ($APPLICATION->GetCurDir() != "/s2/"): ?>

      <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs_ex1", Array(
        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
          "SITE_ID" => "s2",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
          "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
        ),
        false
      );?>

      <!-- / Навигация под верхним меню - Breadcrumbs -->

    <? endif ?>

    <!-- Внутри page: левое меню (side) и центр (content) -->
    <div class="page">
      <div class="content-box">
        <!-- content -->
        <div class="content">
          <div class="cnt">

            <!-- на НЕ главной странице -->
            <? if ($APPLICATION->GetCurDir() != "/s2/"): ?>
            
              <header>
                  <h1><? $APPLICATION->ShowTitle(false) ?></h1>
              </header>
              <hr>

            <!-- на главной странице -->
            <? else: ?>

              <p>«Мебельная компания» осуществляет производство мебели на высококлассном оборудовании с применением минимальной доли ручного труда, что позволяет обеспечить высокое качество нашей продукции. Налажен производственный процесс как массового и индивидуального характера, что с одной стороны позволяет обеспечить постоянную номенклатуру изделий и индивидуальный подход – с другой.
              </p>
              <!-- Новинки и новости (2 колонки в одной строке) / index column -->
              <div class="cnt-section index-column">
                <div class="col-wrap">
                  <!-- Новинки - список / main actions box -->
                  <div class="column main-actions-box">
                    <div class="title-block">
                      <h2>Новинки</h2>
                      <hr>
                    </div>
                    <div class="items-wrap">
                      <div class="item-wrap">
                        <div class="item">
                          <div class="title-block att">
                            Угловой диван!
                          </div>
                          <br>
                          <div class="inner-block">
                            <a href="" class="photo-block">
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/new01.jpg" alt="" />
                            </a>
                            <div class="text"><a href="">Угловой диван "Титаник",  с большим выбором расцветок и фактур.</a>
                              <a href="" class="btn-arr"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="item-wrap">
                        <div class="item">
                          <div class="title-block att">
                            Угловой диван!
                          </div>
                          <br>
                          <div class="inner-block">
                            <a href="" class="photo-block">
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/new02.jpg" alt="" />
                            </a>
                            <div class="text"><a href="">Угловой диван "Титаник",  с большим выбором расцветок и фактур.</a>
                              <a href="" class="btn-arr"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="item-wrap">
                        <div class="item">
                          <div class="title-block att">
                            Угловой диван!
                          </div>
                          <br>
                          <div class="inner-block">
                            <a href="" class="photo-block">
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/new03.jpg" alt="" />
                            </a>
                            <div class="text"><a href="">Угловой диван "Титаник",  с большим выбором расцветок и фактур.</a>
                              <a href="" class="btn-arr"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="" class="btn-next">Все новинки</a>
                  </div>
                  <!-- /Новинки - список / main actions box -->

                  <!-- Новости - список / main news box -->
                  <div class="column main-news-box">
                    <div class="title-block">
                      <h2>Новости</h2>
                    </div>
                    <hr>
                    <div class="items-wrap">
                      <div class="item-wrap">
                        <div class="item">
                          <div class="title"><a href="">29 августа 2012</a>
                          </div>
                          <div class="text"><a href="">Поступление лучших офисных кресел из Германии </a>
                          </div>
                        </div>
                      </div>
                      <div class="item-wrap">
                        <div class="item">
                          <div class="title"><a href="">29 августа 2012</a>
                          </div>
                          <div class="text"><a href="">Мастер-класс дизайнеров  из Италии для производителей мебели </a>
                          </div>
                        </div>
                      </div>
                      <div class="item-wrap">
                        <div class="item">
                          <div class="title"><a href="">29 августа 2012</a>
                          </div>
                          <div class="text"><a href="">Поступление лучших офисных кресел из Германии </a>
                          </div>
                        </div>
                      </div>
                      <div class="item-wrap">
                        <div class="item">
                          <div class="title"><a href="">29 августа 2012</a>
                          </div>
                          <div class="text"><a href="">Наша дилерская сеть расширилась теперь ассортимент наших товаров доступен в Казани </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="" class="btn-next">Все новости</a>
                  </div>
                  <!-- /Новости - список / main news box -->
                </div>
              </div>
              <!-- /Новинки и новости (2 колонки в одной строке) / index column -->


              <!-- Мероприятия / afisha box -->
              <div class="cnt-section afisha-box">
                <div class="section-title-block">
                  <h2 class="second-ttile">Ближайшие мероприятия</h2>
                  <a href="" class="btn-next">все мероприятия</a>
                </div>
                <hr>
                <div class="items-wrap">
                  <div class="item-wrap">
                    <div class="item">
                      <div class="title"><a href="">29 августа 2012, Москва</a>
                      </div>
                      <div class="text"><a href="">Семинар производителей мебели России и СНГ, Обсуждение тенденций.</a>
                      </div>
                    </div>
                  </div>
                  <div class="item-wrap">
                    <div class="item">
                      <div class="title"><a href="">29 августа 2012, Москва</a>
                      </div>
                      <div class="text"><a href="">Открытие шоу-рума на Невском проспекте. Последние модели в большом ассортименте.</a>
                      </div>
                    </div>
                  </div>
                  <div class="item-wrap">
                    <div class="item">
                      <div class="title"><a href="">29 августа 2012, Москва</a>
                      </div>
                      <div class="text"><a href="">Открытие нового магазина в нашей  дилерской сети.</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Мероприятия / afisha box -->

            <? endif ?>




<!-- ---------------------------------------------------------------------  -->
<?php /*
  <div id="panel"><?$APPLICATION->ShowPanel();?></div>

    <div class="site-loader"></div>
    <div class="site-wrap">
      <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>
      <!-- .site-mobile-menu -->

      <div class="border-bottom bg-white top-bar">

        <div class="container">
          <div class="row align-items-center">
            <div class="col-6 col-md-6">
              <p class="mb-0">
                <?$APPLICATION->IncludeComponent(
                  "bitrix:main.include",
                  "",
                  Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/phone.php"
                  )
                );?>
                <?$APPLICATION->IncludeComponent(
                  "bitrix:main.include",
                  "",
                  Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/email.php"
                  )
                );?>
              </p>
            </div>

            <div class="col-6 col-md-6 text-right">
              <!-- Войти/выйти -->
              <? if ($USER->IsAuthorized()):?>
                <a href="<?=$APPLICATION->GetCurPageParam("logout=yes&".bitrix_sessid_get(), array(
                        "login",
                        "logout",
                        "register",
                        "forgot_password",
                        "change_password",
                        ))
                        ?>"
                  >Выйти</a>
              <? else: ?>
                <a href="<?SITE_TEMPLATE_PATH?>/user/login.php">Войти</a>
              <?endif?>
              
              <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" => "/include/socials.php"
                )
              );?>
            </div>
          </div>
        </div>
      </div>

      <div class="site-navbar">
        <div class="container py-1">
          <div class="row align-items-center">
            <div class="col-8 col-md-8 col-lg-4">
              <h1 class="">
                <?$APPLICATION->IncludeComponent(
                  "bitrix:main.include",
                  "",
                  Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/logo.php"
                  )
                );?>
              </h1>
            </div>
            <div class="col-4 col-md-4 col-lg-8">
              <?$APPLICATION->IncludeComponent(
                "bitrix:menu", 
                "top_horisontal_menu", 
                array(
                  "ALLOW_MULTI_SELECT" => "N",
                  "CHILD_MENU_TYPE" => "left",
                  "DELAY" => "N",
                  "MAX_LEVEL" => "3",
                  "MENU_CACHE_GET_VARS" => array(
                  ),
                  "MENU_CACHE_TIME" => "3600",
                  "MENU_CACHE_TYPE" => "N",
                  "MENU_CACHE_USE_GROUPS" => "Y",
                  "ROOT_MENU_TYPE" => "top",
                  "USE_EXT" => "N",
                  "COMPONENT_TEMPLATE" => "top_horisontal_menu"
                ),
                false
              );?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- breadcrumbs -->
    <?
      $current_link  = $APPLICATION->GetCurPage(true)
    ?>
    <?if ($current_link != "/index.php"):?>

      <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", Array(
          "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
          "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
          "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
        ),
        false
      );?>

    <?endif?>

    */
    ?>