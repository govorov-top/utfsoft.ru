<?php
/**
 * A Simple Category Template
 */

get_header(); ?>

    <main id="main" class="site-main page-h1 page-actions">

        <nav id="breadcrumbs" class="breadcrumb d-none" aria-label="breadcrumb"
             style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
            <div class="container">
				<?php if ( function_exists( 'rgv_breadcrumbs' ) ) {
					rgv_breadcrumbs();
				} ?>
            </div>
        </nav>

        <div class="container">
            <h1 class="py-5"><?= single_cat_title() ?></h1>
        </div>

		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/category-actions-all', get_post_format() );
			endwhile;
			?>
            <div class="d-flex flex-wrap justify-content-center mb-5">
				<?= get_the_posts_pagination() ?>
            </div>
		<?php else : get_template_part( 'template-parts/content', 'none' ); endif; ?>
        <!--noindex-->
        <!--googleoff: all-->
        <div class="popup" data-max-width="582" id="connect_action">
            <div class="pop html">
                <p class="title h2">Контур.<span class="color-turquoise">Диадок</span></p>
                <p class="desc">Заполните форму и нажмите «Отправить»<br> Наш специалист свяжется с вами в ближайшее
                    время!</p>
				<?= do_shortcode( '[contact-form-7 id="92" title="Акции"]' ) ?>
            </div>
        </div>
        <!--googleon: all-->
        <!--/noindex-->
    </main><!-- .site-main -->
<?php get_footer(); ?>