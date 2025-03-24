<?php
/**
 * Шаблон для отображения 404 страниц (не найден)
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since govorov.top 1.9.96
 */

get_header(); ?>
<main id="main" class="site-main">
    <section class="error-404 not-found">
        <div class="container">
            <h1 class="pb-0">Упс! Что-то пошло не так...</h1>
            <p style="font-size: 70px; text-align: center; margin: 100px 0">Ошибка 404</p>
            <div class="items btn_center d-flex flex-wrap justify-content-start align-items-center pb-4"
                 style="max-width: 425px">
                <div class="item me-3 mb-sm-3 mb-xl-0 mb-2">
                    <p class="mb-0"><a href="/" class="btn">Главная страница</a></p>
                </div>
                <div class="item">
                    <p class="mb-0"><a href="/o-sisteme/" class="btn btn_link btn_icon bi bi-arrow-right">О сервисе</a>
                    </p>
                </div>
            </div>
        </div>
    </section><!-- .error-404 -->
	<?= do_shortcode( '[rg-code f="repeat-elements/fast-connect-form.php"]' ) ?>
</main><!-- .site-main -->

<?php get_footer(); ?>
