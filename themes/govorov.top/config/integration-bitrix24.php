<?php
/**
 * Создание интервала задачи
 */
add_filter( 'cron_schedules', function ( $raspisanie ) {
	$raspisanie['repeat_one_minute'] = array(
		'interval' => 60,
		'display' => 'Каждую минуту'
	);
	return $raspisanie;
});

/**
 * Отправка формы ContactForm 7
 */
add_action( 'wpcf7_mail_sent', 'rg_wpcf7_mail_sent_function' );
function rg_wpcf7_mail_sent_function($contact_form)
{
	$title = $contact_form->title;
	if ($title) {

		if (!empty($_COOKIE['regionUser'])){
			switch (mb_strtolower($_COOKIE['regionUser'])){
				case 'донецкая область' :
				case 'донецкая народная респ' :
				case 'луганская область' :
				case 'луганская народная респ' : return true;
			}
		}
		if (!empty($_SERVER['REQUEST_URI'])){
			if (
				strpos($_SERVER['REQUEST_URI'],'dnr')
				|| strpos($_SERVER['REQUEST_URI'],'lnr')
				|| strpos($_SERVER['REQUEST_URI'],'lipeck')
				|| strpos($_SERVER['REQUEST_URI'],'doneck')
			){
				return true;
			}
		}
		if (!empty($_COOKIE['utm_content'])) {
			if (strpos($_COOKIE['utm_content'],'dnr')
			    || strpos($_COOKIE['utm_content'],'lnr')
			    || strpos($_COOKIE['utm_content'],'lipeck')
			    || strpos($_COOKIE['utm_content'],'doneck')){
				return true;
			}
		}

		$wpcf7 = WPCF7_ContactForm::get_current();
		$submission = WPCF7_Submission::get_instance();
		$posted_data = $submission->get_posted_data();

		if (!$posted_data['_wpcf7']) {
			$posted_data['_wpcf7'] = $wpcf7->id;
		}
		if (!$posted_data['title']){
			$posted_data['title'] = $title;
		}
		$test = json_encode($posted_data, true);
		error_log( print_r( $test, true ) );
		$leadInfo = json_encode([
			'posted_data' => json_encode($posted_data, true), //Массив с данными формы
			'server_info' => json_encode($_SERVER, true),     //Массив с данными $_SERVER пользователя
			'cookie_info' => json_encode($_COOKIE, true),     //Массив с данными $_COOKIE пользователя
			'get_info' => json_encode($_GET, true)            //Массив с данными $_GET пользователя
		], true);
		if (mb_convert_case($posted_data['fio'], MB_CASE_TITLE) === 'Тест'){
			curlSendLead($leadInfo);
		}else{
			global $wpdb;
			// Проверяем наличие таблицы
			$table_name = $wpdb->prefix . 'leads';
			$table_exists = $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name;

			// Если таблицы нет, создаем ее
			if ( ! $table_exists ) {
				$charset_collate = $wpdb->get_charset_collate();
				$sql = "CREATE TABLE $table_name (
                        ID mediumint(9) NOT NULL AUTO_INCREMENT,
                        LEAD_INFO json NOT NULL,
                        SENT int NOT NULL DEFAULT '0',
                        DATE datetime NOT NULL,
                        IP varchar(15) NOT NULL,
                        PRIMARY KEY  (ID)
                    ) $charset_collate;";

				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				dbDelta( $sql );
			}

			$ip = $_SERVER['REMOTE_ADDR'];
			$today = date('Y-m-d');
			$ip_records_today = $wpdb->get_var(
				$wpdb->prepare(
					"SELECT COUNT(*) FROM $table_name WHERE IP = %s AND DATE = %s",
					array($ip, $today)
				)
			);


			if ($ip_records_today < 2) {
				$wpdb->insert('rg_leads', [
					'LEAD_INFO' => $leadInfo,
					'DATE' => date('Y-m-d'),
					'IP' => $_SERVER['REMOTE_ADDR'],
				]);
			}else {
				// If 2 or more records, return an error to the user
				$submission->set_response('Вы уже отправляли 2 заявки за сегодня');
				$submission->set_status('spam');
			}
			if( !wp_next_scheduled('rg_integrationBitrix24'))
				wp_schedule_event( time(), 'repeat_one_minute', 'rg_integrationBitrix24');
		}
	}
}

/**
 * Смотрим в базе пришедшие лиды, если есть не импортированные, импортируем в битру.
 */
add_action( 'rg_integrationBitrix24', function() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'leads';
	// Получаем все не импортированные лиды
	$lead_info = $wpdb->get_results( "SELECT * FROM $table_name WHERE SENT = 0", ARRAY_A );

	if ( count( $lead_info ) > 0 ) {
		foreach ( $lead_info as $v ) {
			$curl = curlSendLead( $v['LEAD_INFO'] );
			if ( $curl ) {
				// Обновляем, тип готово, импортированные
				$wpdb->update(
					$table_name,
					array('SENT' => 1),
					array('ID' => $v['ID'])
				);
				// Проверяем и удаляем записи не сегодняшней даты
				$today = date('Y-m-d');
				$wpdb->query(
					$wpdb->prepare(
						"DELETE FROM $table_name WHERE DATE < %s",
						array($today)
					)
				);
			}
		}
	}

	return true;
} );


/**
 * Отправляем ЛИД в битрикс
 */
function curlSendLead($leadInfo){
	$curl = curl_init();
	$options = [
		CURLOPT_URL => 'https://api.kontur-center.ru/leadFromToSite/?INTEGRATION=leads',
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => json_decode($leadInfo, true),
		CURLOPT_USERAGENT => 'api',
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER => false,
		CURLOPT_FORBID_REUSE => true,
		CURLOPT_CONNECTTIMEOUT => 120,
		CURLOPT_TIMEOUT => 120,
		CURLOPT_FRESH_CONNECT => true,
	];
	curl_setopt_array($curl, $options);
	$res = curl_exec($curl);
	curl_close($curl);
	return $res;
}