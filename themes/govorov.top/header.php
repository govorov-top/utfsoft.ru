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
$logoName = 'main_logo';
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

<header class="header position-relative" id="header" itemscope itemtype="https://schema.org/Organization">
    <span class="d-none" itemprop="name"><?= get_bloginfo('name') . ' - ' . get_bloginfo('description') ?></span>

    <div class=" container_header <?= is_front_page() ? 'home' : '' ?>">
        <div class="header-content container d-flex justify-content-center align-items-center items">
            <div class="item header-logo me-auto me-sm-4 me-lg-auto">
                <a href="/" class="no-line">
                    <picture>
                        <img class="w-auto" alt="<?= get_bloginfo('name') . ' - ' . get_bloginfo('description') ?>"
                             src="<?= get_theme_file_uri('/assets/img/logotypes/' . $logoName . '.svg') ?>"/>
                    </picture>
                </a>
            </div>
            <button data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
                    aria-controls="mobileMenu"
                    class="item mobile-menu-button d-flex flex-column d-lg-none ms-auto ms-sm-0 me-sm-auto"
            >
                <span></span><span></span><span></span>
            </button>
            <div class="item header-menu">
                <nav class="menu navbar desktop navbar-expand-lg header-nav-bar-custom p-0">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header_menu',
                        'depth' => 3,
                        'container' => 'div',
                        'container_class' => 'header-menu collapse navbar-collapse',
                        'container_id' => 'navbarNavHeaderMenu',
                        'menu_class' => 'navbar-nav menu-items d-flex align-items-lg-center gap-2 gap-lg-3 gap-xl-4 w-100',
                        'fallback_cb' => 'BootstrapMenu::fallback',
                        'walker' => new BootstrapMenu()
                    ));
                    ?>
                </nav>
            </div>
            <div class="item header-callback d-none d-sm-flex align-items-start align-items-lg-end gap-3 gap-lg-0 flex-row-reverse flex-lg-column ms-auto">
                <?= do_shortcode('[site_info phone]') ?>
                <button class=" small-text strong popClick" data-pop="header-pop" id="requestCall">Позвоните мне
                </button>
            </div>
        </div>
    </div>

    <div id="mobileMenu" class="offcanvas offcanvas-end" tabindex="-1">
        <div class="offcanvas-header p-0">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex p-0 flex-column">
            <nav id="menu-paste" class="p-0 text-start navbar navbar-expand-lg header-nav-bar-custom align-items-start">

            </nav>
            <button class="btn btn_max-content mt-auto">Получить консультацию</button>
        </div>
    </div>
</header>
<!--noindex-->
<!--googleoff: all-->
<div class="popup" data-max-width="650" id="header-pop">
    <div class="pop html br-2 bg-white justify-content-between">
        <p class="title h3 pb-3">Заказать обратный звонок</p>
        <p class="desc mb-4">Оставьте контактные данные, и мы свяжемся с вами в ближайшее время.</p>
        <div class="form-right">
            <?= do_shortcode('[contact-form-7 id="e62711f" title="* Форма обратной связи в header"]') ?>
        </div>
    </div>
</div>
<!--googleon: all-->
<!--/noindex-->
