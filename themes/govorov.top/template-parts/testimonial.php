<?php
/**
 * Шаблон для отображения Отзывов
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since R. S. production 1.0
 */
$isSlider = $args == 'slider';
$isSingle = $args == 'single';
?>
<article id="post-<?php the_ID(); ?>"
         class="<?= $isSlider ? 'swiper-slide' : 'mb-5 mb-xl-4' ?> rg-testimonial-card <?= join( ' ', get_post_class() ) ?>"
         itemprop="review" itemscope
         itemtype="https://schema.org/Review">
    <div class="rg-card shadow">
        <div class="row row-cols-2 m-0 gap-3 align-items-center">
            <div class="item img col rg-card p-0 overflow-hidden mx-auto">
				<?php
				if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'testimonial_photo_mini' );
				else: ?>
                    <img src="/wp-content/themes/govorov.top/assets/img/logotype.svg"
                         alt="Фото отзыва не найдено">
				<?php endif; ?>
            </div>
            <div class="item text col" itemprop="itemReviewed">
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
						<?php if ( $isSingle ) :
							the_content();
						else: ?>
                            <p>“<?= get_the_excerpt(); ?>“</p>
						<?php endif; ?>
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
                    <a href="<?= $isSingle ? '/testimonials/' : get_the_permalink() ?>"
                       class="btn btn_icon btn_link <?= $isSingle ? 'btn_link-revert' : '' ?> bi bi-arrow-right">
						<?= $isSingle ? 'Вернуться ко всем отзывам' : 'Подробнее' ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</article><!-- #post-## -->