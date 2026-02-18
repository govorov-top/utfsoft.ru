<?php
/**
 * Шаблон для отображения нижнего колонтитула
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since utfsoft.ru 1.9.96
 */

?>
<footer class="footer " id="footer">
    <div class="container">
        <div class="footer-content border-top d-flex justify-content-between flex-column flex-lg-row gap-4 gap-lg-0">
            <div class="logo-menu">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-1')) { ?><?php } ?>
            </div>
            <div class="footer-wrapper grid">
                <div class="footer-menu-1 footer-menu">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-2')) { ?><?php } ?>
                </div>
                <div class="footer-menu-2 footer-menu">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-3')) { ?><?php } ?>
                </div>
                <div class="footer-menu-3 footer-menu">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-4')) { ?><?php } ?>
                </div>
                <div class="footer-contacts">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-6')) { ?><?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright d-flex align-items-center justify-content-center">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-5')) { ?><?php } ?>
    </div>
</footer>

<?php

wp_footer();
?>

</body>
</html>
