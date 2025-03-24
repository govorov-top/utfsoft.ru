<div class="page-testimonials section rg-bg-box">
    <div class="container">
        <p class="pb-0 h2">Отзывы наших клиентов</p>
        <div class="swiper swiper-testimonials position-relative">
            <div class="swiper-wrapper">
				<?php
				$post_ID         = url_to_postid( $_SERVER['REQUEST_URI'] );
				$category_review = 'diadoc';
				if ( $post_ID == 220 ) {
					$category_review = '220-40';
				}
				if ( $post_ID == 7838 ) {
					$category_review = 'ep';
				}
				/*if ($post_ID == 107){
					$category_review = 'modul-1c';
				}*/
				// в массиве задаем все необходимые параметры
				$args = [
					'post__not_in'   => [ $post_ID ],
					'posts_per_page' => 5,
					'orderby'        => 'rand',
					'tax_query'      => [
						[
							'taxonomy' => 'mark',
							'field'    => 'slug',
							'terms'    => $category_review
						]
					]
				];
				// создаем новый объект
				$q = new WP_Query( $args );

				// проверяем, существуют ли посты по заданным параметрам (необязательно, но рекомендую)
				if ( $q->have_posts() ) :
					// затем запускаем цикл
					while ( $q->have_posts() ) : $q->the_post(); ?>
                        <article class="swiper-slide py-5">
                            <div class="testimonial mini rg-card shadow mx-auto" itemprop="review" itemscope
                                 itemtype="https://schema.org/Review">
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="item d-flex flex-column img justify-content-center ms-md-3 ms-xl-0 mt-3 mt-md-0 mx-auto overflow-hidden p-0">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'testimonial_photo_mini' );
										} else {
											echo '<img src="/wp-content/themes/govorov.top/assets/img/logotype.svg" alt="Фото статьи не найдено">';
										}
										?>
                                    </div>
                                    <div class="item" itemprop="itemReviewed">
										<?php
										$name     = get_field( 'testimonial_name' );
										$surname  = get_field( 'testimonial_surname' );
										$company  = get_field( 'testimonial_company' );
										$position = get_field( 'testimonial_position' );
										?>
                                        <div itemprop="reviewBody" class="text-start">
											<?php if ( $name || $surname ): ?>
                                                <p class="name"><?= $name . ' ' . $surname ?></p>
											<?php endif; ?>
											<?php if ( $position || $company ): ?>
                                                <p class="info-user text-start text-black-50">
													<?php if ( $position ): ?>
                                                        <span class="position"><?= $position ?></span>
													<?php endif; ?>
													<?php if ( $company ): ?>
                                                        <span class="company"><?= $company ?></span>
													<?php endif; ?>
                                                </p>
											<?php endif; ?>

                                            <div class="review">
												<?php the_excerpt(); ?>
                                            </div>
											<?php
											$category = get_the_terms( get_the_ID(), 'mark' );
											//ddd($category[0]);
											if ( $category[0] ):?>
                                                <p>Тема:
                                                    <a href="/<?= $category[0]->taxonomy ?>/<?= $category[0]->slug ?>/"><?= $category[0]->name ?></a>
                                                </p>
											<?php endif; ?>

                                        </div>
                                        <p class="mb-0 text-start">
                                            <a href="<?= the_permalink() ?>"
                                               class="btn btn_link btn_icon bi bi-arrow-rightd-inline-flex p-0">Подробнее

                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>
					<?php endwhile;
				endif;
				// восстанавливаем глобальную переменную $post
				wp_reset_postdata();
				?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <p class="mb-0 btn_center"><a href="/testimonials/" class="btn btn_link btn_icon bi bi-arrow-right">Больше
                отзывов</a></p>
    </div>
</div>