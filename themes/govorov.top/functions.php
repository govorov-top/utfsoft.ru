<?php
/***************************************************************
 * Распределение заявок
 * Отслеживаем откуда пришел пользователь
 * Отключаем авто форматирование в редакторе WP
 * Выводим шрифты в HTML
 * Добавление js и css файлов
 * Добавление js и css файлов для админки
 * Добавление атрибутов defer и async для скриптов
 * Настройка виджетов (футер, сайдбар, копирайт и тд.)
 * Переименовываем пункты меню
 * Изменение длины обрезаемого текста новостей
 * Добавляем title в ссылки на пагинации next/previous post
 * Функция для вывода объектов в читаемом виде + вывод ошибок
 * Изменение текста в подвале админ-панели
 * Добавляем столбец: Дата последнего изменения поста или страницы
 * Удаляем столбец комментариев в админке
 * Определение региона пользователя
 * Подключаемые файлы
 * * Включаем все необходимое для темы
 * * Добавление шаблонов блоков
 * * Кастомные шорткоды
 * * Кастомные страницы
 * * [Bootstrap 5] Интеграция bootstrap и меню WordPress
 * * [Bootstrap 5] Хлебные крошки
 * * Настройка плагинов
 * * Отправка заявок в CRM bitrix24
 ****************************************************************/
require __DIR__ . '/vendor/autoload.php';
/**
 * Распределение заявок
 */
function distributionLeads(): array
{
    $utmSource = false;
    $region = $_COOKIE['regionUser'] ?? 'Московская область';

    if (!empty($_COOKIE['utm_source'])) {
        $utmSource = $_COOKIE['utm_source'];
    } elseif (!empty($_GET['utm_source'])) {
        $utmSource = $_GET['utm_source'];
    }

    $result = [
        'region' => 'msk',
        'ads' => $utmSource
    ];

    if ($result['ads']) { //Если заявка из рекламы
        $result['region'] = match ($result['region']) {
            '_spb_yandex' => 'spb',
            default => 'msk',
        };
    } else {
        if (
            (
                str_contains($region, 'Ленинградская') ||
                str_contains($region, 'Санкт')
            ) &&
            !str_contains($_SERVER['REQUEST_URI'], 'contacts')
        ) {
            $result['region'] = 'spb';
        }
    }

    return $result;
}

/**
 * Отслеживаем откуда пришел пользователь
 */
if (!is_admin()) {
    foreach ($_GET as $item => $value) {
        if (
            !empty($_GET['utm_source']) ||
            !empty($_GET['utm_campaign']) ||
            !empty($_GET['utm_content']) ||
            !empty($_GET['utm_medium']) ||
            !empty($_GET['utm_term']) ||
            !empty($_GET['fbclid']) ||
            !empty($_GET['smm']) ||
            !empty($_GET['email_ras']
            )
        ) {
            setcookie($item, $value, time() + 3600, '/');
        }
    }
}

/**
 * Выводим шрифты в HTML
 */
