<div class="rg-carousel-actions section">
    <div class="container">
        <div class="title-desc">
            <p class="h2">Наши акционные предложения</p>
        </div>
        <div class="swiper swiper-actions position-relative">
            <div class="swiper-wrapper">
				<?php
				$post_ID = url_to_postid( $_SERVER['REQUEST_URI'] );
				// в массиве задаем все необходимые параметры
				$args = array(
					'post__not_in' => [ $post_ID ],
					'tax_query'    => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => 'actions'
						)
					)
				);
				// создаем новый объект
				$q = new WP_Query( $args );

				// проверяем, существуют ли посты по заданным параметрам (необязательно, но рекомендую)
				if ( $q->have_posts() ) :
					// затем запускаем цикл
					while ( $q->have_posts() ) : $q->the_post(); ?>
                        <div class="swiper-slide box_style_2 py-5">
                            <div class="action-box bg rg-card shadow d-flex mx-auto">
                                <div class="row align-items-center text-center text-xl-start">
									<?php if ( has_post_thumbnail() ) : ?>
                                        <div class="col-xl-4 test col-xxl-5 ">
											<?php the_post_thumbnail( 'category-actions' ); ?>
                                        </div>
									<?php endif; ?>

                                    <div class="col-xl-8 col-xxl-7">
                                        <p class="title h5 my-xl-0 my-3 text-center text-xl-start color-white pb-3"><?= get_the_title() === 'Отправка документов с помощью Диадока на 25% дешевле!' ? 'Отправка документов с нашей системой стала выгодней на 25%!' : get_the_title() ?></p>
                                        <p class="mb-0"><a href="<?= get_permalink() ?>" class="btn btn_yellow">Подробнее</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php endwhile;
				endif;
				// восстанавливаем глобальную переменную $post
				wp_reset_postdata();
				?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>