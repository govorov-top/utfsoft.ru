<?php
/**
 * Шаблон для отображения страниц
 *
 * Это шаблон, который отображает все страницы по умолчанию.
 * Обратите внимание, что это WordPress конструкция страниц и что
 * другие "страницы" на Вашем сайте WordPress будут использовать другой шаблон.
 * Template name: Контент в контейнере
 * Template post type: post, page
 * @package WordPress
 * @subpackage My_Theme
 * @since govorov.top 1.9.96
 */

get_header(); ?>

<main id="main" class="site-main page-container-full">

    <nav class="d-none" id="breadcrumbs" aria-label="breadcrumb"
         style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
        <div class="container">
			<?php if ( function_exists( 'rg_breadcrumbs' ) ) {
				rg_breadcrumbs();
			} ?>
        </div>
    </nav>

    <div class="container">
        <h1 class="strong pt-5 pb-3"><?php single_post_title(); ?></h1>
		<?php while ( have_posts() ):
			the_post();
			get_template_part( "template-parts/content-page", "single" );
		endwhile; ?>
    </div>
    <div>
		<?php if ( comments_open() ) {
			comments_template( "/comments.php" );
		} ?>
    </div>
</main>

<?php get_footer(); ?>
