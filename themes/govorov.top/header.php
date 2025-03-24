<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<?php
$isNY = false;
$logoName = 'edo';
// Получаем текущую дату
$currentDate = new DateTime();

// Задаем начальную и конечную дату для проверки в текущем году
$startDate = new DateTime(date('Y') . '-11-20');
$endDate = new DateTime(date('Y') + 1 . '-02-01');

// Проверяем, находится ли текущая дата в заданном периоде
/*if ( $currentDate >= $startDate && $currentDate <= $endDate ) {
	$isNY     = true;
	$logoName = $logoName . '_NY';
}*/
?>
<body <?php body_class($isNY ? 'rg-ny' : ''); ?> itemscope itemtype="https://schema.org/WebPage">

<header class="header" id="header" itemscope itemtype="https://schema.org/Organization">
    <span class="d-none" itemprop="name"><?= get_bloginfo('name') . ' - ' . get_bloginfo('description') ?></span>

    <?= do_shortcode('[rg-code f="widgets/RGActionsBanners.php"]') ?>

    <div class="header_container <?= is_front_page() ? 'home' : '' ?>">
        <div class="container items grid justify-content-between align-items-center py-3 position-relative">
            <div class="item mobile-logotype position-absolute d-none">
                <img src="/wp-content/themes/govorov.top/assets/img/logotypes/mobile-logotype.svg"
                     alt="ЭДО лучше чем рубить леса!">
            </div>
            <div class='d-none'><?= do_shortcode('[rg-code f="widgets/getUserRegion.php"]') ?></div>
            <div class="item logotype order-2 order-lg-0">
                <a href="/">
                    <picture>
                        <source media="(max-width: 369.98px)"
                                srcset="<?= get_theme_file_uri('/assets/img/logotypes/' . $logoName . '-logotype-370.svg') ?>" />
                        <source media="(max-width: 499.98px)"
                                srcset="<?= get_theme_file_uri('/assets/img/logotypes/' . $logoName . '-logotype-500.svg') ?>" />
                        <source media="(max-width: 1199.98px)"
                                srcset="<?= get_theme_file_uri('/assets/img/logotypes/' . $logoName . '-logotype-1200.svg') ?>" />
                        <img alt="<?= get_bloginfo('name') . ' - ' . get_bloginfo('description') ?>"
                             src="<?= get_theme_file_uri('/assets/img/logotypes/' . $logoName . '-logotype.svg') ?>" />
                    </picture>
                </a>
            </div>
            <div class="item menu-and-contacts mb-3 mb-lg-0 order-1 order-lg-1 d-none d-lg-block">
                <nav class="menu navbar navbar-expand-lg header-nav-bar-custom p-0 mt-2">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header_menu',
                        'depth' => 3,
                        'container' => 'div',
                        'container_class' => 'header-menu collapse navbar-collapse',
                        'container_id' => 'navbarNavHeaderMenu',
                        'menu_class' => 'navbar-nav menu-items d-flex flex-wrap justify-content-between align-items-baseline align-items-lg-center w-100',
                        'fallback_cb' => 'BootstrapMenu::fallback',
                        'walker' => new BootstrapMenu()
                    ));
                    ?>
                </nav>
            </div>
            <div class="item brief order-3 order-lg-2" id="brief">
                <?php
                // Проверяем, что текущая страница - promo-2024
                if (is_page('promo-2024')) : ?>
                    <p class="mb-0">
                        <a
                            href="https://www.diadoc.ru/easyregistration?p=0733"
                            class="btn btn_yellow"
                            target="_blank"
                            rel="noreferrer nofollow noopener"
                        >Подключиться
                        </a>
                    </p>
                <?php else: ?>

                    <p class="mb-0">
                        <a
                            href="javascript:"
                            class="btn btn_yellow popClick"
                            data-pop="<?= empty($_COOKIE['briefQuiz']) ? 'brief_popUp' : 'web-zvonok_pop' ?>"
                            data-title="<?= empty($_COOKIE['briefQuiz']) ? '' : 'Обратный звонок' ?>"><?= empty($_COOKIE['briefQuiz']) ? '<span class="d-xl-none d-block">Онлайн расчет</span><span class="d-none d-xl-block">Получить расчет</span>' : 'Заказать звонок' ?>
                        </a>
                    </p>
                <?php endif; ?>
            </div>
            <div
                class="item mobile-menu-button d-flex d-lg-none align-items-center order-2 order-md-3 p-0 color-text order-4"
                data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                aria-controls="mobileMenu">
                <div class="navbar-btn">
                    <span></span>
                </div>
                <span class="text rg-font-24-medium"></span>
            </div>
        </div>
    </div>
    <div id="mobileMenu" class="offcanvas offcanvas-end" tabindex="-1">
        <div class="offcanvas-header pb-0">
            <p class="h2 pb-0">Меню</p>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav id="menu-paste" class="p-0 text-start navbar navbar-expand-lg header-nav-bar-custom align-items-start">

            </nav>
        </div>
    </div>
</header>
