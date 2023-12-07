<?
  use \Bitrix\Main\Localization\Loc as Lc; 
  Lc::loadMessages(__FILE__);
?>
    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="mb-5">
              <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                  "AREA_FILE_SHOW" => "file",
                  "AREA_FILE_SUFFIX" => "inc",
                  "EDIT_TEMPLATE" => "",
                  "PATH" => "/include/about.php"
                )
              );?>
            </div>
          </div>
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="row mb-5">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">
                  <?=Lc::getMessage("NAVIGATION")?>
                </h3>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="#"><?=Lc::getMessage("HOME")?></a></li>
                  <li><a href="#"><?=Lc::getMessage("BUY")?></a></li>
                  <li><a href="#"><?=Lc::getMessage("RENT")?></a></li>
                  <li><a href="#"><?=Lc::getMessage("PROPERTIES")?></a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="#"><?=Lc::getMessage("ABOUT US")?></a></li>
                  <li><a href="#"><?=Lc::getMessage("PRIVACY POLICY")?></a></li>
                  <li><a href="#"><?=Lc::getMessage("CONTACT US")?></a></li>
                  <li><a href="#"><?=Lc::getMessage("TERMS")?></a></li>
                </ul>
              </div>
            </div>
            <?$APPLICATION->IncludeComponent(
              "bitrix:menu",
              "horizontal_multilevel",
              Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "2",
                "MENU_CACHE_GET_VARS" => array(""),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "top",
                "USE_EXT" => "N"
              )
            );?>
          </div>
          <div class="col-lg-4 mb-5 mb-lg-0">
            <?$APPLICATION->IncludeComponent(
              "bitrix:main.include",
              "",
              Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/follow_us.php"
              )
            );?>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <?$APPLICATION->IncludeComponent(
              "bitrix:main.include",
              "",
              Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/copyright.php"
              )
            );?>
          </div>
        </div>
      </div>
    </footer>
    </div>
  </body>
</html>