<?php
/**
 * Подключаем файл TGM
 * Отключаем обновления определенных плагинов
 */
// Подключаем файл TGM http://tgmpluginactivation.com/installation/
$tgm = get_template_directory() . "/inc/Classes/ClassTgmPluginActivation.php";
if ( ! file_exists( $tgm ) ) {
	echo "Файл " . $tgm . " не найден!";
} else {
	require_once $tgm;
	add_action( "tgmpa_register", function () {
		$file = "https://api.kontur-center.ru/public/files/root_plugins/json.json?DOMAIN=beget";

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $file );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$content = curl_exec( $ch );

		$plugins = json_decode( $content, true );

		$config = [
			"id"           => "rg_install_plugins",
			// Уникальный идентификатор для уведомлений о хешировании для нескольких экземпляров TGMPA.
			"default_path" => "",
			// Абсолютный путь по умолчанию к связанным плагинам.
			"menu"         => "tgmpa-install-plugins",
			// Menu slug.
			"parent_slug"  => "themes.php",
			// Заголовок родительского меню.
			"capability"   => "edit_theme_options",
			// Возможность, необходимая для просмотра страницы установки плагина, должна быть связана с используемым родительским меню.
			"has_notices"  => false,
			// Показывать уведомления администратора или нет.
			"dismissable"  => true,
			// Если false, пользователь не может отклонить ворчание.
			"dismiss_msg"  => "",
			// Если 'dismissable' ложно, это сообщение будет выводиться вверху nag.
			"is_automatic" => true,
			// Автоматически активировать плагины после установки или нет.
			"message"      => "",
			// Сообщение для вывода прямо перед таблицей плагинов.
			"strings"      => [
				"page_title" => "Установить необходимые плагины",
				"menu_title" => "Установить плагины",
			],
		];
		tgmpa( $plugins, $config );
	} );
}
