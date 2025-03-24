<?php
/*********************************************************
 * Настройка плагинов
 * * Contact form 7
 * * * SMTP
 * * * Удаляем оберточный span
 * * * Удаляем стили
 * * * Валидация поля ФИО
 * * ACF Pro - Advanced custom fields pro
 * * * Создаем страницы
 * * * * Страница с контактными данными пользователя
 * * * * Страница со счетчиком Яндекс.Метрики
 * * * Кастомное поле вывода кода яндекс метрики
 * * * Группы полей
 * * * * Поля для страницы Контакты
 * * * * Поля для страницы
 * Отключаем уведомления об обновлениях у плагинов
 **********************************************************/

/**
 * Настройка плагинов
 */
if (is_admin()) {
	// * Подключаем необходимые плагины для темы и настраиваем их обновления
	$configuringPluginsTheme = get_template_directory() . "/config/configuring-plugins-theme.php";
	if (!file_exists($configuringPluginsTheme)) {
		echo "Файл " . $configuringPluginsTheme . " не найден!";
	} else {
		require_once $configuringPluginsTheme;
	}
}

/**
 * Contact form 7
 */
if(in_array('contact-form-7/wp-contact-form-7.php', apply_filters('active_plugins', get_option('active_plugins')))){
    /**
     * Удаляем оберточный span
     */
    add_filter('wpcf7_form_elements', function ($content) {
        $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
        return $content;
    });
    /**
     * Удаляем стили
     */
    function rg_delete_cf7_styles()
    {
        wp_deregister_style('contact-form-7');
    }
    add_action('wp_print_styles', 'rg_delete_cf7_styles', 100);

	/**
	 * Валидация поля ФИО
	 * @param $result
	 * @param $tag
	 * @return mixed
	 */
	function rg_cf7_validate_fio($result, $tag)
	{
		$tag = new WPCF7_FormTag($tag);
		$value = isset($_POST[$tag->name]) ? trim(wp_unslash(strtr((string)$_POST[$tag->name], "\n", " "))) : '';
		if ('fio' == $tag->name) {
			if (strlen($value) >= 40) {
				$result->invalidate($tag, 'Слишком длинное ФИО, напишите просто Имя :)');
			}
			if (preg_match('/[a-zA-Z0-9]/', $value)) {
				$result->invalidate($tag, 'Используйте символы от А до Я и пробел');
			}
		}
		return $result;
	}
	add_filter('wpcf7_validate_text', 'rg_cf7_validate_fio', 10, 2);
	add_filter('wpcf7_validate_text*', 'rg_cf7_validate_fio', 10, 2);

	/**
	 * Валидация поля Телефон
	 * @param $result
	 * @param $tag
	 * @return mixed
	 */
	function rg_cf7_validate_phone( $result, $tag ) {
		$name = $tag['name'];
		if ($name === 'phone') {
			$stripped = preg_replace( '/\D/', '', $_POST[$name] );
			if( strlen( $stripped ) != 11 ) {
				$result->invalidate($tag, 'Введите телефон вида: 8 (999) 999-99-99');
			}
			if( $stripped[0] != 8 && $stripped[0] != 7 ) {
				$result->invalidate($tag, 'Первая цифра номера должна быть 7 или 8');
			}
		}
		return $result;
	}
	add_filter( 'wpcf7_validate_tel', 'rg_cf7_validate_phone', 10, 2 );
	add_filter( 'wpcf7_validate_tel*', 'rg_cf7_validate_phone', 10, 2 );
}

/**
 * ACF Pro - Advanced custom fields pro
 */
