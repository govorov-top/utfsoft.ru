<?php
/**
 * Шаблон для отображения страниц, которые находятся в стадии разработки
 *
 * Это шаблон, который отображает все страницы по умолчанию.
 * Обратите внимание, что это WordPress конструкция страниц и что
 * другие "страницы" на Вашем сайте WordPress будут использовать другой шаблон.
 *
 * Template name: В разработке
 * Template post type: post, page
 * @package WordPress
 * @subpackage My_Theme
 * @since utfsoft.ru 1.9.96
 */

get_header() ?>

<main id="main" class="site-main page-dev">

    <nav id="breadcrumbs" class="breadcrumb d-none" aria-label="breadcrumb"
         style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
        <div class="container">
            <?php if (function_exists('rgv_breadcrumbs')) {
                rgv_breadcrumbs();
            } ?>
        </div>
    </nav>
    <div class="container pb-5">
        <h1 class="py-5 m-0 text-center"><?php single_post_title(); ?></h1>
    </div>
    <!--noindex-->
    <!--googleoff: all-->
    <section class="section_1 pt-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <img src="/wp-content/themes/utfsoft.ru/assets/img/page-dev.svg"
                         alt="Данная страница находится на стадии разработки">
                </div>
                <div class="col-md-5">
                    <h2 class="text-start pb-0">Страница в разработке...</h2>
                    <div class="desc my-4">
                        <p class="fs-5">В скором времени мы выложим данную страницу в полном виде!</p>
                        <p class="fs-5">Консультация по данному разделу уже доступна, вы можете отправить заявку с
                            вопросом нажав на кнопку ниже.</p>
                    </div>
                    <button class="btn popClick" data-pop="dev-form">Получить консультацию</button>
                    <!--noindex-->
                    <!--googleoff: all-->

                    <div class="popup" data-max-width="582" id="dev-form">
                        <div class="pop html">
                            <p class="title">Контур.<span>Диадок</span></p>
                            <p class="desc">Заполните форму и нажмите «Отправить»<br> Наш специалист свяжется с вами в
                                ближайшее время!</p>
                            <?= do_shortcode('[contact-form-7 id="6b6b94f" title="Форма на странице с шаблоном В РАЗРАБОТКЕ"]') ?>
                        </div>
                    </div>
                    <!--googleon: all-->
                    <!--/noindex-->
                </div>
            </div>
        </div>
    </section>
    <!--googleon: all-->
    <!--/noindex-->
    <?php
    /*while ( have_posts() ) : the_post();
        get_template_part( 'template-parts/content-page', 'single' );
    endwhile;*/
    ?>

</main>

<?php get_footer(); ?>
