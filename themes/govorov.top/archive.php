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
 * @since govorov.top 1.9.96
 */

get_header(); ?>

<main id="main" class="site-main">
    <nav id="breadcrumbs" class="d-none" aria-label="breadcrumb"
         style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
        <div class="container">
			<?php if ( function_exists( 'rg_breadcrumbs' ) ) {
				rg_breadcrumbs();
			} ?>
        </div>
    </nav>

    <header class="page-header">
        <div class="container">
			<?php
			the_archive_title( '<h1>', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
        </div>
    </header>

    <div class="container">
        <div class="row">
			<?php if ( have_posts() ) : ?>

				<?php
				// Запуск цикла.
				while ( have_posts() ) : the_post();

					/*
					 * Включение шаблона содержимого для определенного формата.
					 * Если вы хотите переопределить это в дочерней теме, включите файл
					 * под названием "content" -___.php (где ___ - имя формата записи), который будет использоваться вместо него.
					 */
					get_template_part( 'template-parts/blog-all', get_post_format() );

					// Выход из цикла.
				endwhile;
			// Если нет содержимого, включите шаблон "Новостей пока нет!".
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
        </div>
        <div class="d-flex flex-wrap justify-content-center mb-5">
			<?= get_the_posts_pagination() ?>
        </div>
    </div>
</main><!-- .site-main -->


<?php get_footer(); ?>