if(in_array('advanced-custom-fields-pro/acf.php', apply_filters('active_plugins', get_option('active_plugins')))){
    /**
     * Создаем страницы
     */
    if( function_exists('acf_add_options_page') ) {
        // Страница с контактными данными пользователя
        acf_add_options_page(array(
            'page_title' 	=> 'Контактные данные',
            'menu_title'	=> 'Контакты',
            'menu_slug' 	=> 'rg-contacts',
            'capability'	=> 'edit_posts',
            'position'      => 50,
            'icon_url'      => 'dashicons-phone',
            'redirect'		=> false
        ));
        // Страница со счетчиком Яндекс.Метрики
        acf_add_options_page(array(
            'page_title' 	=> 'Код в подвал',
            'menu_title'	=> 'Код в подвал',
            'menu_slug' 	=> 'rg-footer-custom-code',
            'capability'	=> 'edit_posts',
            'position'      => 51,
            'icon_url'      => 'dashicons-chart-area',
            'redirect'		=> false
        ));
    }

    /**
     * Кастомное поле вывода кода яндекс метрики
     */
    add_action( 'wp_footer', function (){
        if ($footer_scripts = get_field('rg-footer-custom-code', 'option')){echo $footer_scripts;}
    } );

    /**
     * Группы полей
     */
    if( function_exists('acf_add_local_field_group') ):
        // Поля для страницы Контакты
        acf_add_local_field_group(array(
            'key' => 'group_5db2dc3f51f14',
            'title' => 'Заполните поля',
            'fields' => array(
                array(
                    'key' => 'field_5db2dd0c0fa65',
                    'label' => 'Email',
                    'name' => 'Email',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'roman@govorov.top',
                    'placeholder' => 'roman@govorov.top',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_5db2dc4cca827',
                    'label' => 'Телефон',
                    'name' => 'phone',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '+7 (966) 1996 006',
                    'placeholder' => '+7 (966) 1996 006',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_5db2dc4cca927',
                    'label' => 'Часы работы',
                    'name' => 'job_time',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'с 09:00 до 19:00',
                    'placeholder' => 'с 09:00 до 19:00',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_60b8d776e31df',
                    'label' => 'WhatsApp',
                    'name' => 'whatsapp',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '+7 (966) 1996 006',
                    'placeholder' => '+7 (966) 1996 006',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_60b8d87827c75',
                    'label' => 'Вконтакте',
                    'name' => 'vk',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'https://vk.com/govorov_top',
                    'placeholder' => 'https://vk.com/govorov_top',
                ),
                array(
                    'key' => 'field_60b8d8e4281a3',
                    'label' => 'Instagram',
                    'name' => 'instagram',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'https://www.instagram.com/roman_web.developer/',
                    'placeholder' => 'https://www.instagram.com/roman_web.developer/',
                ),
                array(
                    'key' => 'field_60b8d93451dfc',
                    'label' => 'Telegram',
                    'name' => 'telegram',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'https://t.me/govorov_top',
                    'placeholder' => 'https://t.me/govorov_top',
                ),
                array(
                    'key' => 'field_5db2ddc2dbc70',
                    'label' => 'Адрес',
                    'name' => 'address',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'г.Москва ул.Пионерская д.58А',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_5db2e54ffb1be',
                    'label' => 'Ссылка на адрес «Яндекс.Карты»',
                    'name' => 'link_address',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_60b8d73f550c9',
                    'label' => 'Ссылка на страницу «Контакты»',
                    'name' => 'link_address_contacts',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'rg-contacts',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'acf_after_title',
            'style' => 'default',
            'label_placement' => 'left',
            'instruction_placement' => 'field',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
        // Поля для страницы Код в подвал
        acf_add_local_field_group(array(
            'key' => 'group_60b8e7dd79ad4',
            'title' => 'Вставьте код, который должен находится перед закрывающим тегом ' . htmlspecialchars('</body>'),
            'fields' => array(
                array(
                    'key' => 'field_60b8e7dd8086f',
                    'label' => 'Поле для кода',
                    'name' => 'rg-footer-custom-code',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '100',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'rg-footer-custom-code',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'acf_after_title',
            'style' => 'default',
            'label_placement' => 'left',
            'instruction_placement' => 'field',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
        // Поля для страницы Отзывы
        acf_add_local_field_group(array(
            'key' => 'group_5e4e30e1e3559',
            'title' => 'Отзывы',
            'fields' => array(
                array(
                    'key' => 'field_6155b6fd16636',
                    'label' => 'Название компании',
                    'name' => 'testimonial_company',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '33',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_5e4e30e88e138',
                    'label' => 'Имя',
                    'name' => 'testimonial_name',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '33',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_5e7a64f25b02e',
                    'label' => 'Фамилия',
                    'name' => 'testimonial_surname',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '33',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_6155b6fd11996',
                    'label' => 'Должность',
                    'name' => 'testimonial_position',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '33',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'testimonials',
                    ),
                ),
            ),
            'menu_order' => -1,
            'position' => 'acf_after_title',
            'style' => 'default',
            'label_placement' => 'left',
            'instruction_placement' => 'field',
            'hide_on_screen' => array(
                0 => 'the_content',
                1 => 'excerpt',
                2 => 'discussion',
                3 => 'comments',
                4 => 'revisions',
                5 => 'author',
                6 => 'format',
                7 => 'page_attributes',
                8 => 'categories',
                9 => 'tags',
                10 => 'send-trackbacks',
            ),
            'active' => true,
            'description' => 'Отзывы на сайт',
        ));
    endif;
}

/**
 * Отключаем уведомления об обновлениях у плагинов
 */

function remove_plugin_updates($value)
{
	$plugins_to_disable = [
		"advanced-custom-fields-pro/acf.php",
		"acf-theme-code-pro/acf_theme_code_pro.php",
		"all-in-one-seo-pack-pro/all_in_one_seo_pack.php",
		"aioseo-image-seo/aioseo-image-seo.php",
		"aioseo-index-now/aioseo-index-now.php",
		"aioseo-link-assistant/aioseo-link-assistant.php",
		"aioseo-local-business/aioseo-local-business.php",
		"aioseo-news-sitemap/aioseo-news-sitemap.php",
		"aioseo-redirects/aioseo-redirects.php",
		"aioseo-rest-api/aioseo-rest-api.php",
		"aioseo-video-sitemap/aioseo-video-sitemap.php",
		"all-in-one-wp-migration-unlimited-extension/all-in-one-wp-migration-unlimited-extension.php",
		"wp-rocket/wp-rocket.php",
		"wordfence/wordfence.php",
		"wordfence-activator/wordfence-activator.php",
		"advanced-database-cleaner-pro/advanced-db-cleaner.php",
		"admin-menu-editor-pro/menu-editor.php",
		"ame-branding-add-on/ame-branding-add-on.php",
		"wp-toolbar-editor/load.php",
		"memberpress/memberpress.php",
		"wpcode-premium/wpcode.php",
		"wpdiscuz/class.WpdiscuzCore.php",
		"acf-extended-pro/acf-extended.php",
		"wpdiscuz-frontend-moderation/class.wpDiscuzFrontEndModeration.php",
	];

	if (isset($value) && is_object($value)) {
		foreach ($plugins_to_disable as $plugin) {
			if (isset($value->response[$plugin])) {
				unset($value->response[$plugin]);
			}
		}
	}

	return $value;
}

add_filter("site_transient_update_plugins", "remove_plugin_updates");