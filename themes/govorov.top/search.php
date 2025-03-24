<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since govorov.top 1.9.96
 */

get_header(); ?>

<main id="main" class="site-main page-search">
    <nav id="breadcrumbs" class="breadcrumb d-none" aria-label="breadcrumb"
         style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
        <div class="container">
			<?php if ( function_exists( 'rg_breadcrumbs' ) ) {
				rg_breadcrumbs();
			} ?>
        </div>
    </nav>
    <div class="container">
		<?php if ( have_posts() ) : ?>
            <h1>Результаты поиска: <span><?= esc_html( get_search_query() ) ?></span></h1>
            <div class="search-result">
				<?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID() ?>" class="mb-4 <?= join( ' ', get_post_class() ) ?>">
                        <h5 class="title pb-0 text-start"
                            itemprop="headline"><?php the_title( sprintf( '<a href="%s">', esc_url( get_permalink() ) ), '</a>' ); ?></h5>
						<?php if ( get_the_excerpt() ): ?>
                            <p class="desc mt-3 mb-0">
								<?= get_the_excerpt() ?>
                            </p>
						<?php endif; ?>
                        <p class="mb-0"><a href="<?= get_permalink() ?>"
                                           class="btn btn_link btn_icon bi bi-arrow-right">Перейти</a></p>
                    </article>
				<?php endwhile; ?>
            </div>
            <nav class="pagination d-flex flex-wrap justify-content-center">
				<?= paginate_links(
					array(
						'mid_size'  => 3,
						'end_size'  => 2,
						'prev_text' => '«',
						'next_text' => '»',
					)
				) ?>
            </nav>
		<?php else : ?>
            <h1>По вашему запросу <span><?= esc_html( get_search_query() ) ?></span> ничего не найдено...</h1>
			<?php echo get_search_form();
		endif;
		?>
    </div>
</main><!-- .site-main -->
<?php get_footer(); ?>
