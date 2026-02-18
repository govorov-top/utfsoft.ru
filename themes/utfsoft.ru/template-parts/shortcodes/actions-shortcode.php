<?php
/**
 * Часть шаблона для отображения записей на странице рубрики Акции
 *
 * @package WordPress
 */
?>

<div class="post-<?= $post->ID ?> tpl-action row bg-blue-light shadow shadow_box position-relative overflow-hidden m-0">
    <div class="text col-xl-7 col-lg-8">
        <p class="mini-desc strong_medium px-1 pb-0 mb-0">Акция</p>

		<?php
		// Выводим заголовок
		$tag = $args['title'];
		echo '<' . $tag . ' class="tpl-action_title h1 py-sm-4">' . get_the_title() . '</' . $tag . '>';
		?>
        <p class="excerpt desc rg-font-24-regular mb-4"><?= ! empty( $args['desc'] ) ? $args['desc'] : get_the_excerpt() ?>
            <span class="color-red">*</span></p>
        <div class="button-items nav mb-3">
			<?php
			$product = $args['product'];
			?>
            <button data-product="<?= $product ?: 'markirovka' ?>" class="btn popClick me-3"
                    data-pop="tpl-action-popup_<?= $post->ID ?>" data-title="<?= get_the_title() ?>">Отправить заявку
            </button>
			<?php
			// Если страница акции
			if ( is_single( $post->ID ) ): ?>
                <button class="btn btn_icon btn_icon_white btn_white btn_white_blue" data-scroll-beacon="action-detail">
                    Подробнее
                </button>
			<?php else: ?>
                <p class="mb-0">
                    <a class="btn btn_icon btn_icon_white btn_white btn_white_blue" href="<?= get_permalink() ?>">Подробнее</a>
                </p>
			<?php endif; ?>
        </div>
        <p class="desc-period color-light-grey mb-0"><span class="color-red">*</span> - Акция действует до 31 декабря
            2022 года для действующих клиентов</p>
    </div>
    <picture class="picture">
        <source media="(max-width: 767.98px)"
                srcset="<?= get_the_post_thumbnail_url( $post->ID, 'category-actions-768' ) ?>"/>
        <source media="(max-width: 991.98px)"
                srcset="<?= get_the_post_thumbnail_url( $post->ID, 'category-actions-992' ) ?>"/>
        <source media="(max-width: 1199.98px)"
                srcset="<?= get_the_post_thumbnail_url( $post->ID, 'category-actions-1200' ) ?>"/>
        <source media="(max-width: 1399.98px)"
                srcset="<?= get_the_post_thumbnail_url( $post->ID, 'category-actions-1400' ) ?>"/>
        <img class="w-auto position-absolute" src="<?= get_the_post_thumbnail_url( $post->ID, 'category-actions' ) ?>"
             alt="Контур.Маркировка">
    </picture>

</div>

<!--noindex-->
<!--googleoff: all-->
<div class="popup" data-max-width="582" id="tpl-action-popup_<?= $post->ID ?>">
    <div class="pop html">
        <p class="title">Получить консультацию</p>
        <p class="desc">Заполните форму и нажмите «Отправить»<br> Наш специалист свяжется с вами в ближайшее время!</p>
		<?= do_shortcode( '[contact-form-7 id="290" title="Форма для всех акций: #tpl-action-popup"]' ) ?>
    </div>
</div>
<!--googleon: all-->
<!--/noindex-->