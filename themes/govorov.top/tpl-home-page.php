<?php
/**
 * Шаблон для отображения главной страници
 *
 * Это шаблон, который отображает все страницы по умолчанию.
 * Обратите внимание, что это WordPress конструкция страниц и что
 * другие "страницы" на Вашем сайте WordPress будут использовать другой шаблон.
 *
 * Template name: Главная страница
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since govorov.top 1.9.96
 */

get_header(); ?>

<main id="main" class="site-main">

    <?php
    // Запуск цикла.
    while ( have_posts() ) : the_post();

        // Включить шаблон содержимого страницы.
        get_template_part( 'template-parts/content-home', 'page' );

        // Если комментарии открыты или у нас есть хотя бы один комментарий, загрузите шаблон комментария.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }

        // Выход из цикла.
    endwhile;
    ?>
</main><!-- .site-main -->


<?php get_footer(); ?>
