<?php
/**
 * Часть шаблона для отображения Контента
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since My Theme 1.0
 */
?>
<article itemscope itemtype="https://schema.org/Article" id="post-<?php the_ID() ?>"
         class="rg-card shadow mb-5 mb-xl-4 bg <?= join(' ', get_post_class()) ?>">
    <div class="row align-items-center">
        <div class="col-md-3" itemprop="image">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('blog');
            } else {
                echo '<img src="/wp-content/themes/utfsoft.ru/assets/img/no-photo.svg" alt="Фото статьи не найдено">';
            }
            ?>
        </div>
        <div class="col-md-9">
            <h5 class="title pb-0 text-start color-white"
                itemprop="headline"><?php the_title(sprintf('<a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a>'); ?></h5>
            <p class="desc my-3" itemprop="description">
                <?= get_the_excerpt(); ?>
            </p>
            <p class="mb-0">
                <a href="<?= get_permalink() ?>" class="btn btn_link btn_icon bi bi-arrow-right">
                    Читать подробнее <span class="arrow"></span>
                </a>
            </p>
        </div>
    </div>
</article>
