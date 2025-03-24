<?php
/**
 * Основной файл шаблона
 *
 * Это самый общий файл шаблона в теме WordPress
 * и один из двух необходимых файлов для темы (другой стиль style.css)
 * Он используется для отображения страницы, когда ничего более конкретного не соответствует запросу.
 * Например, он объединяет домашнюю страницу, когда нет home-page.php файла.
 *
 * @package WordPress
 * @subpackage RSTheme
 * @since RSTheme 1.0
 */

get_header(); ?>


    <main id="main" class="site-main">

        <nav id="breadcrumbs" class="breadcrumb d-none" aria-label="breadcrumb"
             style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
            <div class="container">
				<?php if ( function_exists( 'rg_breadcrumbs' ) ) {
					rg_breadcrumbs();
				} ?>
            </div>
        </nav>

        <section style="padding-top: 15px">
            <div class="container">
				<?php if ( have_posts() ) :
					?>
                    <div class="row">
                        <div class="col-md-8">
							<?php
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/blog-all', get_post_format() );
							endwhile;
							?>
                        </div>
                        <aside id="sidebar" class="col-md-4 right-sidebar">
							<?php if ( ! dynamic_sidebar() ) : ?>
							<?php endif; ?>
                        </aside>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mb-5">
						<?= get_the_posts_pagination() ?>
                    </div>
				<?php
				else : get_template_part( 'template-parts/content', 'none' );

				endif; ?>
            </div>
        </section>
    </main><!-- .site-main -->


<?php get_footer(); ?>