<?php
/**
 * Часть шаблона для отображения записей на странице рубрики Акции
 *
 * @package WordPress
 */

$title = get_the_title();
?>
<article id="post-<?php the_ID() ?>" class="<?= join( ' ', get_post_class() ) ?>">
    <div class="container">
        <div class="rg-card shadow bg-svg-line">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="p-0 title text-start color-white"><?= $title ?></h2>
                    <div class="desc color-white my-4"><?= get_the_excerpt() ?></div>
                    <div class="buttons nav gap-2 gap-sm-4 align-items-center">
                        <button
                                data-form-tariff="<?= $title ?>"
                                class="btn btn_white btn_white_color_black popClick"
                                data-pop="connect_action">
                            Отправить заявку
                        </button>
                        <p class="mb-0">
                            <a href="<?= get_permalink() ?>"
                               class="btn btn_link btn_icon btn_link-white bi bi-arrow-right">
                                Подробнее
                            </a>
                        </p>
                    </div>
                </div>
                <picture class="col-md-4 d-none d-md-block">
                    <source media="(max-width: 767.98px)"
                            srcset="<?= get_the_post_thumbnail_url( $post->ID, 'category-actions-768' ) ?>"/>
                    <source media="(max-width: 991.98px)"
                            srcset="<?= get_the_post_thumbnail_url( $post->ID, 'category-actions-992' ) ?>"/>
                    <source media="(max-width: 1199.98px)"
                            srcset="<?= get_the_post_thumbnail_url( $post->ID, 'category-actions-1200' ) ?>"/>
                    <img src="<?= get_the_post_thumbnail_url( $post->ID, 'category-actions' ) ?>"
                         alt="Участвуйте в акции: <?= get_the_title() ?>">
                </picture>
            </div>
        </div>
    </div>
</article>