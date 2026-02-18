<?php
/**
 * Шаблон для таксономии отзывов mark - они же метки
 */
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
    <main id="main" class="site-main page-testimonials">

        <nav id="breadcrumbs" class="breadcrumb d-none" aria-label="breadcrumb"
             style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
            <div class="container">
				<?php if ( function_exists( 'rg_breadcrumbs' ) ) {
					rg_breadcrumbs();
				} ?>
            </div>
        </nav>
        <div class="container">
            <h1 class="archive-title pb-5">Отзывы на тему: <br>
                <span><?= apply_filters( 'the_title', $term->name ) ?></span></h1>
        </div>
		<?php
		if ( have_posts() ): ?>
            <div class="container">
				<?php while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/testimonial' );
				endwhile; ?>
            </div>
            <div class="d-flex flex-wrap justify-content-center mb-5">
				<?= get_the_posts_pagination() ?>
            </div>
		<?php else: ?>
            <div class="container">
                <p class="h2">Пока тут пусто...</p>
            </div>
		<?php endif; ?>
    </main>

<?php get_footer(); ?>