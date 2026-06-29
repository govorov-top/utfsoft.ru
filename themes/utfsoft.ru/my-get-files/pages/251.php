<?php
$products_integration = [
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/251/products-integration-1.png",
		"title" => "Dr.Web Gateway Security Suite (интеграция с Kerio)",
		"list" => [
			"Комплексная защита доступа в сеть для частных лиц и организаций любых масштабов и направлений деятельности",
			"Поддержка централизованного управления при использовании специального Центра управления от Dr.Web",
			"Управление функциями через консоль администратора Kerio для удобства администрирования",
			"Сокращение времени проверки и повышение стабильности работы благодаря параллельному сканированию",
		]
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/251/products-integration-2.png",
		"title" => "Dr.Web Gateway Security Suite (вариант для UNIX-платформ",
		"list" => [
			"Широкий набор инструментов для защиты от угроз, скрывающихся в веб-поток",
			"Обработка трафика с использованием протокола ICAP с минимальным влиянием на скорость передачи данных",
			"Пропуск в сеть только проверенного контента, исключая заражённые объекты",
			"Надёжная защита от проникновения вредоносных программ всех типо",
		]
	]
];
$licenses_certs = [
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/243/licenses-certs-1.png",
		"title" => "Сертификаты ФСТЭК России"
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/243/licenses-certs-2.png",
		"title" => "Сертификаты Минобороты России"
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/243/licenses-certs-3.png",
		"title" => "Лицензии и Сертификаты ФСБ"
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/243/licenses-certs-4.png",
		"title" => "Продукты Dr.Web в Реестре отечественного ПО"
	],
];
$drweb_ru_compat = [
	"МСВС",
	"Альт Линукс",
	"Альт 8СП",
	"Astra Linux",
	"Байкал",
	"ОС ROSA Enterprise",
	"ОС РОСА КОБАЛЬТ",
	"Ред ОС",
	"ОС Аврора",
	"Эльбрус",
]
?>

<section class="page-251 banner rg-banner pt-0">
    <div class="container">
        <div class="content d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="wrapper order-1">
                <h1 class="pb-3 pb-sm-4 title order-1 text-center text-md-start">
                    Dr.Web Gateway Security Suite
                </h1>
                <p class="desc text-center text-md-start order-3">
                    Программа предназначена для защиты сетевых-шлюзов организации. Она проверяет входящий и исходящий
                    поток данных в сети на вирусы и другие угрозы. Благодаря этому снижается риск заражения компьютеров,
                    блокируется доступ к опасным сайтам и повышается уровень безопасности повседневной работы работников
                    в интернете.
                </p>
                <button class="btn order-4 popClick"
                        data-pop="banner-pop"
                        data-form-title="ЮТФ Софт - консультация по 'Dr.Web Gateway Security Suite'"
                >Получить консультацию
                </button>
            </div>
            <img src="/wp-content/themes/utfsoft.ru/assets/img/pages/251/banner.svg"
                 alt="Dr.Web Gateway Security Suite"
                 class="image order-2 mb-3 mb-sm-4 mb-md-0 w-auto">
        </div>
    </div>
    <!--noindex-->
    <!--googleoff: all-->
    <div class="popup" data-max-width="650" id="banner-pop">
        <div class="pop html br-2 bg-white">
            <p class="title h3 pb-3">Dr.Web Gateway Security Suite</p>
            <p class="desc mb-4">Оставьте контактные данные, и мы свяжемся с вами в ближайшее время.</p>
            <div class="form-right">
				<?= do_shortcode('[contact-form-7 id="4126bc3" title="/drweb/ форма Dr.Web"]') ?>
            </div>
        </div>
    </div>
    <!--googleon: all-->
    <!--/noindex-->
</section>
<section class="page-251 products-integration">
    <div class="container">
        <h2 class="text-center pb-xl-50 pb-40">
            Продуктовая линейка и интеграция
        </h2>
        <div class="items grid rg-grid-column-lg-2 gap-xl-50 gap-4">
			<?php foreach ($products_integration as $item) : ?>
                <div class="item p-3 p-sm-4 br-3 bg-gray">
                    <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" class="d-block mb-4 w-auto">
                    <p class="subtitle"><?= $item['title'] ?></p>
                    <ul class="rg-list pb-0">
						<?php foreach ($item['list'] as $list) : ?>
                            <li class="item"><?= $list ?></li>
						<?php endforeach; ?>
                    </ul>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</section>
<section class="page-251">
    <div class="container">
        <h2 class="pb-40">
            Сферы применения и соответствие требованиям
        </h2>
        <p class="mb-40">
            Решение подходит для организаций с повышенными требованиями к информационной безопасности. Оно учитывает все
            требования законодательства нашей страны в области ИБ; подтверждено сертификатами ФСБ и ФСТЭК
        </p>
        <p class="subtitle">Ключевые возможности</p>
        <ul class="rg-list check pb-40">
            <li>Разделение прав доступа к веб-ресурсам по ролям и пользовательским группам.</li>
            <li>Обработка множественных запросов в рамках одного сеанса связи для повышения пропускной способности</li>
            <li>Антивирусный анализ FTP- и HTTP-трафика для раннего обнаружения угро</li>
            <li>Ограничение доступа по MIME-типу, размеру файлов и по доменным именам хостов</li>
            <li>Ускорение проверки контента с помощью Preview</li>
            <li>Контекстная обработка объектов с применением различных действий в зависимости от типа файла</li>
            <li>Перемещение заражённых файлов в карантин с возможностью их последующего восстановления или удаления</li>
            <li>Формирование понятных и информативных отчётов для администраторов</li>
            <li>Поддержка IPv4 и IPv6 для работы в современных сетях</li>
            <li>Меры по предотвращению несанкционированного доступа к шлюзу и его настройкам</li>
            <li>Мониторинг состояния сервиса и автоматическое восстановление работоспособности при сбоях.</li>
            <li>Уведомления для пользователей и администраторов о попытках перехода на подозрительные страницы или при
                обнаружении вредоносного ПО.
            </li>
        </ul>
        <button class="btn popClick"
                data-pop="banner-pop"
                data-form-title="ЮТФ Софт - консультация по 'Dr.Web Gateway Security Suite'"
        >Отправить заявку
        </button>
    </div>
</section>
<section class="page-251 licenses-certs">
    <div class="container">
        <h2 class="text-center pb-xl-50 pb-40">
            Все лицензии и сертификаты
        </h2>
        <div class="items grid rg-grid-column-xl-4 rg-grid-column-md-2 gap-xl-50 gap-sm-4 gap-3">
			<?php foreach ($licenses_certs as $item) : ?>
                <div class="item p-3 p-sm-4 bg-gray br-3">
                    <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>"
                         class="mb-4 mx-auto max-width-100 w-auto d-block">
                    <p class="strong text-center"><?= $item['title'] ?></p>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</section>
<section class="page-251 drweb-ru-compat">
    <div class="container">
        <h2 class="pb-xl-50 pb-40">
            Dr.Web совместим с российскими <br class="d-none d-sm-block"> ОС и оборудованием
        </h2>
        <div class="items d-flex gap-3 flex-wrap">
			<?php foreach ($drweb_ru_compat as $item): ?>
                <div class="item br-5">
                    <p class="mb-0 "><?= $item ?></p>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</section>
<?= do_shortcode('[rg-code f="repeat-elements/feedback-form.php"]') ?>
