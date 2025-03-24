<?php
/***************************************************************
 * Шорткод вывода файлов и виджетов [rg-code f="f.php"]
 * Шорткод вывода акций [rg-action post_id=""]
 * Шорткоды, которые работают в паре с плагинами
 * * [CF7] Шорткоды кастомных полей
 * * [ACF] Шорткод вывода контактов
 ****************************************************************/

/**
 * Шорткод вывода файлов и виджетов [rg-code f="f.php"]
 * @param string $attr
 * @return false|string
 */
function rg_shortcode_get_file($attr = '') {
	extract(shortcode_atts(array('f'), $attr));

	$fileName = $attr['f'];

	if(empty($fileName)){
		return 'Не указан главный атрибут f="file.php"';
	}
	$ext = explode('.', $fileName);
	if(empty($ext[1]) || !in_array($ext[1], array('html', 'php'))){
		return 'Используйте только файлы следующих форматов: .html или .php';
	}

	$file = get_template_directory().'/my-get-files/'.$fileName;

	if(!file_exists($file)) return 'Файл по '.$fileName.' найден';

	ob_start();
	require $file;
	return ob_get_clean();

}
add_shortcode( 'rg-code', 'rg_shortcode_get_file' );

/**
 * Шорткод вывода акций [rg-action post_id=""]
 * @param $atts
 * @return false
 */
function rg_shortcode_get_action($atts) {
	$params = shortcode_atts(
		[
			'post_id' => false,
		],
		$atts
	);
	if ($params['post_id']){
		ob_start();
		$wp_query = new WP_Query(array(
			'post__in' => [$params['post_id']],
			'post_type' => 'post',
			'posts_per_page' => 1,
		));
		if( $wp_query->have_posts() ) : ?>
            <div class="container">
				<?php while( $wp_query->have_posts() ) : $wp_query->the_post();
					get_template_part( 'template-parts/category-actions', 'all', $wp_query);
				endwhile;?>
                <!--noindex-->
                <!--googleoff: all-->
                <div class="popup" data-max-width="931" id="tpl-action-popup">
                    <div class="pop html">
                        <p class="title">Контур.Экстерн <span>скидка до 25%</span>!</p>
                        <p class="desc">Заполните форму и нажмите «Отправить»<br> Наш специалист свяжется с вами в ближайшее время!</p>
                        <div class="form-right d-flex justify-content-end">
                            <div class="item">
								<?=do_shortcode('[contact-form-7 id="4148" title="/ Форма в баннере акция"]')?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--googleon: all-->
                <!--/noindex-->
            </div>
		<?php endif;
		wp_reset_postdata();
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	return true;
}
add_shortcode( 'rg-action', 'rg_shortcode_get_action' );
/**
 * Шорткод вывода отзывов [rg-testimonials ids="1,2,3" cats_id="1,2,3" title="Отзывы"]
 * @param $attrs
 * @return bool|string
 */
function rg_shortcode_get_testimonials($attrs): bool|string {
	$params = shortcode_atts([
		'ids' => '',
		'cats_id' => '',
		'title' => ''
	], $attrs);
	$args = [
		'post_type' => 'testimonials',
		'posts_per_page' => 12,
		'orderby' => 'ASC'

	];
	// Если ID переданы, конвертируем в массив
	if (!empty($attrs['ids'])){
		$args['post__in'] = explode(',', $attrs['ids']);
	}
	// Если ID категорий переданы, конвертируем в массив
	if (!empty($attrs['cats_id'])){
		$args['tax_query'] = [
			[
				'taxonomy' => 'mark',
				'field' => 'term_id',
				'terms' => explode(',', $attrs['cats_id']),
			]
		];
	}
	ob_start();

	get_template_part('template-parts/shortcodes/testimonials-shortcode', '', ['args' => $args,'params'=>$attrs]);

	wp_reset_postdata();

	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
add_shortcode( 'rg-testimonials', 'rg_shortcode_get_testimonials' );
/**
 * Шорткоды, которые работают в паре с плагинами
 */

/**
 * [CF7] Шорткоды кастомных полей
 */
if(in_array('contact-form-7/wp-contact-form-7.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	function rg_pol_cod_cf7_func()
	{
		return '<div class="items_soglasie d-flex align-items-center">
                <div class="item_soglasie">
                    <span class="wpcf7-form-control-wrap agree d-none">
                        <span class="wpcf7-form-control wpcf7-acceptance invert">
                            <span class="wpcf7-list-item">
                                <input type="checkbox" name="agree" value="1" aria-invalid="false" class="agree" checked>
                            </span>
                        </span>
                    </span>
                    <div></div>
                </div>
                <div class="item_soglasie">
                    <p>Отправляя заявку, вы соглашаетесь с условиями
                        <a href="/politika-konfidencialnosti/" target="_blank">политики конфиденциальности</a>
                        и <a href="/polzovatelskoe-soglashenie/" target="_blank">пользовательского соглашения</a>.</p>
                </div>
            </div>';
	}
	wpcf7_add_form_tag('politiki', 'rg_pol_cod_cf7_func');
}

/**
 * [ACF] Шорткод вывода контактов
 */
if(in_array('advanced-custom-fields-pro/acf.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	function rg_site_info_shortcode($attrs)
	{
		$array = [
			'email' => 'email',
			'phone' => 'phone',
			'phone_text' => 'phone',
			'whatsapp' => 'whatsapp',
			'whatsapp_text' => 'whatsapp',
			'skype' => 'skype',
			'skype_text' => 'skype',
			'icq' => 'icq',
			'icq_text' => 'icq',
			'vk' => 'vk',
			'vk_text' => 'vk',
			'instagram' => 'instagram',
			'instagram_text' => 'instagram',
			'telegram' => 'telegram',
			'telegram_text' => 'telegram',
			'address' => 'address',
			'link_address' => 'link_address',
			'link_address_contacts' => 'link_address_contacts',
			'job_time' => 'job_time'
		];

		foreach ($array as $k => $v) {
			$array[$k] = get_field($v, 'option');
		}

		extract(shortcode_atts($array, $attrs));
		$attr = $attrs[0];
		switch ($attr) {
			case 'email' :
				$res = '<a class="RGemailSHORT" href="mailto:' . $array[$attr] . '">' . $array[$attr] . '</a>';
				break;
			case 'phone' :
				$res = '<a class="RGphoneSHORT" href="tel:' . preg_replace('/[^0-9]/', '', $array[$attr]) . '">' . $array[$attr] . '</a>';
				break;
			case 'link_address' :
				$res = '<a href="' . $array[$attr] . '" rel="nofollow noopener noreferrer" target="_blank">' . $array[$attr] . '</a>';
				break;
			case 'address' :
			case 'email_text' :
			case 'phone_text' :
			case 'whatsapp_text' :
			case 'skype_text' :
			case 'icq_text' :
			case 'vk_text' :
			case 'instagram_text' :
			case 'telegram_text' :
			case 'job_time' :
				$res = $array[$attr];
				break;

			default :
				$res = 'Чё-то не так указал(а)..';
		}
		return $res;
	}
	add_shortcode('site_info', 'rg_site_info_shortcode');
}