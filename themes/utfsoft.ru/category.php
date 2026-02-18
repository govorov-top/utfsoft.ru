<?php
/**
 * A Simple Category Template
 */

get_header(); ?>

    <main id="main" class="site-main page-news">

        <nav id="breadcrumbs" class="d-none" aria-label="breadcrumb"
             style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
            <div class="container">
				<?php if ( function_exists( 'rg_breadcrumbs' ) ) {
					rg_breadcrumbs();
				} ?>
            </div>
        </nav>

        <section class="container mini py-5">
            <h1 class="py-0 pb-5"><?= single_cat_title() ?></h1>
			<?php if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/blog-all', get_post_format() );
				endwhile;
				?>
                <div class="d-flex flex-wrap justify-content-center mb-5">
					<?= get_the_posts_pagination() ?>
                </div>
			<?php
			else : get_template_part( 'template-parts/content', 'none' );
			endif; ?>
        </section>
    </main><!-- .site-main -->

<?php get_footer(); ?>