<section class="page-home latter-news">
    <div class="container">
        <h2>Новости <span>СБИС</span></h2>
        <div class="position-relative">
            <div class="swiper swiper-latter-news" id="swiper-latter-news">
                <div class="swiper-wrapper">
					<?php
					global $post;
					$tmp_post = $post;
					$args     = [
						'numberposts' => 5,
						'orderby'     => 'date',
						'order'       => 'DESC',
						'post_type'   => 'post',
					];
					$my_posts = get_posts( $args );
					foreach ( $my_posts as $post ) {
						setup_postdata( $post );
						?>
                        <div class="swiper-slide">
                            <div class="post mb-0 rg-card shadow d-flex flex-wrap justify-content-between align-items-center">
                                <p class="title"><?php the_title(); ?></p>
                                <div class="text">
									<?php the_excerpt() ?>
                                </div>
                                <p class="mb-0">
                                    <a class="btn btn_link btn_icon bi bi-arrow-right" href="<?php the_permalink(); ?>"
                                       title="<?php the_title(); ?>">Подробнее</a>
                                </p>
                            </div>
                        </div>
						<?php
					}
					$post = $tmp_post;
					wp_reset_postdata();
					?>
                </div>

            </div>
            <div class="swiper-pagination swiper-latter-news-pagination"></div>
            <div class="swiper-button-prev swiper-latter-news-prev"></div>
            <div class="swiper-button-next swiper-latter-news-next"></div>
        </div>
    </div>
</section>