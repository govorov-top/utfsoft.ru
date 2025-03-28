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
            <div class="logo-text">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-1')) { ?><?php } ?>

            </div>
            <div class="copyright align-self-end">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-4')) { ?><?php } ?>

            </div>
            <div class="footer-menu">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-2')) { ?><?php } ?>
            </div>
            <div class="footer-contacts d-flex flex-column">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-3')) { ?><?php } ?>
            </div>
        </div>
    </div>
</footer>

<?php

wp_footer();
?>

</body>
</html>
