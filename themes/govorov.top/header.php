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

    <div class="container container_header <?= is_front_page() ? 'home' : '' ?>">
        <div class="header-content d-flex justify-content-center align-items-center items">
            <div class="item header-logo me-auto">
                <a href="/" class="no-line">
                    <picture>
                        <img class="w-auto" alt="<?= get_bloginfo('name') . ' - ' . get_bloginfo('description') ?>"
                             src="<?= get_theme_file_uri('/assets/img/logotypes/' . $logoName . '.svg') ?>"/>
                    </picture>
                </a>
            </div>
            <div class="item header-menu">
                <nav class="menu navbar desktop navbar-expand-lg header-nav-bar-custom p-0">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header_menu',
                        'depth' => 3,
                        'container' => 'div',
                        'container_class' => 'header-menu collapse navbar-collapse',
                        'container_id' => 'navbarNavHeaderMenu',
                        'menu_class' => 'navbar-nav menu-items d-flex align-items-lg-center gap-2 gap-lg-3  w-100',
                        'fallback_cb' => 'BootstrapMenu::fallback',
                        'walker' => new BootstrapMenu()
                    ));
                    ?>
                </nav>
            </div>
            <div class="item header-callback d-flex align-items-center gap-3 gap-xl-4 ms-auto">
                <a href="#" class="whatsapp no-line color-green"><i class="bi bi-whatsapp"></i></a>
                <div class="d-none d-sm-flex align-items-end flex-column">
                    <a href="tel:84952258118 " class="strong phone no-line color-text">8 495 225 8118 </a>
                    <button class="btn_link btn" id="requestCall">Заказать звонок</button>
                </div>
            </div>
            <button data-bs-toggle="collapse" data-bs-target="#mobileMenu"
                    class="item mobile-menu-button d-flex flex-column align-items-center justify-content-center d-lg-none ms-3 ms-sm-4"
                    aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
    <div class="container d-lg-none position-relative">
        <div id="mobileMenu" class="collapse" tabindex="-1">
            <nav id="menu-paste"
                 class="text-start navbar navbar-expand-lg gap-2 header-nav-bar-custom align-items-start">

            </nav>

        </div>
    </div>
</header>
