<?php
/**
 * Шаблон для отображения нижнего колонтитула
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since govorov.top 1.9.96
 */
echo do_shortcode('[rg-code f="widgets/brief.php"]');
echo do_shortcode('[rg-code f="widgets/web-zvonok.php"]');
echo do_shortcode('[rg-code f="widgets/who-calling.php"]');
?>
<!--noindex-->
<!--googleoff: all-->
<div class='chat-buttons'>
    <div class="main-button"></div>
    <button class="floating-button" id="floatingButton">
        <img src="/wp-content/themes/govorov.top/assets/img/widgets/chat-buttons/vk-icon.svg" alt="Icon"
             class="button-icon">
    </button>
</div>
<div class="popup" data-max-width="480" id="popup_whatsapp_1">
    <div class="pop html bg-none shadow-none p-0">
        <a target="_blank"
           href="https://api.whatsapp.com/send?phone=74952258118&text=Добрый%20день!%20Я%20с%20сайта%20<?= $_SERVER['HTTP_HOST'] ?>.%20У%20меня%20вопрос%20...">
            <img class="w-auto" alt="Давайте начнём общение!"
                 src="/wp-content/themes/govorov.top/assets/img/widgets/whatsapp/go_wa.png">
        </a>
    </div>
</div>
<!--googleon: all-->
<!--/noindex-->
<footer class="footer" id="footer">
    <div class="container">
        <div class="widgets justify-content-md-around justify-content-between row">
            <div id="footer-widget-1" class="widget col-sm-8 col-lg-4 col-md-6 item order-0">
                <?php if (is_page('promo-2024')) : ?>
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-6')) { ?><?php } ?>
                <?php else: ?>
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-1')) { ?><?php } ?>
                <?php endif; ?>
            </div>
            <div id="footer-widget-2" class="widget col-sm-4 col-lg-2 col-md-3 item order-lg-1 order-md-3">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-2')) { ?><?php } ?>
            </div>
            <div id="footer-widget-3" class="widget col-lg-3 col-md-6 col-sm-4 foot-news item order-md-3">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-3')) { ?><?php } ?>
            </div>
            <div id="footer-widget-4" class="widget col-lg-3 col-md-6 col-sm-7 item order-3 order-md-2">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-4')) { ?><?php } ?>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div id="footer-widget-5" class="text-center">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-5')) { ?><?php } ?>
            </div>
        </div>
    </div>
</footer>

<?php

wp_footer();
$metricInfoUfa = (!empty($_COOKIE['utm_source']) && $_COOKIE['utm_source'] === '_ufa_yandex') ||
    (!empty($_GET['utm_source']) && $_GET['utm_source'] === '_ufa_yandex') ||
    !empty($_COOKIE['_ufa_yandex']) ||
    !empty($_GET['_ufa_yandex']);
?>
<noscript>
    <div>
        <img src="https://mc.yandex.ru/watch/3235447?ut=noindex" style="" alt="Счетчик Яндекс" />
        <?php if ($metricInfoUfa): ?>
            <img src="https://mc.yandex.ru/watch/88793084?ut=noindex" style="" alt="Счетчик Яндекс" />
        <?php endif; ?>
    </div>
</noscript>

</body>
</html>
