<?php
/**
 * Шаблон для отображения 404 страниц (не найден)
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since utfsoft.ru 1.9.96
 */

get_header(); ?>
<main id="main" class="site-main page-404">
    <section class="error-404 pt-0 not-found">
        <div class="container">
            <div class="content rg-bg-box position-relative d-flex flex-column">
                <div class="wrapper d-flex flex-column flex-grow-1 mb-4 mb-sm-0">
                    <h1 class="pb-4">
                        Страница, которую вы пытаетесь <br class="d-none d-md-block"> просмотреть, не существует...
                    </h1>
                    <a href="/" class="btn btn_max-content mt-auto ">На главную</a>
                </div>

                <picture class="image">
                    <source media="(max-width:576.98px)"
                            srcset="/wp-content/themes/utfsoft.ru/assets/img/404/404-576.svg">
                    <source media="(max-width:767.98px)"
                            srcset="/wp-content/themes/utfsoft.ru/assets/img/404/404-768.svg">
                    <source media="(max-width:991.98px)"
                            srcset="/wp-content/themes/utfsoft.ru/assets/img/404/404-992.svg">
                    <source media="(max-width:1199.98px)"
                            srcset="/wp-content/themes/utfsoft.ru/assets/img/404/404-1200.svg">
                    <source media="(max-width:1399.98px)"
                            srcset="/wp-content/themes/utfsoft.ru/assets/img/404/404-1400.svg">
                    <img src="/wp-content/themes/utfsoft.ru/assets/img/404/404.svg" alt="404">
                </picture>
            </div>
        </div>
    </section><!-- .error-404 -->
</main><!-- .site-main -->

<?php get_footer(); ?>
