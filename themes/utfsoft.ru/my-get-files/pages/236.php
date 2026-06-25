<?php

$device_security = [
        [
                "title" => "Безопасность рабочих устройств",
                "desc" => "Dr.Web Desktop Security Suite обеспечивает надёжную защиту рабочих устройств — включая виртуальные машины, терминальные клиенты и серверные виртуальные среды. Решение легко масштабируется и даёт администраторам полный контроль над политиками безопасности. Серверные компоненты работают под управлением Linux.",
                "link" => "/workstations/"
        ],
        [
                "title" => "Dr.Web Server Security Suite",
                "desc" => "Современное решение для оптимизации безопасности виртуальных сред. Часть функций переносится в отдельную сервисную виртуальную машину, что позволяет эффективнее распределять ресурсы и повышать степень защиты виртуальных машин на общем хосте.",
                "link" => "/fileserver/"
        ],
        [
                "title" => "Dr.Web Mail Security Suite",
                "desc" => "Dr.Web Mail Security Suite помогает работать в соответствии со всеми требованиями по антивирусной защите ИСПДн (до 1 уровня включительно), по ГИС (до 1 класса включительно), а также по системам, работающим с гостайной и по объектам критической информационной инфраструктуры до высшей категории.",
                "link" => "/mailserver/"
        ],
        [
                "title" => "Dr.Web Gateway Security Suite",
                "desc" => "Данный продукт отвечает за безопасность интернет-шлюза организации. Решение позволяет просматривать входящий и исходящий трафик, нейтрализовать вредоносные объекты, а также минимизировать риск заражений и обеспечивать высокий уровень безопасности для работы сотрудников в интернете.",
                "link" => "/gateway/"
        ],
        [
                "title" => "Планшеты, «умные телевизоры» и телефоны",
                "desc" => "Dr.Web Mobile Security Suite обеспечивает защиту смартфонов, планшетов и SmartTV на платформах Android и Android TV, защищая корпоративные данные и пользовательскую среду сотрудников.",
                "link" => "/mobile/"
        ],
        [
                "title" => "Превосходная проактивная защита",
                "desc" => "Dr.Web Katana (Business Edition) — набор современных антивирусных технологий следующего поколения. Он рассчитан на превентивную защиту: обнаруживает и блокирует угрозы, о которых традиционный антивирус ещё не знает.",
                "link" => "/katana/"
        ],
]

?>
<section class="page-236 banner rg-banner pt-0">
    <div class="container">
        <div class="content d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="wrapper order-1">
                <h1 class="pb-3 pb-sm-4 title order-1 text-center text-md-start">
                    Dr.Web решения для комплексной защиты
                </h1>
                <p class="desc text-center text-md-start order-3">
                    Продуктовая линейка «Доктор Веб» для бизнеса помогает построить оптимальную систему информационной
                    безопасности, подходящую под размеры, задачи и особенности вашей организации.
                </p>
                <button class="btn order-4 popClick" data-pop="banner-pop">Получить консультацию</button>
            </div>
            <img src="/wp-content/themes/utfsoft.ru/assets/img/pages/236/banner.svg"
                 alt="Dr.Web  решения для комплексной защиты"
                 class="image order-2 mb-3 mb-sm-4 mb-md-0 w-auto">
        </div>
    </div>
    <!--noindex-->
    <!--googleoff: all-->
    <div class="popup" data-max-width="650" id="banner-pop">
        <div class="pop html br-2 bg-white">
            <p class="title h3 pb-3">Dr.Web решения для комплексной защиты</p>
            <p class="desc mb-4">Оставьте контактные данные, и мы свяжемся с вами в ближайшее время.</p>
            <div class="form-right">
                <?= do_shortcode('[contact-form-7 id="4126bc3" title="/drweb/ форма Dr.Web"]') ?>
            </div>
        </div>
    </div>
    <!--googleon: all-->
    <!--/noindex-->
</section>
<section class="page-236 device-security">
    <div class="container">
        <div class="content bg-gray p-sm-40 p-3 br-2">
            <h2 class="pb-sm-40 pb-3 constrain-lg">
                Не беспокойтесь за безопасность устройств компании
            </h2>
            <div class="items grid rg-grid-column-lg-2 gap-xl-50 gap-lg-4 gap-3">
                <?php
                foreach ($device_security as $item): ?>
                    <div class="item p-3 p-sm-4 bg-white br-2 d-flex flex-column align-items-start">
                        <img src="/wp-content/themes/utfsoft.ru/assets/img/pages/236/dr-web.svg"
                             class="w-auto d-block mb-sm-4 mb-3" alt="<?= $item["title"] ?>">
                        <p class="subtitle"><?= $item["title"] ?></p>
                        <p class="mb-sm-4 mb-3">
                            <?= $item["desc"] ?>
                        </p>
                        <a href="<?= $item['link'] ?>" class="btn btn_link mt-auto"><span class="arrow"></span></a>

                    </div>
                <?php endforeach;
                ?>
            </div>
        </div>
    </div>
</section>
<section class="page-236 drweb-biz-protect">
    <div class="container">
        <div class="content d-flex justify-content-between flex-column flex-md-row">
            <div class="wrapper order-1">
                <h2 class="pb-4 pb-sm-40 order-1 pb-lg-50 text-center text-md-start">
                    Dr.Web для профессиональной защиты бизнеса
                </h2>
                <p class="mb-40 mb-md-4 mb-lg-40 order-3">
                    Линейка продуктов «Доктор Веб» для бизнеса помогает выстроить персонализированную систему
                    информационной безопасности — под ваши цели, объём инфраструктуры и специфику рабочих процессов.
                </p>
                <button class="btn mx-auto justify-content-center d-flex mx-md-0 order-4 popClick"
                        data-pop="banner-pop">Отправить заявку
                </button>
            </div>
            <picture class="image order-2">
                <source media="(max-width:430.98px)" srcset=""
                        data-srcset="/wp-content/themes/utfsoft.ru/assets/img/pages/236/drweb-biz-protect-430.png">
                <source media="(max-width:767.98px)" srcset=""
                        data-srcset="/wp-content/themes/utfsoft.ru/assets/img/pages/236/drweb-biz-protect-768.png">
                <source media="(max-width:991.98px)" srcset=""
                        data-srcset="/wp-content/themes/utfsoft.ru/assets/img/pages/236/drweb-biz-protect-992.png">
                <source media="(max-width:1199.98px)" srcset=""
                        data-srcset="/wp-content/themes/utfsoft.ru/assets/img/pages/236/drweb-biz-protect-1200.png">
                <source media="(max-width:1399.98px)" srcset=""
                        data-srcset="/wp-content/themes/utfsoft.ru/assets/img/pages/236/drweb-biz-protect-1400.png">
                <img src="" data-src="/wp-content/themes/utfsoft.ru/assets/img/pages/236/drweb-biz-protect.png"
                     class="lazy w-auto mx-auto mx-md-0 d-block max-width-100 mb-40 mb-md-0"
                     alt="Dr.Web для профессиональной защиты бизнеса">
            </picture>
        </div>
    </div>
</section>
<?= do_shortcode('[rg-code f="repeat-elements/feedback-form.php"]') ?>