function rg_get_font_face_styles(): string
{
    $font_name = 'Geologica';
    $code = "
        @font-face {
            font-family: '" . $font_name . "-Regular';
            src: url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Regular.eot') . "');
            src: local('" . $font_name . "'), local('" . $font_name . "-Regular'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Regular.eot?#iefix') . "') format('embedded-opentype'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Regular.woff2') . "') format('woff2'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Regular.ttf') . "') format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: '" . $font_name . "-Light';
             src: url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Light.eot') . "');
            src: local('" . $font_name . "'), local('" . $font_name . "-Light'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Light.eot?#iefix') . "') format('embedded-opentype'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Light.woff2') . "') format('woff2'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Light.ttf') . "') format('truetype');
            font-weight: 300;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: '" . $font_name . "-Medium';
             src: url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Medium.eot') . "');
            src: local('" . $font_name . "'), local('" . $font_name . "-Medium'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Medium.eot?#iefix') . "') format('embedded-opentype'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Medium.woff2') . "') format('woff2'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Medium.ttf') . "') format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: '" . $font_name . "-SemiBold';
             src: url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-SemiBold.eot') . "');
            src: local('" . $font_name . "'), local('" . $font_name . "-SemiBold'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-SemiBold.eot?#iefix') . "') format('embedded-opentype'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-SemiBold.woff2') . "') format('woff2'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-SemiBold.ttf') . "') format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: '" . $font_name . "-Bold';
            src: url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Bold.eot') . "');
            src: local('" . $font_name . "'), local('" . $font_name . "-Bold'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Bold.eot?#iefix') . "') format('embedded-opentype'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Bold.woff2') . "') format('woff2'),
                url('" . get_theme_file_uri('assets/fonts/' . $font_name . '-Bold.ttf') . "') format('truetype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }
    ";

    return preg_replace('|\s+|', '', $code);
}

// Предварительно загружаем основной веб-шрифт для повышения производительности.
function rg_preload_webfonts()
{
    $font_name = 'Geologica';
    ?>
    <link rel="preload" href="<?= esc_url(get_theme_file_uri('assets/fonts/' . $font_name . '-Regular.woff2')); ?>"
          as="font" crossorigin>
    <?php
}

add_action('wp_head', 'rg_preload_webfonts');

/**
 * Добавление js и css файлов
 */
function rg_css_and_js()
{
    // CSS
    if (file_exists(get_template_directory() . '/assets/min/css/vendors.min.css')) {
        wp_enqueue_style('vendors', get_stylesheet_directory_uri() . '/assets/min/css/vendors.min.css', [], '_rgbld_5_5_2025');
    }
    wp_enqueue_style('styles', get_stylesheet_directory_uri() . '/assets/min/css/styles.min.css', [], '_rgbld_5_5_2025');
    wp_add_inline_style('styles', rg_get_font_face_styles());

    // Для страниц и новостей подключаем стили отдельно
    if (is_category() || is_archive() || is_single() || str_contains($_SERVER['REQUEST_URI'], 'components')) {
        wp_enqueue_style('posts', get_stylesheet_directory_uri() . '/assets/min/css/posts.min.css', [], '_rgbld_5_5_2025');
        wp_enqueue_script('comment-reply', [], null, true);
        // Подключаем стили конкретного поста
        $patch_page_style = get_stylesheet_directory() . '/assets/min/css/style-post-';
        if (file_exists($patch_page_style . get_the_ID() . '.min.css') && (is_single() || is_category() || is_archive())) {
            wp_enqueue_style('style-post-' . get_the_ID(), get_stylesheet_directory_uri() . '/assets/min/css/style-post-' . get_the_ID() . '.min.css', [], '_rgbld_5_5_2025');
        }
    } else {
        wp_enqueue_style('pages', get_stylesheet_directory_uri() . '/assets/min/css/pages.min.css', [], '_rgbld_5_5_2025');
        // Подключаем стили конкретной страницы
        $patch_page_style = get_stylesheet_directory() . '/assets/min/css/style-page-';
        if (file_exists($patch_page_style . get_the_ID() . '.min.css') && (!is_single() && !is_category() && !is_archive())) {
            wp_enqueue_style('style-page-' . get_the_ID(), get_stylesheet_directory_uri() . '/assets/min/css/style-page-' . get_the_ID() . '.min.css', [], '_rgbld_5_5_2025');
        }
    }

    // Грамотно выводим мобильные стили
    $arr_display_styles = ['1400', '1200', '992', '768', '576'];
    $arr_name_files_mobile_style = ['main', 'pages', 'posts', get_the_ID()];
    $patch_mobile_styles = get_stylesheet_directory() . '/assets/min/css/';
    foreach ($arr_display_styles as $d) {
        foreach ($arr_name_files_mobile_style as $f) {
            if (file_exists($patch_mobile_styles . $f . '-max-' . $d . '.css')) {
                wp_enqueue_style($f . '-max-' . $d, get_stylesheet_directory_uri() . '/assets/min/css/' . $f . '-max-' . $d . '.css', [], '_rgbld_5_5_2025', 'screen and (max-width:' . $d . 'px)');
                if (is_single() || is_category() || is_archive() || str_contains($_SERVER['REQUEST_URI'], 'components')) {
                    wp_deregister_style('pages-max-' . $d);
                } else {
                    wp_deregister_style('posts-max-' . $d);
                }
            }
        }
    }

    // JS
    if (!is_admin() && !is_single()) {
        wp_deregister_script('jquery');
    }
    $vendorsLibsWebpack = file_exists(get_template_directory() . '/assets/min/js/vendors.min.js');
    if (!empty($vendorsLibsWebpack)) {
        wp_enqueue_script('vendors', get_stylesheet_directory_uri() . '/assets/min/js/vendors.min.js', [], '_rgbld_5_5_2025', true);
    }
    wp_register_script('main', get_stylesheet_directory_uri() . '/assets/min/js/main.min.js', !empty($vendorsLibsWebpack) ? ['vendors'] : [], '_rgbld_5_5_2025', true);
    wp_localize_script(
        'main',
        'rgData',
        array(
            'ajax_url' => admin_url('admin-ajax.php')
        )
    );
    wp_enqueue_script('main');
    // Для страниц и новостей подключаем скрипты отдельно
    if (is_category() || is_archive() || is_single()) {
        wp_enqueue_script('posts', get_stylesheet_directory_uri() . '/assets/min/js/postsScripts.min.js', !empty($vendorsLibsWebpack) ? [
            'main',
            'vendors'
        ] : ['main'], '_rgbld_5_5_2025', true);
    } else {
        wp_enqueue_script('pages', get_stylesheet_directory_uri() . '/assets/min/js/pagesScripts.min.js', !empty($vendorsLibsWebpack) ? [
            'main',
            'vendors'
        ] : ['main'], '_rgbld_5_5_2025', true);
    }
}

add_action('wp_enqueue_scripts', 'rg_css_and_js');

/**
 * Добавление js и css файлов для админки
 */
function rg_css_and_js_admin()
{
    // CSS
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/assets/min/css/admin.min.css', [], '_rgbld_5_5_2025');
    wp_add_inline_style('admin-styles', rg_get_font_face_styles());
    // JS
    wp_enqueue_script('admin-scripts', get_stylesheet_directory_uri() . '/assets/min/js/admin.min.js', [], '_rgbld_5_5_2025');
}

add_action('admin_enqueue_scripts', 'rg_css_and_js_admin');

/**
 * Добавление атрибутов defer и async для скриптов
 */
function rg_add_defer_and_async_attribute($tag, $handle)
{
    $handles = [
        'async' => [],
        'defer' => ['main', 'posts', 'vendors']
    ];
    if (!empty($handles)) {
        if (count($handles['async']) > 0) {
            foreach ($handles['async'] as $script) {
                if ($script === $handle) {
                    return str_replace(' src', ' async src', $tag);
                }
            }
        }
        if (count($handles['defer']) > 0) {
            foreach ($handles['defer'] as $script) {
                if ($script === $handle) {
                    return str_replace(' src', ' defer src', $tag);
                }
            }
        }
    }

    return $tag;
}

add_filter('script_loader_tag', 'rg_add_defer_and_async_attribute', 10, 2);

/**
 * Настройка виджетов (футер, сайдбар, копирайт и тд.)
 */
function rg_widgets_init()
{
    register_sidebar(array(
        'name' => "Сайдбар",
        'id' => 'sidebar-1',
        'description' => "Сайдбар на странице новости.",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));
    register_sidebar(array(
        'name' => "Виджет #1 [footer]",
        'id' => 'footer-widget-1',
        'description' => "Виджет в подвале №1.",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'name' => "Виджет #2 [footer]",
        'id' => 'footer-widget-2',
        'description' => "Виджет в подвале №2.",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));
    register_sidebar(array(
        'name' => "Виджет #3 [footer]",
        'id' => 'footer-widget-3',
        'description' => "Виджет в подвале №3.",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));
    register_sidebar(array(
        'name' => "Виджет #4 [footer]",
        'id' => 'footer-widget-4',
        'description' => "Виджет в подвале №4.",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));
    register_sidebar(array(
        'name' => "Виджет #5 [footer]",
        'id' => 'footer-widget-5',
        'description' => "Копирайт сайта",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));
    register_sidebar(array(
        'name' => "Виджет #6 [footer]",
        'id' => 'footer-widget-6',
        'description' => "Виджет в подвале №6.",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="widget-title">',
        'after_title' => '</p>',
    ));
}

add_action('widgets_init', 'rg_widgets_init');

/**
 * Переименовываем пункты меню
 */
function rg_edit_admin_menus()
{
    global $menu;
    if (!empty($menu[30])) // cf7
    {
        $menu[30][0] = 'Формы';
    }
}

add_action('admin_menu', 'rg_edit_admin_menus');

/**
 * Изменение длины обрезаемого текста новостей
 */
add_filter('excerpt_length', function () {
    return 33;
});
add_filter('excerpt_more', function ($more) {
    return '...';
});

/**
 * Добавляем title в ссылки на пагинации next/previous post
 */
add_filter('next_post_link', 'rg_add_title_post_link', 10, 4);
add_filter('previous_post_link', 'rg_add_title_post_link', 10, 4);
function rg_add_title_post_link($output, $format, $link, $post)
{
    if (!empty($post->post_title)) {
        $title = esc_attr('Смотрите: ' . $post->post_title);

        return str_replace('<a', "<a title='$title'", $output);
    }

    return $output;
}

/**
 * Функция для вывода объектов в читаемом виде + вывод ошибок
 *
 * @param $code
 * @param string $debug_method
 *
 * @return bool
 */
function ddd($code, string $debug_method = "print"): bool
{
    if (is_admin()) {
        if (!empty($code)) {
            ini_set("error_reporting", E_ALL);
            ini_set("display_errors", 1);
            ini_set("display_startup_errors", 1);
            echo "<pre>";
            switch ($debug_method) {
                case "print":
                    print_r($code);
                    break;
                case "dump":
                    var_dump($code);
                    break;
                case "export":
                    var_export($code);
                    break;
            }
            echo "</pre>";

            return true;
        } else {
            echo "<pre>Код то не передал...</pre>";
        }
    }

    return false;
}

/**
 * Изменение текста в подвале админ-панели
 */
function rg_text_to_footer_wp()
{
    echo 'Разработка темы: <a href="https://govorov.top/" target="_blank">govorov.top</a>. Работает на <a href="http://wordpress.org" target="_blank">WordPress</a>.';
}

add_filter('admin_footer_text', 'rg_text_to_footer_wp');

/**
 * Добавляем столбец: Дата последнего изменения поста или страницы
 */
function rg_page_modified_column_register($columns)
{
    $columns['page_modified'] = "Дата изменения";

    return $columns;
}

add_filter('manage_edit-page_columns', 'rg_page_modified_column_register');
function rg_page_modified_column_display($column_name, $page_id)
{
    if ('page_modified' != $column_name) {
        return;
    }
    $page_modified = get_post_field('post_modified', $page_id);
    if (!$page_modified) {
        $page_modified = '' . "undefined" . '';
    }
    echo $page_modified;
}

add_action('manage_pages_custom_column', 'rg_page_modified_column_display', 10, 2);
function rg_page_modified_column_register_sortable($columns)
{
    $columns['page_modified'] = 'page_modified';

    return $columns;
}

add_filter('manage_edit-page_sortable_columns', 'rg_page_modified_column_register_sortable');

/**
 * Удаляем столбец комментариев в админке
 */
function remove_post_columns($columns)
{
    unset($columns['comments']);

    return $columns;
}

add_filter('manage_edit-post_columns', 'remove_post_columns', 10, 1);
function remove_page_columns($columns)
{
    unset($columns['expirationdate']);
    unset($columns['comments']);

    return $columns;
}

add_filter('manage_edit-page_columns', 'remove_page_columns', 10, 1);

/**
 * Определение региона пользователя
 */

use Dadata\DadataClient;

add_action('init', function () {
    if (empty($_COOKIE['cityUser']) || empty($_COOKIE['regionUser'])) {
        if (!empty($_SERVER['REMOTE_ADDR'])) {
            if (
                $_SERVER['REMOTE_ADDR'] === '127.0.0.1' ||
                $_SERVER['REMOTE_ADDR'] === 'localhost' ||
                $_SERVER['REMOTE_ADDR'] === '92.54.195.32'
            ) {
                $_SERVER['REMOTE_ADDR'] = '176.193.174.178';
            }

            $token = "88d5b884081b44df3464460b75d5cae0f8191015";
            $secret = "e8ca8399cc5d51220f3218adc19431022f8bd7fc";
            if ($token || $secret) {
                try {
                    $dadata = new DadataClient($token, $secret);
                    if ($dadata->getDailyStats()['services']['suggestions'] >= 9999) {
                        $token = "6eac2e0967d1257ccf8a1c9017cc05f81d5e415d";
                        $secret = "58faf5a787c865a5eae5800d1fb030dfd115002d";
                        $dadata = new DadataClient($token, $secret);
                    }
                    $response = $dadata->iplocate($_SERVER['REMOTE_ADDR']);
                    if (!empty($response['data'])) {
                        $city = $response['data']['city'];
                        $region = $response['data']['region_with_type'];
                        if (!empty($city) && empty($_COOKIE['cityUser'])) {
                            setcookie("cityUser", $city, time() + 3600, '/');
                        }
                        if (!empty($region) && empty($_COOKIE['regionUser'])) {
                            setcookie("regionUser", $region, time() + 3600, '/');
                        }
                    }
                } catch (Exception $e) {
                    return $e;
                }
            } else {
                echo "<script>
                    console.error('Что-то не указано: ', 
                    {
                        token: '$token',
                        secret: '$secret',
                        error: 'Укажите ключи Dadata!'
                    })
                   </script>";
            }
        }
    }
});

/**
 * Подключаемые файлы
 */
function rg_include_custom_files($path)
{
    $file = get_template_directory() . $path;
    if (!file_exists($file)) {
        echo 'Файл ' . $file . ' не найден!';
    } else {
        require_once $file;
    }
}

/**
 * Включаем все необходимое для темы
 */
rg_include_custom_files('/inc/theme-supports.php');

/**
 * Добавление шаблонов блоков
 */
rg_include_custom_files('/inc/block-patterns.php');

/**
 * Кастомные шорткоды
 */
rg_include_custom_files('/inc/custom-shortcodes.php');

/**
 * Кастомные страницы
 */
rg_include_custom_files('/inc/custom-type-posts.php');

/**
 * [Bootstrap 5] Интеграция bootstrap и меню WordPress
 */
rg_include_custom_files('/inc/Classes/BootstrapMenu.php');

/**
 * [Bootstrap 5] Хлебные крошки
 */
rg_include_custom_files('/inc/Classes/BootstrapBreadcrumbs.php');

/**
 * Настройка плагинов
 */
rg_include_custom_files('/inc/settings-plugins.php');

/**
 * Отправка заявок в CRM bitrix24
 */
rg_include_custom_files('/config/integration-bitrix24.php');
