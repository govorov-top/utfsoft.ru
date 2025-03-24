<?php
/**
 * Часть шаблона для отображения отзывов
 *
 * @package WordPress
 */
$q = new WP_Query( $args['args'] );
if ( $q->have_posts() ) : ?>
    <section class="page-<?= get_the_ID() ?> rg-testimonials-swiper">
        <div class="container">
            <h2 class="pb-4">
				<?php if ( ! empty( $args['params']['title'] ) ): echo $args['params']['title']; else: ?>
                    Отзывы наших клиентов
				<?php endif; ?>
            </h2>
            <div class="swiper swiper-testimonials position-relative">
                <div class="swiper-wrapper">
					<?php
					while ( $q->have_posts() ) : $q->the_post();
						get_template_part( "template-parts/testimonial", '', 'slider' );
					endwhile;
					wp_reset_postdata();
					?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <p class="mb-0 text-center">
                <a href="/testimonials/" class="btn">Больше отзывов</a>
            </p>
        </div>
    </section>
<?php
endif;
wp_reset_postdata();
?>