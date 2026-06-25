<?php
$avail_solutions = [
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/241/avail-solutions-1.png",
		"title" => "Dr.Web Server Security Suite (для macOS Server)",
		"list" => [
			"Удобный центр управления",
			"Высокая скорость сканирования",
			"Возможность создания собственных профилей сканирования",
			"Надежная защита в режиме реального времени",
			"Минимальная нагрузка на защищаемую систему",
		]
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/241/avail-solutions-2.png",
		"title" => "Dr.Web Server Security Suite (для Windows)",
		"list" => [
			"Высокая производительность и устойчивость рабочих процессов.",
			"Быстрая проверка файлов при низкой системной нагрузке.",
			"Высокий уровень защиты от известных угроз.",
			"Качественное восстановление повреждённых файлов.",
			"Усиленные средства самозащиты процессов и конфигураций.",
		]
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/241/avail-solutions-3.png",
		"title" => "Dr.Web Server Security Suite (для macOS Server)",
		"list" => [
			"Многопоточная проверка",
			"Мгновенное оповещение администратора",
			"Изоляция инфицированных файлов в карантине",
			"Лечение, восстановление и/или удаление файлов из карантина",
			"Ведение журнала действий антивируса",
		]
	],
];

$why_protect_infra = [
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/241/why-protect-infra-1.png",
		"title" => "Новые, ещё не выявленные вирусы",
		"desc" => "Пользователь может занести в сеть неизвестный образец вируса (с флешки или из облачного хранилища). Антивирус с эвристикой и поведенческим анализом выявит и локализует угрозу, а при необходимости проведёт лечение при следующем обновлении."
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/241/why-protect-infra-2.png",
		"title" => "Взломы",
		"desc" => "В случае попытки компрометации сервера антивирусные механизмы обнаружат и нейтрализуют вредоносные модули. При централизованном управлении администратор получает мгновенные уведомления о критических изменениях, например о попытках остановить защитную систему."
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/241/why-protect-infra-3.png",
		"title" => "Внешние носители и хранилища",
		"desc" => "Флеш‑накопители и переносные диски остаются распространённым источником заражений, особенно при смешанном режиме работы (офис — дом). Защита серверов предотвращает перенос угроз с таких носителей в корпоративную сеть."
	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/241/why-protect-infra-4.png",
		"title" => "Телефоны",
		"desc" => "Современные смартфоны и планшеты оснащены сложными ОС и приложениями, уязвимости в которых могут служить дверью для атаки. Через мобильные устройства вредоносный код может проникнуть в сеть и добраться до серверной инфраструктуры."
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

<section class="page-241 banner rg-banner pt-0">
    <div class="container">
        <div class="content d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="wrapper order-1">
                <h1 class="pb-3 pb-sm-4 title order-1 text-center text-md-start">
                    Dr.Web Server Security Suite
                </h1>
                <p class="desc text-center text-md-start order-3">
                    Полный комплект средств для охраны серверной инфраструктуры. Решение выделяет часть сервисных
                    функций в отдельную сервисную машину, что повышает уровень защиты и снижает нагрузку на физические
                    хосты. Это позволяет эффективнее использовать оборудование и упрощает управление системой защиты.
                </p>
                <button class="btn order-4 popClick"
                        data-pop="banner-pop"
                        data-form-title="ЮТФ Софт - консультация по 'Dr.Web Server Security Suite'"
                >Получить консультацию
                </button>
            </div>
            <img src="/wp-content/themes/utfsoft.ru/assets/img/pages/239/banner.svg"
                 alt="Dr.Web Server Security Suite"
                 class="image order-2 mb-3 mb-sm-4 mb-md-0 w-auto">
        </div>
    </div>
    <!--noindex-->
    <!--googleoff: all-->
    <div class="popup" data-max-width="650" id="banner-pop">
        <div class="pop html br-2 bg-white">
            <p class="title h3 pb-3">Dr.Web Server Security Suite</p>
            <p class="desc mb-4">Оставьте контактные данные, и мы свяжемся с вами в ближайшее время.</p>
            <div class="form-right">
				<?= do_shortcode('[contact-form-7 id="4126bc3" title="/drweb/ форма Dr.Web"]') ?>
            </div>
        </div>
    </div>
    <!--googleon: all-->
    <!--/noindex-->
</section>
<section class="page-241 avail-solutions">
    <div class="container">
        <h2 class="pb-xl-50 pb-sm-40 pb-4 text-center">
            Доступные решения
        </h2>
        <div class="items grid rg-grid-column-lg-3 gap-xl-50 gap-lg-4 gap-3">
			<?php foreach ($avail_solutions as $item): ?>
                <div class="item p-3 p-sm-4 bg-gray br-2 ">
                    <img src="<?= $item["img"] ?>" class="w-auto d-block mb-4" alt="<?= $item["title"] ?>">
                    <p class="subtitle">
						<?= $item["title"] ?>
                    </p>
                    <ul class="rg-list pb-0">
						<?php foreach ($item["list"] as $list): ?>
                            <li><?= $list ?></li>
						<?php endforeach; ?>
                    </ul>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</section>
<section class="page-241">
    <div class="container">
        <h2 class="pb-xl-50 pb-40">
            В чем плюсы решения от Dr.Web
        </h2>
        <ul class="rg-list pb-xl-50 pb-40 check">
            <li>Поддержка широкого спектра российских и международных ОС: ROSA, МСВС, Альт Линукс, Astra Linux, Аврора,
                Ред ОС Муром и другие.
            </li>
            <li>Бесшовное взаимодействие с отечественными процессорными платформами «Эльбрус» и «Байкал», а также с
                архитектурами ARM64.
            </li>
            <li>Интеллектуальное распределение вычислительных ресурсов снижает нагрузку на хост‑системы.</li>
            <li>Системы автоматического обнаружения и устранения инцидентов работают с применение технологий
                искусственного интеллекта. Многоуровневый анализ аномалий повышает устойчивость системы к новым,
                неизученным угрозам.
            </li>
            <li>Архитектура с выделенной сервис‑машиной для сканирования разгружает основной хост. ресурсоёмкие проверки
                выполняются отдельно, поэтому виртуальные гости сохраняют вычислительную мощность для рабочих задач. Это
                повышает производительность и стабильность, сокращает потребление CPU и ОЗУ на серверах и уменьшает
                потребность в частых апгрейдах и покупке дополнительного оборудования.
            </li>
        </ul>
        <button class="btn popClick"
                data-pop="banner-pop"
                data-form-title="ЮТФ Софт - консультация по 'Dr.Web Server Security Suite'"
        >Отправить заявку
        </button>
    </div>
</section>
<section class="page-241 why-protect-infra">
    <div class="container">
        <div class="content bg-gray p-3 p-sm-40 br-2">
            <div class="constrain-lg mb-40 mx-auto">
                <h2 class="pb-40">
                    Зачем защищать файловые серверы и инфраструктуру
                </h2>
                <p class="mb-0">
                    Часто внимание ИТ‑отделов сосредоточено именно на рабочих станциях, тогда как серверы, телефоны и
                    личные компьютеры сотрудников остаются уязвимыми. Это увеличивает риск того, что вредоносное ПО,
                    попавшее на рабочую станцию, распространится на серверы с важными данными.
                </p>
            </div>
            <div class="items grid rg-grid-column-lg-2 gap-xl-50 gap-lg-4 gap-3">
				<?php foreach ($why_protect_infra as $item): ?>
                    <div class="item p-3 p-sm-4 bg-white br-2">
                        <img src="<?= $item["img"] ?>" class="w-auto d-block mb-4" alt="<?= $item["title"] ?>">
                        <p class="subtitle">
							<?= $item["title"] ?>
                        </p>
                        <p class="mb-0">
							<?= $item["desc"] ?>
                        </p>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<section class="page-241 drweb-ru-compat">
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
