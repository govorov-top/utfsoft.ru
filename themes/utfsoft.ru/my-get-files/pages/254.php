<?php
$mobile_security = [
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/254/mobile-security-1.png",
		"title" => "Передовые механизмы",
		"desc" => "Выявляет и нейтрализует даже самые свежие и скрытые угрозы для Android-устройств",
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/254/mobile-security-2.png",
		"title" => "Блокировка фишинга и мошенничества",
		"desc" => "Блокирует переходы на вредоносные страницы и препятствует попыткам кражи учетных данных",
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/254/mobile-security-3.png",
		"title" => "Сохранение приватности",
		"desc" => "Охраняет личную информацию и предотвращает несанкционированный доступ к конфиденциальным данным на мобильных устройствах",
	]
];
$drweb_products = [
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/254/drweb-products-1.png",
		"title" => "Функционал для Android-устройств",
		"list" => [
			"Анализ файлов, полученных через мобильную сеть, Bluetooth, Wi-Fi, USB и во время синхронизации с компьютером",
			"Модуль поиска уязвимостей операционной системы и приложений",
			"Параллельное сканирование с распределением нагрузок по ядрам процессора для более быстрого обнаружения угроз",
			"Возможность включать или отключать постоянное сканирование внешних накопителей",
			"Механизмы самовосстановления работоспособности после сбоев",
			"Два варианта сканирования: полный аудит системы и выборочная проверка отдельных разделов",
			"Сканирование по запросу всей системы файлов или ее отдельных компоненто",
			"Проверка содержимого архивов и установочных пакетов (APK, ZIP, RAR, JAR и др.",
		]
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/254/drweb-products-2.png",
		"title" => "Функции для «Аврора»",
		"list" => [
			"Инструменты от Dr.Web Origins Tracing™ для распознавания и анализа новейших образцов вредоносного ПО",
			"Сбор детальной статистики работы: записи о событиях сканирования, обновлениях баз вирусных сигнатур, принятых мерах против обнаруженных угроз и общий журнал операций",
			"Автоматизированный доступ к описаниям и деталям обнаруженных угроз на портале производителя",
			"Перемещение обнаруженных вредоносных объектов в карантин с опцией последующего восстановления файлов и приложений",
			"Установка на правах администратора с возможностью блокирования удаления пользователем устройств",
		]
	]
]
?>
<section class="page-254 banner rg-banner pt-0">
    <div class="container">
        <div class="content d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="wrapper order-1">
                <h1 class="pb-3 pb-sm-4 title order-1 text-center text-md-start">
                    Безопасность планшетов, телефонов и ТВ
                </h1>
                <p class="desc text-center text-md-start order-3">
                    Продукт предназначен для комплексной защиты смартфонов, планшетов и Smart TV, работающих на базе
                    Android и Android TV
                </p>
                <button class="btn order-4 popClick"
                        data-pop="banner-pop"
                        data-form-title="ЮТФ Софт - консультация по 'Безопасность планшетов, телефонов и ТВ'"
                >Получить консультацию
                </button>
            </div>
            <img src="/wp-content/themes/utfsoft.ru/assets/img/pages/254/banner.svg"
                 alt="Безопасность планшетов, телефонов и ТВ"
                 class="image order-2 mb-3 mb-sm-4 mb-md-0 w-auto">
        </div>
    </div>
    <!--noindex-->
    <!--googleoff: all-->
    <div class="popup" data-max-width="650" id="banner-pop">
        <div class="pop html br-2 bg-white">
            <p class="title h3 pb-3">Безопасность планшетов, телефонов и ТВ</p>
            <p class="desc mb-4">Оставьте контактные данные, и мы свяжемся с вами в ближайшее время.</p>
            <div class="form-right">
				<?= do_shortcode('[contact-form-7 id="4126bc3" title="/drweb/ форма Dr.Web"]') ?>
            </div>
        </div>
    </div>
    <!--googleon: all-->
    <!--/noindex-->
</section>
<section class="page-254 mobile-security">
    <div class="container">
        <h2 class="text-center pb-xl-50 px-40">Полная безопасность ваших мобильных устройств в одном решении</h2>
        <div class="items grid rg-grid-column-lg-3 gap-xl-50 gap-4">
			<?php foreach ($mobile_security as $item) : ?>
                <div class="item p-3 p-sm-4 bg-gray br-3">
                    <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" class="w-auto d-block mb-4">
                    <p class="subtitle"><?= $item['title'] ?></p>
                    <p class="desc mb-0"><?= $item['desc'] ?></p>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</section>
<section class="page-254 drweb-products">
    <div class="container">
        <h2 class="text-center pb-xl-50 pb-40">Продуктовая линейка Dr.Web</h2>
        <div class="items grid rg-grid-column-lg-2 gap-xl-50 gap-4">
			<?php foreach ($drweb_products as $item) : ?>
                <div class="item p-3 p-sm-4 bg-gray br-3">
                    <div class="image-wrap bg-white br-3 px-40 pt-40 mb-4">
                        <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" class="w-auto d-block mx-auto">
                    </div>
                    <p class="subtitle"><?= $item['title'] ?></p>
                    <ul class="rg-list pb-0">
						<?php foreach ($item['list'] as $list) : ?>
                            <li><?= $list ?></li>
						<?php endforeach; ?>
                    </ul>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</section>
<?= do_shortcode('[rg-code f="repeat-elements/feedback-form.php"]') ?>
