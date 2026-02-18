<?php
/**
 * Шаблон для отображения страниц архива
 *
 * Используется для отображения страниц архивного типа, если запрос не совпадает ни с чем более конкретным.
 * Например, складывает страницы на основе даты, если нет date-page.php файла.
 *
 * Если вы хотите дополнительно настроить эти архивные представления, вы можете создать
 * новый файл шаблона для каждого из них. Например, tag.php (Архив тегов),
 * category.php (Категория архивы), author.php (авторские архивы) и др.
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since utfsoft.ru 1.9.96
 */

get_header(); ?>

<main id="main" class="site-main page-testimonials">

    <nav id="breadcrumbs" class="breadcrumb d-none" aria-label="breadcrumb"
         style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
        <div class="container">
            <?php if (function_exists('rgv_breadcrumbs')) {
                rgv_breadcrumbs();
            } ?>
        </div>
    </nav>

    <div class="container">
        <h1 class="py-5"><?php post_type_archive_title() ?></h1>
        <?php
        $wp_query = new WP_Query(array(
            'post_type' => 'testimonials',
            'paged' => get_query_var('paged') ?: 1
        ));

        while (have_posts()):
            the_post();
            get_template_part('template-parts/testimonial');
        endwhile;
        ?>
        <div class="d-flex flex-wrap justify-content-center mb-5">
            <?= get_the_posts_pagination() ?>
        </div>
        <?php
        wp_reset_query();
        ?>

    </div>
</main><!-- .site-main -->


<?php get_footer(); ?>
