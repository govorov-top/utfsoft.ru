<?php
$product_lines = [
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/243/product-lines-1.png",
		"title" => "Dr.Web Mail Security Suite для Microsoft Exchange",
		"list" => [
			"Имеет подтверждающие документы ФСТЭК",
			"Сведения о продукте включены в перечень российского ПО",
			"Способствует выполнению требований по информационной безопасности для систем разного уровня: от данных о физических лицах и госсистем до объектов с гостайной и критической инфраструктуры.",
		]

	],
	[
		"img" => "/wp-content/themes/utfsoft.ru/assets/img/pages/243/product-lines-2.png",
		"title" => "Dr.Web Mail Security Suite для UNIX",
		"list" => [
			"Имеет подтверждающие документы ФСТЭК и ФСБ.",
			"Сведения о продукте включены в перечень российского ПО",
			"Способствует выполнению требований по информационной безопасности для систем разного уровня: от данных о физических лицах и госсистем до объектов с гостайной и критической инфраструктуры",
			"Совместим с отечественными ОС и аппаратными платформами, включая процессоры «Байкал‑Т1», «Эльбрус» и решения на базе ARM64.",
		]

	],
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
<section class="page-243 banner rg-banner pt-0">
    <div class="container">
        <div class="content d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="wrapper order-1">
                <h1 class="pb-3 pb-sm-4 title order-1 text-center text-md-start">
                    Dr.Web Mail Security Suite
                </h1>
                <p class="desc text-center text-md-start order-3">
                    Контролирует соответствие всем установленным требованиям по антивирусной защите: покрывает ИСПДн до
                    первого уровня, ГИС до первого класса, защищает системы, обрабатывающие сведения с пометкой
                    «гостайна», и обеспечивает безопасность КИИ, включая объекты высшей категории.
                </p>
                <button class="btn order-4 popClick"
                        data-pop="banner-pop"
                        data-form-title="ЮТФ Софт - консультация по 'Dr.Web Mail Security Suite'"
                >Получить консультацию
                </button>
            </div>
            <img src="/wp-content/themes/utfsoft.ru/assets/img/pages/243/banner.svg"
                 alt="Dr.Web Mail Security Suite"
                 class="image order-2 mb-3 mb-sm-4 mb-md-0 w-auto">
        </div>
    </div>
    <!--noindex-->
    <!--googleoff: all-->
    <div class="popup" data-max-width="650" id="banner-pop">
        <div class="pop html br-2 bg-white">
            <p class="title h3 pb-3">Dr.Web Mail Security Suite</p>
            <p class="desc mb-4">Оставьте контактные данные, и мы свяжемся с вами в ближайшее время.</p>
            <div class="form-right">
				<?= do_shortcode('[contact-form-7 id="4126bc3" title="/drweb/ форма Dr.Web"]') ?>
            </div>
        </div>
    </div>
    <!--googleon: all-->
    <!--/noindex-->
</section>
<section class="page-243 product-lines">
    <div class="container">
        <h2 class="text-center pb-xl-50 pb-40">
            Линейки продуктов
        </h2>
        <div class="items grid rg-grid-column-lg-2 gap-xl-50 gap-lg-4 gap-3">
			<?php foreach ($product_lines as $item) : ?>
                <div class="item p-3 p-sm-4 bg-gray br-3">
                    <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" class="mb-4 w-auto d-block">
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
<section class="page-243">
    <div class="container">
        <div class="constrain-lg">
            <h2 class="pb-40">Почему важна защита почтового трафика</h2>
            <p class="mb-40">
                Работа электронной почты напрямую влияет на все ключевые бизнес‑процессы. Если почтовая система плохо
                защищена или перегружена спамом и вредоносными письмами, это тормозит коммуникации, повышает риски
                утечек и увеличивает расходы на восстановление.
            </p>
            <p class="subtitle">Какие задачи решает антивирус</p>
            <ul class="rg-list check pb-40">
                <li>Значительно уменьшает поток спама и вредоносных писем, проникающих в корпоративную сеть.</li>
                <li>Ускоряет поступление официальной корреспонденции благодаря оптимизации нагрузки и предварительной
                    фильтрации угроз.
                </li>
                <li>Обнаруживает и устраняет новые, ранее не выявленные вредоносные программы непосредственно на
                    почтовом сервере, не допуская их попадания в ящики пользователей.
                </li>
            </ul>
            <p>Только полноценная защита почтового сервера позволяет исключить ситуацию, когда сервер сам становится
                источником заражений и рассылки вредоносного кода внутри компании.</p>
            <p class="mb-40">Применение решения от Dr.Web для почты минимизирует оперативные издержки и повышает
                качество
                работы: меньше простоев, меньше инцидентов и быстрее восстановление при угрозах.</p>
            <button class="btn popClick"
                    data-pop="banner-pop"
                    data-form-title="ЮТФ Софт - консультация по 'Dr.Web Mail Security Suite'"
            >Отправить заявку
            </button>
        </div>
    </div>
</section>
<section class="page-243 licenses-certs">
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
<section class="page-243 drweb-ru-compat">
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
