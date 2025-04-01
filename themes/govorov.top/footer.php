<?php
/**
 * Шаблон для отображения нижнего колонтитула
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since govorov.top 1.9.96
 */

?>
<footer class="footer " id="footer">
    <div class="container">
        <div class="footer-content border-top grid justify-content-between">
            <div class="logo-text mb-3 mb-md-4 mb-lg-0 flex-column flex-sm-row d-flex d-lg-block">
                <img src="/wp-content/themes/govorov.top/assets/img/logotypes/main_logo.svg" alt="ЮТФ Софт"
                     class="footer-logo w-auto mb-lg-3 mb-lg-4 d-block">
                <p class="mb-0">Комплекс мер, направленных на защиту данных от несанкционированного доступа, изменения,
                    утечки или уничтожения</p>

            </div>
            <div class="copyright align-self-end mt-4 mt-md-3 mt-lg-0">
                <p class="mb-0">
                    <i class="bi bi-c-circle"></i> Все права защищены <span id="data-year-site"></span>
                </p>
                <script>document.getElementById('data-year-site').innerText = new Date().getFullYear();</script>

            </div>
            <div class="footer-menu mb-4 mb-sm-0">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-2')) { ?><?php } ?>
            </div>
            <div class="footer-contacts d-flex flex-column">
                <p class="widget-title">Контакты</p>
                <div class="footer-contacts-wrapper d-flex flex-column">
                    <p class="mb-0">127473, г Москва, ул. Селезневская <br> 11А / стр. 2, пом. 2/3</p>
                    <p class="mb-0"><a href="tel:99999999999">9 999 999 99 99</a></p>
                    <p class="mb-0"><a href="mailto:Pochta@pochta.ru">Pochta@pochta.ru</a></p>
                    <p class="mb-0">9.00-19.00</p>
                    <p class="mb-0">Работаем по всей России</p>

                </div>
            </div>
        </div>
    </div>
</footer>

<?php

wp_footer();
?>

</body>
</html>
