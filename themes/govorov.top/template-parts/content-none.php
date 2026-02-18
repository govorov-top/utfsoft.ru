<?php
/**
 * Шаблон, когда записи отсутствуют
 *
 * @package WordPress
 * @subpackage My_Theme
 * @since govorov.top 1.9.96
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php _e('Ничего не найдено', 'rstheme'); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php if (is_home() && current_user_can('publish_posts')) : ?>

            <p><?php printf(__('На сайте еще не добавлены посты блога', 'rstheme')); ?></p>

        <?php elseif (is_search()) : ?>

            <p><?php _e('Извините, но ничего не соответствует вашим поисковым запросам. Попробуйте еще раз с другими ключевыми словами.', 'rstheme'); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php _e('Кажется, мы не можем найти то, что вы ищете. Возможно, поиск поможет.', 'rstheme'); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
