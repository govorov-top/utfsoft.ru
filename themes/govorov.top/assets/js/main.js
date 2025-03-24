"use strict";

/******************************
 * import Libs
 * Инициализация bootstrap компонентов
 * Показ квиза при первом посещении сайта
 * Snowflake
 * LazyLoad
 * Собираем данные сквозной аналитики Битрикс
 * Кнопки на чаты
 * Меняем дату на всем сайте внутри тегов с классом rg-today-date
 * Антиспам
 * Плавный scroll к маяку (Beacon) по клику на *[data-scroll-beacon]
 * Ссылка на блок
 * PopUp
 * Калькулятор квиз - опрос
 * Слайдер акций .RGActionsBanners
 * Определение региона пользователя
 * Настройка меню
 * - Мобильное меню
 * [CF7] Валидация
 * [Lib Swiper] Слайдеры
 * Действия на определенных страницах
 * - Вызов функций яндекс метрики
 * - Обновляем инфу в зависимости от региона
 * - По клику показать номер, предлагаем телефон на выбор
 * - Манипуляции с кнопкой ВХОД
 * - Главная страница
 * - Страница: /tariffs/
 * - Страница: /edo-v-logistike/
 * - Страница: /integrations/1c/
 * - Страница: /actions/
 * - Страница: /vidy-edo/medo/
 * - Страница: /edo-dlya-retail/
 * Functions
 * - Цели Яндекс.Метрики
 * - При наведении на элемент вешаем класс
 * - Функция для получения кук
 * - Получить GET параметр
 * - Маска для полей телефонов и ИНН
 * - Функция анимации скрытия чего-либо
 * - Функция анимации появления чего-либо
 * - Блок с .adaptive-video
 *******************************/

/* import Libs */
import LazyLoad from "vanilla-lazyload";
import swal from "sweetalert";

import { initializeAll } from "./components/bootstrap";
import { RGActionsBanners } from "./components/RGActionsBanners";
import IMask from "imask";
import Swiper from "swiper";
import { Autoplay, Navigation, Pagination } from "swiper/modules";
import { snowflake } from "./components/snowflake";
import PopUp from "./components/popUp";
import { hoverElAddCustomClass } from "./components/hoverElAddCustomClass";
import { vhodGame } from "./components/vhodGame";
import chatButtons from "./components/chatButtons";
import DefineUserRegion from "./components/DefineUserRegion";
import { AutoShowQuiz } from "./components/AutoShowQuiz";

document.addEventListener("DOMContentLoaded", () => {
    /* Инициализация bootstrap компонентов */
    initializeAll();

    /* Показ квиза при первом посещении сайта */

    AutoShowQuiz({
        btnSelector: ".btn.popClick[data-pop=brief_popUp]",
        modalSelector: "#brief_popUp",
    });

    /* Snowflake */
    if (document.body.classList.contains("rg-ny")) snowflake();

    /* LazyLoad */

    const lazyLoadInstance = new LazyLoad({
        // Your custom settings go here
    });

    /* Собираем данные сквозной аналитики Битрикс */

    setTimeout(() => {
        if (b24Tracker) {
            const btnCF7Bitrix24 = document.querySelectorAll(".wpcf7-form-control.wpcf7-submit");
            btnCF7Bitrix24.forEach(clickBtn => {
                clickBtn.onmouseover = function () {
                    let traceInput = this.closest("form").querySelector('input[name="TRACE"]');
                    if (traceInput) {
                        traceInput.value = b24Tracker.guest.getTrace();
                    }
                };
            });
        }
    }, 1000);

    /* Кнопки на чаты */
    const chatData = [
        {
            link: "https://vk.me/kontur_center",
            icon: "/wp-content/themes/govorov.top/assets/img/widgets/chat-buttons/vk-icon.svg",
            class: "vk",
            color: "#4C75A3",
        },
        {
            link: `https://api.whatsapp.com/send?phone=74952258118&text=Добрый%20день!%20Я%20с%20сайта%20${window.location.hostname}.%20У%20меня%20вопрос%20...`,
            icon: "/wp-content/themes/govorov.top/assets/img/widgets/chat-buttons/whatsapp-icon.svg",
            class: "whatsapp",
            color: "#25D366",
            popup: 1,
        },
        {
            link: "https://t.me/NITbuss_bot",
            icon: "/wp-content/themes/govorov.top/assets/img/widgets/chat-buttons/telegram-icon.svg",
            class: "telegram",
            color: "#0088CC",
        },
    ];
    chatButtons(chatData);

    /* Меняем дату на всем сайте внутри тегов с классом rg-today-date */

    const rgTodayDate = document.querySelectorAll(".rg-today-date");
    if (rgTodayDate.length > 0) {
        rgTodayDate.forEach(el => {
            const now = new Date();
            el.innerText = now.getFullYear();
        });
    }

    /* Плавный scroll к маяку (Beacon) по клику на *[data-scroll-beacon] */

    const btnScrollBeacon = document.querySelectorAll("*[data-scroll-beacon]");
    if (btnScrollBeacon.length > 0) {
        btnScrollBeacon.forEach(el => {
            el.addEventListener("click", () => {
                let where = el.getAttribute("data-scroll-beacon");
                let top = 150;
                let scrollTarget = document.getElementById(where);
                if (scrollTarget) {
                    scrollTarget = scrollTarget.getBoundingClientRect();
                    const headerActionBanner = document.querySelector("header.header .actions-box");
                    window.scrollBy({
                        top: headerActionBanner
                            ? scrollTarget.top - headerActionBanner.offsetHeight
                            : scrollTarget.top - top,
                        behavior: "smooth",
                    });
                }
            });
        });
    }

    /* Ссылка на блок */

    const btnLinkJS = document.querySelectorAll(".link-js");
    if (btnLinkJS.length > 0) {
        btnLinkJS.forEach(function (clickBtn) {
            clickBtn.style.cursor = "pointer";
            clickBtn.onclick = function () {
                const link = clickBtn.getAttribute("data-link");
                if (link) {
                    if (link.indexOf("http") >= 0) {
                        window.open(link, "_blank");
                    } else {
                        window.open("https://" + document.location.host + link);
                    }
                }
            };
        });
    }

    /* PopUp */

    /* PopUp */
    document.addEventListener("click", ({ target }) => {
        new PopUp(target.closest(".popClick"));
    });

    /* Калькулятор квиз - опрос */
    const briefQuiz = document.querySelector(".rg-brief");
    if (briefQuiz) {
        briefQuiz.onmouseover = () => {
            fadeOut(document.querySelector('.brief_btn[data-pop="brief_popUp"]'));
        };

        function pag(step, elem) {
            const el = document.querySelector('.rg-brief[data-elem="' + elem + '"]');
            if (el) {
                fadeIn(el.querySelector(".pagination .prev"));

                if (step <= 1) {
                    fadeOut(el.querySelector(".pagination .prev"));
                } else {
                    fadeIn(el.querySelector(".pagination .prev"));
                }
                if (step > 2) {
                    el.querySelector(".pagination").innerHTML = "";
                    let text = "";
                    for (let item of el.querySelectorAll(".opros .flex-box.active p.desc")) {
                        text += item.closest(".list").querySelector(".title").innerText;
                        text += `\n ${item.innerText}; \n`;
                    }
                    el.querySelector('.list[data-list="3"] input[name="tariff"]').value = text;
                    el.querySelector(".flex-box.box_2 p.steps").remove();
                    el.querySelector(".flex-box.box_2 p.h2").remove();
                    el.querySelector(".flex-box.box_2 p.desc").remove();
                    el.querySelector(".flex-box.box_2").classList.remove("justify-content-between");
                    el.querySelector(".flex-box.box_2").classList.add("justify-content-around");
                }
            }
        }

        pag(1, null);
        const btnList = briefQuiz.querySelectorAll(".opros .list .flex-box");
        btnList.forEach(el => {
            el.addEventListener("click", () => {
                el.closest(".list")
                    .querySelectorAll(".flex-box.active")
                    .forEach(el => {
                        el.classList.remove("active");
                    });
                el.classList.add("active");
            });
        });

        briefQuiz.querySelector('input[name="col_doc"]').onchange = function () {
            this.closest(".flex-box").querySelector("p.desc").innerText = this.value;
        };
        const btnPag = briefQuiz.querySelectorAll(".pagination button");
        btnPag.forEach(el => {
            el.addEventListener("click", () => {
                let calc = el.closest(".rg-brief");
                let calc_num = calc.getAttribute("data-elem");
                let btn = el.getAttribute("data-step");
                let el_count = calc.querySelector(".flex-box.box_2 .now");
                let step = parseInt(el_count.innerText);
                let el_list_active = calc.querySelector(".list.active");

                if (btn === "next") {
                    if (el_list_active.querySelector(".flex-box.active").length !== 0) {
                        step++;
                        el_list_active.classList.remove("active");
                        calc.querySelector('.opros .list[data-list="' + step + '"]').classList.add("active");
                        fadeOut(calc.querySelector(".pagination .message"));
                    } else {
                        fadeIn(calc.querySelector(".pagination .message"));
                    }
                }

                if (btn === "prev") {
                    if (step >= 2) {
                        step--;
                        el_list_active.classList.remove("active");
                        calc.querySelector('.opros .list[data-list="' + step + '"]').classList.add("active");
                    }
                }
                el_count.innerText = step;
                pag(step, calc_num);
            });
        });

        const btnGoCookie = briefQuiz.querySelector("input.wpcf7-form-control.wpcf7-submit.btn");
        btnGoCookie.addEventListener("click", () => {
            document.querySelector('.brief_btn[data-pop="brief_popUp"]').classList.add("d-none");
            document.cookie = "briefQuiz=1; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT";
        });
    }

    // Слайдер акций .RGActionsBanners
    const pathname = window.location.pathname;
    if (!pathname.includes("actions")) {
        const rgActionsBanners = document.querySelectorAll(".RGActionsBanners");
        if (rgActionsBanners && rgActionsBanners.length > 0) {
            // Все акции
            new RGActionsBanners(rgActionsBanners, [
                {
                    event: "black-friday",
                    show: "single",
                    period: {
                        start: "2022-11-20T00:00:00",
                        finish: "2022-11-27T23:59:59",
                    },
                    popup: true,
                    urlAction: "sale-10_250-and-600",
                    titleActionInPopup: "[ЧЁРНАЯ ПЯТНИЦА]",
                    titleLead: "[ЧЁРНАЯ ПЯТНИЦА] Скидка 10 % на тарифные планы «250 документов» или «600 документов».",
                    commentLead:
                        "[УСЛОВИЯ АКЦИИ] Участник акции не оплачивал ранее счета на Контур.Диадок либо последний оплаченный тарифный план закончился более 180 дней назад.\nСрок выставления счетов на данное Акционное предложение — с 21 по 29 ноября 2022 г.\nСчет на Акционное предложение, необходимо оплатить полностью по 27 декабря 2022 г.",
                },
                {
                    event: "black-friday",
                    show: "single",
                    period: {
                        start: "2022-11-20T00:00:00",
                        finish: "2022-11-27T23:59:59",
                    },
                    popup: true,
                    urlAction: "sale-20_1200-and-3000",
                    titleActionInPopup: "[ЧЁРНАЯ ПЯТНИЦА]",
                    titleLead:
                        "[ЧЁРНАЯ ПЯТНИЦА] Скидка 20 % на тарифные планы «1200 документов» или «3000 документов».",
                    commentLead:
                        "[УСЛОВИЯ АКЦИИ] Участник акции не оплачивал ранее счета на Контур.Диадок либо последний оплаченный тарифный план закончился более 180 дней назад.\nСрок выставления счетов на данное Акционное предложение — с 21 по 29 ноября 2022 г.\nСчет на Акционное предложение, необходимо оплатить полностью по 27 декабря 2022 г.",
                },
                {
                    event: "black-friday",
                    show: "single",
                    period: {
                        start: "2022-11-20T00:00:00",
                        finish: "2022-11-27T23:59:59",
                    },
                    popup: true,
                    urlAction: "sale-20_routes",
                    titleActionInPopup: "[ЧЁРНАЯ ПЯТНИЦА]",
                    titleLead: "[ЧЁРНАЯ ПЯТНИЦА] Скидка 20 % на Модуль «Маршруты согласования» сроком на 1 год.",
                    commentLead:
                        "[УСЛОВИЯ АКЦИИ] Участник акции не оплачивал ранее счета на «Маршруты согласования» Контур.Диадока.\nСрок выставления счетов на данное Акционное предложение — с 21 по 29 ноября 2022 г.\nСчет на Акционное предложение, необходимо оплатить полностью по 27 декабря 2022 г.",
                },
                {
                    event: "black-friday",
                    show: "single",
                    period: {
                        start: "2022-11-20T00:00:00",
                        finish: "2022-11-27T23:59:59",
                    },
                    popup: true,
                    urlAction: "sale-50_cadr-edo",
                    titleActionInPopup: "[ЧЁРНАЯ ПЯТНИЦА]",
                    titleLead: "[ЧЁРНАЯ ПЯТНИЦА] Скидка 50 % на сервис «Кадровый ЭДО».",
                    commentLead:
                        "[УСЛОВИЯ АКЦИИ] Участник акции не оплачивал ранее счета на сервис «Кадровый ЭДО», Модуль «Интеграция КЭДО» и АPI-лицензию сервиса «Кадровый ЭДО» Контур.Диадока.\nСрок выставления счетов на данное Акционное предложение — с 21 ноября по 1 декабря 2022 г.\nСчет на Акционное предложение, необходимо оплатить полностью по 27 декабря 2022 г.",
                },
                /* {
                     period: {
                         start: "2021-01-01T00:00:00",
                         finish: "2025-11-27T23:59:59",
                     },
                     urlAction: "bonusy-ot-diadoka",
                 },
                 {
                     period: {
                         start: "2021-01-01T00:00:00",
                         finish: "2025-11-27T23:59:59",
                     },
                     urlAction: "bezlimit-na-1-mesyac",
                 },
                 {
                     period: {
                         start: "2021-01-01T00:00:00",
                         finish: "2025-11-27T23:59:59",
                     },
                     urlAction: "gazprom-neft",
                 },*/
                {
                    period: {
                        start: "2021-01-01T00:00:00",
                        finish: "2026-11-27T23:59:59",
                    },
                    urlAction: "promo-25",
                },
                {
                    period: {
                        start: "2021-01-01T00:00:00",
                        finish: "2026-11-27T23:59:59",
                    },
                    urlAction: "1000-rubley-v-podarok",
                },
            ]);
            // Слайдер
            rgActionsBanners.forEach(slider => {
                new Swiper(slider, {
                    autoplay: true,
                    pauseOnMouseEnter: true,
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: true,
                    grabCursor: true,
                    modules: [Navigation, Autoplay],
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            });
            // Обработка клика и заполнение формы
            const clickSlider = document.querySelectorAll('a[data-pop="RGActionsBanners"]');
            if (clickSlider && clickSlider.length > 0) {
                clickSlider.forEach(el => {
                    el.addEventListener("click", () => {
                        const popUp = document.getElementById("RGActionsBanners");
                        const popUpTitle = popUp.querySelector(".title .color-text");
                        popUpTitle.innerText = el.getAttribute("data-pop-title");
                        popUp.querySelector('input[name="title"]').value = el.getAttribute("data-pop-title-lead");
                        popUp.querySelector('input[name="tariff"]').value = el.getAttribute("data-pop-comment-lead");
                    });
                });
            }
        }
    }
    /* Настройка меню */

    const headerSite = document.querySelector("header.header#header");
    if (headerSite) {
        const headerMenuSite = document.querySelector("#header nav.menu");
        if (headerMenuSite) {
            const headerFixBlock = headerSite.querySelector(".header_container");
            const headerActionsBanner = headerSite.querySelector(".RGActionsBanners");
            const isMobile = window.matchMedia("(max-width: 991.98px)").matches;
            const wpAdminBar = document.getElementById("wpadminbar");
            const mobileLogotype = headerSite.querySelector(".mobile-logotype");

            window.onscroll = () => {
                const haveClassFixed = headerFixBlock.classList.contains("fixed");
                let step = 1;
                headerSite.style.minHeight = `${headerSite.clientHeight}px`;
                if (headerActionsBanner) {
                    step = headerActionsBanner.clientHeight;
                }
                const top = window.scrollY;
                if (top > step) {
                    if (!haveClassFixed && !isMobile) {
                        headerFixBlock.classList.add("fixed");
                        if (wpAdminBar) {
                            headerFixBlock.style.top = `${wpAdminBar.clientHeight}px`;
                        }
                    }
                    if (isMobile) {
                        mobileLogotype.style.display = "none!important";
                    }
                }
                if (top < step) {
                    if (haveClassFixed && !isMobile) {
                        headerFixBlock.classList.remove("fixed");
                    }
                    if (isMobile) {
                        mobileLogotype.style.display = "none!important";
                    }
                }
            };
            // - Мобильное меню
            const mobileMenu = document.getElementById("mobileMenu");
            if (mobileMenu && isMobile) {
                const mobileMenuPaste = document.getElementById("menu-paste");
                if (mobileMenuPaste) {
                    const closeBtn = mobileMenu.querySelector("button.btn-close");
                    if (closeBtn) {
                        const btnMobileMenu = document.querySelector(".mobile-menu-button");
                        btnMobileMenu.addEventListener("click", () => {
                            if (mobileMenuPaste.innerText <= 0) {
                                let copyMenu = document.querySelector("ul.navbar-nav");
                                if (copyMenu) {
                                    mobileMenuPaste.appendChild(copyMenu);
                                } else {
                                    console.error("Меню не найдено! Замени ID в main.js");
                                }
                            }
                            const menuItems = mobileMenuPaste.querySelectorAll("li > a");
                            menuItems.forEach(link => {
                                link.addEventListener("click", () => {
                                    const attrLink = link.getAttribute("href");
                                    if (String(attrLink) && attrLink[0] === "#" && attrLink.length > 1) {
                                        closeBtn.click();
                                    }
                                });
                            });
                        });
                    }
                }
            }
        }
    }

    /* [CF7] Валидация */
    const wpcf7Forms = document.querySelectorAll("form.wpcf7-form");
    if (wpcf7Forms && wpcf7Forms.length) {
        wpcf7Forms.forEach(form => {
            // Проходим по всем элементам и собираем атрибут name
            // Это необходимо для корректной работы CF7
            const allElForm = form.querySelectorAll(".form-element");
            allElForm.forEach(el => {
                const name = el.querySelector(".wpcf7-form-control");
                if (name && "name" in name) {
                    if (name.name.length) {
                        el.setAttribute("data-name", name.name);
                    }
                }
            });
            // При клике на кнопку вырубаем, вставляем таймер
            form.addEventListener("click", ({ target }) => {
                const btnSendForm = target.closest(".wpcf7-submit");
                if (btnSendForm) {
                    let btnText = btnSendForm.innerText;
                    if (!btnText.length) {
                        btnText = btnSendForm.value;
                    }
                    setTimeout(() => {
                        btnSendForm.setAttribute("disabled", "disabled");
                    }, 1);
                    let timer;
                    let x = 5;

                    function countdown() {
                        x--;
                        if (x <= 0) {
                            btnSendForm.removeAttribute("disabled");
                            btnSendForm.value = btnText;
                            btnSendForm.innerText = btnText;
                        } else {
                            timer = setTimeout(countdown, 1000);
                            btnSendForm.value = `${x} Проверяем..`;
                            btnSendForm.innerText = `${x} Проверяем..`;
                        }
                    }

                    countdown();
                }
            });
            // При отправке формы, проверка на ошибки и тд
            form.addEventListener(
                "wpcf7submit",
                function (event) {
                    const form = document.getElementById(`${event.detail.unitTag}`);
                    const btn = form.querySelector(".wpcf7-submit");
                    const status = event.detail.status;
                    if (status === "mail_sent") {
                        const popUpClose = form.closest(".popup");
                        if (popUpClose) {
                            popUpClose.querySelector("span.close").click();
                        } else {
                            btn.value = "Отправлено!";
                            btn.setAttribute("disabled", "disabled");
                        }
                        swal({
                            title: "Отлично!",
                            text: event.detail.apiResponse.message,
                            icon: "success",
                            timer: 5000,
                            button: {
                                text: "Закрыть",
                            },
                        });
                    } else {
                        const message = event.detail.apiResponse.message;
                        const errors = event.detail.apiResponse.invalid_fields;
                        swal({
                            title: "Ошибка!",
                            text: message,
                            icon: "error",
                            timer: 5000,
                            button: {
                                text: "Исправлю..",
                            },
                        });
                        for (let key in errors) {
                            const id = errors[key].idref;
                            const el = document.getElementById(id);
                            el.classList.remove("is-valid");
                            el.classList.add("is-invalid");
                        }
                        setTimeout(() => {
                            const isValidEl = form.querySelectorAll('[aria-invalid="false"]');
                            if (isValidEl) {
                                isValidEl.forEach(el => {
                                    el.classList.remove("is-invalid");
                                    el.classList.add("is-valid");
                                });
                            }
                        }, 500);
                    }
                },
                false,
            );
        });
    }

    /* Антиспам */
    const antispam = document.querySelectorAll('input[name="agree"]');
    if (antispam.length) {
        antispam.forEach(checkbox => {
            const form = checkbox.closest("form");
            const switcher = form.querySelector(".items_soglasie .item_soglasie div");
            const sendBtn = form.querySelector(".wpcf7-submit");
            const switcherClick = () => {
                switcher.classList.toggle("active");
                checkbox.checked = !checkbox.checked;
                const changeEvent = new Event("change");
                checkbox.dispatchEvent(changeEvent);
                sendBtn.disabled = !sendBtn.disabled;
            };
            const mouseEnterForm = () => {
                if (!switcher.classList.contains("active")) {
                    switcher.classList.toggle("active");
                    checkbox.checked = !checkbox.checked;
                    const changeEvent = new Event("change");
                    checkbox.dispatchEvent(changeEvent);
                }
                if (sendBtn.disabled) {
                    sendBtn.disabled = !sendBtn.disabled;
                }
            };
            form.addEventListener("mouseenter", mouseEnterForm);
            form.addEventListener("click", mouseEnterForm);
            switcher.addEventListener("click", switcherClick);
        });
    }

    /* Маска для полей телефонов */
    const inputsPhone = document.querySelectorAll('.form-element.phone input[name="phone"]');
    if (inputsPhone.length) {
        inputsPhone.forEach(input => IMask(input, { mask: "{0} (000) 000-00-00" }));
    }
    const inputsINN = document.querySelectorAll('.form-element.inn input[name="inn"]');
    if (inputsINN.length) {
        inputsINN.forEach(input => IMask(input, { mask: "000000000000", lazy: true }));
    }
    const inputsKPP = document.querySelectorAll('.form-element.kpp input[name="kpp"]');
    if (inputsKPP.length) {
        inputsKPP.forEach(input => IMask(input, { mask: "000000000", lazy: true }));
    }

    /* [Lib Swiper] Слайдеры */
    // - Слайдер отзывов
    const swiperTestimonials = document.querySelector(".swiper-testimonials");
    if (swiperTestimonials)
        new Swiper(swiperTestimonials, {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            modules: [Pagination],
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

    /* Действия на определенных страницах */
    // - Вызов функций яндекс метрики
    // проверка цели ?_ym_debug=1
    //Header
    //Footer
    yaMetrics("#footer-widget-1 .btn", "podval_1", "onclick");
    //Страница /
    //yaMetrics(".page-id-11 .page-home.banner .btn", "home_1", "onclick");

    // - Обновляем инфу в зависимости от региона
    class replaceContacts {
        constructor(arrObjs) {
            // Если массив и больше 0
            if (arrObjs && arrObjs.length > 0) {
                // Разбираем на объекты
                for (const arrObj of arrObjs) {
                    // Получаем значения где ищем
                    this.whereLookingFor = arrObj.whereLookingFor;
                    // Если COOKIE или GET параметры переданы то идем дальше
                    if (this.whereLookingFor) {
                        if (typeof this.whereLookingFor.cookies !== "undefined") {
                            this.cookies = this.getCookies(this.whereLookingFor.cookies);
                        }
                        if (typeof this.whereLookingFor.GETs !== "undefined") {
                            this.GETs = this.gets("", this.whereLookingFor.GETs);
                        }
                    }
                    this.whatLookingFor = arrObj.whatLookingFor;
                    if (this.whatLookingFor) {
                        this.searchForMatche = this.searchForMatches(this.whatLookingFor);
                    }
                    if (this.searchForMatche) {
                        this.replaceWith = arrObj.replaceWith;
                        document.querySelectorAll(".RGphoneSHORT,.RGemailSHORT,.RGaddressSHORT").forEach(e => {
                            if (this.replaceWith.phone) {
                                const regEx = /([0-9]{11}|((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$)/gm;
                                if (e.href) e.href = e.href.replace(regEx, this.replaceWith.phone);
                                if (e.textContent) e.textContent = e.textContent.replace(regEx, this.replaceWith.phone);
                            }
                            if (this.replaceWith.email) {
                                if (e.href) e.href = e.href.replace("info@diadoc.com", this.replaceWith.email);
                                if (e.textContent)
                                    e.textContent = e.textContent.replace("info@diadoc.com", this.replaceWith.email);
                            }
                            if (this.replaceWith.address) {
                                if (e.textContent)
                                    e.textContent = e.textContent.replace(
                                        "г.Москва, Селезнёвская улица, д.11А стр.2, офис 4",
                                        this.replaceWith.address,
                                    );
                            }
                        });
                    }
                }
            } else {
                console.log("Либо не массив либо < 0");
            }
        }

        /**
         * Функция для получения кук
         * @return {string|undefined|array}
         * @param names
         */
        getCookies(names) {
            if (typeof names === "string" || typeof names === "object") {
                let matches = "";
                if (typeof names === "string") {
                    matches = document.cookie.match(
                        new RegExp("(?:^|; )" + names.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") + "=([^;]*)"),
                    );
                    return matches ? decodeURIComponent(matches[1]) : undefined;
                } else {
                    const array = [];
                    for (const name of names) {
                        matches = document.cookie.match(
                            new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") + "=([^;]*)"),
                        );
                        if (matches) {
                            array.push(decodeURIComponent(matches[1]));
                        }
                    }
                    if (array && array.length > 0) {
                        return array;
                    } else {
                        return undefined;
                    }
                }
            }
            return undefined;
        }

        /**
         * Получить GET параметр
         * @return {{v: string, k: string}|{}|boolean}
         * @param findValues
         * @param findKeys
         */
        gets(findValues = [], findKeys = []) {
            let url = window.location.search;
            const object = {};
            url = url.substring(1).split("&");
            for (let i = 0; i < url.length; i++) {
                const k = url[i].split("=")[0];
                const v = url[i].split("=")[1];
                object[k] = v;
                if (typeof findValues === "string" || typeof findKeys === "string") {
                    if (findValues || findKeys) {
                        if (findValues.includes(v) || findKeys.includes(k)) {
                            return { k, v };
                        } else {
                            return false;
                        }
                    }
                } else {
                    let i = 0;
                    let obj = {};
                    if (findValues && findValues > 0) {
                        for (const findValue of findValues) {
                            obj[i].v = findValue;
                            i++;
                        }
                    }
                    if (findKeys && findKeys > 0) {
                        for (const findKey of findKeys) {
                            obj[i].k = findKey;
                            i++;
                        }
                    }
                    return obj;
                }
            }
            return object;
        }

        /**
         * Поиск совпадений в Cookies и GET параметрах
         * @param find
         * @return {boolean}
         */
        searchForMatches(find) {
            if (find && find.length > 0) {
                for (let findElement of find) {
                    findElement = findElement.toLowerCase();
                    if (typeof this.cookies === "string") {
                        if (this.cookies.toLowerCase().includes(findElement)) {
                            return true;
                        }
                    }
                    if (typeof this.cookies === "object") {
                        for (const nameCookie of this.cookies) {
                            if (nameCookie.toLowerCase().includes(findElement)) {
                                return true;
                            }
                        }
                    }
                    if (typeof this.GETs === "string") {
                        if (this.GETs.toLowerCase().includes(findElement)) {
                            return true;
                        }
                    }
                    if (typeof this.GETs === "object") {
                        for (const get in this.GETs) {
                            if (get.k) {
                                if (get.k.toLowerCase().includes(findElement)) {
                                    return true;
                                }
                            }
                            if (get.v) {
                                if (get.v.toLowerCase().includes(findElement)) {
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    const replaceContactsGO = () => {
        return new replaceContacts([
            // Просто Москва и МО
            {
                whereLookingFor: {
                    cookies: ["utm_source", "regionUser", "cityUser"],
                    GETs: "utm_source",
                },
                whatLookingFor: ["московская", "москва"],
                replaceWith: {
                    phone: "8 (495) 108 75 67",
                    email: false,
                    address: false,
                },
            },
            // Реклама Москва и МО
            /*{
                whereLookingFor: {
                    cookies: ["utm_source", "regionUser", "cityUser"],
                    GETs: "utm_source",
                },
                whatLookingFor: ["_msk_yandex", "_msk_google"],
                replaceWith: {
                    phone: "8 (495) 109 34 21",
                    email: false,
                    address: false,
                },
            },*/
            // Все лиды с Санкт-Петербурга и ЛО
            /*{
                whereLookingFor: {
                    cookies: ["utm_source", "regionUser", "cityUser"],
                    GETs: "utm_source",
                },
                whatLookingFor: ["_spb_yandex", "_spb_google", "ленинградская", "санкт-петербург"],
                replaceWith: {
                    phone: "8 (812) 309 18 45",
                    email: "spb@diadoc.com",
                    address: "г.Санкт-Петербург, Россия, 6-я линия Васильевского острова, 43, офис 1",
                },
            },*/
            // Все лиды с Уфы
            /*{
                whereLookingFor: {
                    cookies: ["utm_source", "regionUser", "cityUser"],
                    GETs: "utm_source",
                },
                whatLookingFor: ["_ufa_yandex"],
                replaceWith: {
                    phone: "8 (347) 225 81 71",
                    email: "ufa@diadoc.com",
                    address: false,
                },
            },*/
        ]);
    };
    if (window.location.pathname !== "/contacts/") {
        replaceContactsGO();
    }
    // - По клику показать номер, предлагаем телефон на выбор
    const allPhonesOnTheSite = document.querySelectorAll(".RGphoneSHORT");
    if (allPhonesOnTheSite && allPhonesOnTheSite.length > 0) {
        const popUp = document.getElementById("who-calling");
        allPhonesOnTheSite.forEach(el => {
            el.addEventListener("click", event => {
                event.preventDefault();
                el.setAttribute("data-pop", "who-calling");
                replaceContactsGO();
                new PopUp(el);
                const tp_PHONE = popUp.querySelector(".tp_PHONE");
                tp_PHONE.textContent = tp_PHONE.textContent
                    .replace("tel:TP_PHONE", "tel:88005001018")
                    .replace("TP_PHONE", "8 800 500-10-18");
            });
        });
    }

    // - Манипуляции с кнопкой ВХОД
    const game = document.querySelector(".game");
    if (game) {
        vhodGame();
    }
    // - Главная страница
    hoverElAddCustomClass(".page-11.banner .buttons", ".button");
    hoverElAddCustomClass(".tariffs-items", ".swiper-slide>.rg-card");

    // Слайдер в баннере
    const homePageBannerSwiper = document.querySelector(".homePageBannerSwiper");
    if (homePageBannerSwiper) {
        const init = new Swiper(homePageBannerSwiper, {
            autoplay: true,
            pauseOnMouseEnter: true,
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            grabCursor: true,
            modules: [Pagination, Autoplay],
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    }

    // - Маркетплейсы
    const marketplacesSwiper = document.querySelector(".marketplacesSwiper");
    if (marketplacesSwiper) {
        let swiperInstance;
        const swiperWrapper = marketplacesSwiper.querySelector(".swiper-wrapper");

        function initSwiper() {
            if (window.innerWidth < 992 && marketplacesSwiper && !swiperInstance) {
                swiperWrapper.classList.remove("row");
                swiperInstance = new Swiper(marketplacesSwiper, {
                    // autoplay: true,
                    pauseOnMouseEnter: true,
                    slidesPerView: 1,
                    autoHeight: true,
                    spaceBetween: 100,
                    rewind: true,
                    loop: true,
                    centeredSlides: true,
                    grabCursor: true,
                    modules: [Pagination, Autoplay, Navigation],
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    breakpoints: {
                        0: {
                            navigation: {
                                nextEl: ".swiper-button-next",
                                prevEl: ".swiper-button-prev",
                            },
                        },
                    },
                    on: {
                        slideChange: function () {
                            updateSwiperClass(this.realIndex);
                        },
                    },
                });
            } else if (window.innerWidth >= 992 && swiperInstance) {
                swiperInstance.destroy(true, true);
                swiperInstance = null;
                swiperWrapper.classList.add("row");
            }
        }

        function updateSwiperClass(activeIndex) {
            // Удаляем все классы, начинающиеся с 'slide_'
            marketplacesSwiper.className = marketplacesSwiper.className.replace(/\bslide_\d+\b/g, "");
            // Добавляем новый класс для активного слайда
            marketplacesSwiper.classList.add(`slide_${activeIndex + 1}`);
        }

        // Инициализация при загрузке страницы
        initSwiper();

        // Добавляем обработчик события resize
        window.addEventListener("resize", initSwiper);
    }

    // Страница: /tariffs/
    // - Адаптив тарифов
    const tariffsSwiper = document.querySelector(".tariffsSwiper");
    if (tariffsSwiper) {
        let swiperInstance;
        const swiperWrapper = tariffsSwiper.querySelector(".swiper-wrapper");

        function initSwiper() {
            if (window.innerWidth < 992 && tariffsSwiper && !swiperInstance) {
                swiperWrapper.classList.remove("row");
                swiperInstance = new Swiper(tariffsSwiper, {
                    // autoplay: true,
                    pauseOnMouseEnter: true,
                    slidesPerView: 2,
                    spaceBetween: 20,
                    rewind: true,
                    loop: true,
                    centeredSlides: true,
                    grabCursor: true,
                    modules: [Pagination, Autoplay, Navigation],
                    initialSlide: 2,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2,
                        },
                        0: {
                            slidesPerView: 1,
                            navigation: {
                                nextEl: ".swiper-button-next",
                                prevEl: ".swiper-button-prev",
                            },
                        },
                    },
                });
            } else if (window.innerWidth >= 992 && swiperInstance) {
                swiperInstance.destroy(true, true);
                swiperInstance = null;
                swiperWrapper.classList.add("row");
            }
        }

        // Инициализация при загрузке страницы
        initSwiper();

        // Добавляем обработчик события resize
        window.addEventListener("resize", initSwiper);
    }

    // - Оформление заявки тарифов
    const global_tpl_box_tariffs = document.querySelector(".global_tpl_box_tariffs");
    if (global_tpl_box_tariffs) {
        const formWithChoice = global_tpl_box_tariffs.querySelector(".form-with-choice");
        if (formWithChoice) {
            const containerRadioButtons = formWithChoice.querySelector(".radio-buttons");
            const radioButtons = containerRadioButtons.querySelectorAll(".form-check-input");
            radioButtons.forEach(radio => {
                radio.addEventListener("change", () => {
                    const type = radio.closest("div").getAttribute("data-type");
                    formWithChoice.querySelectorAll(".hidden_form_element").forEach(el => {
                        if (!el.classList.contains("d-none")) el.classList.add("d-none");
                        if (el.classList.contains(type)) {
                            //console.log(type)
                            if (el.classList.contains("d-none")) el.classList.remove("d-none");
                        }
                    });
                    if (type === "pr") {
                        formWithChoice
                            .querySelectorAll(".hidden_form_element.new")
                            .forEach(el => el.classList.remove("d-none"));
                    }
                });
            });
        }
        global_tpl_box_tariffs.querySelectorAll('*[data-pop="by_tariff"]').forEach(el => {
            el.addEventListener("click", () => {
                let product = el.getAttribute("data-product");
                product = product ? product : "diadoc";
                const form = document.getElementById(el.getAttribute("data-pop"));
                const inputProduct = form.querySelector('input[name="product"]');
                const inputTitle = form.querySelector('input[name="title"]');
                const inputTariff = form.querySelector('input[name="tariff"]');
                const inputPrice = form.querySelector('input[name="price"]');
                const boxItem = el.closest(".rg-card");
                let title = "Подключение к Контур.Диадок",
                    tariff = "";
                if (boxItem) {
                    let price = boxItem.querySelector("p.price.rubl");
                    price = price ? price.innerText : 0;
                    if (product === "ep") {
                        form.querySelector("p.title").innerHTML = "Получить ЭП для работы с <span>ЭДО</span>";
                        inputProduct.value = "ca";
                        title = "Получить ЭП для работы с ЭДО";
                    } else {
                        form.querySelector("p.title").innerHTML = 'Контур.<span class="color-turquoise">Диадок</span>';
                        inputProduct.value = "diadoc";
                        let countDoc = boxItem.querySelector(".docs").innerText;
                        tariff = `${countDoc}${price ? " за " + price + " рублей" : ""}`;
                    }
                    inputTitle.value = title;
                    inputTariff.value = tariff;
                    inputPrice.value = price;
                }
            });
        });
    }

    // - Оформление заявки на ЭП
    const rgEpTariffsSection = document.querySelector(".rg-ep-tariffs");
    if (rgEpTariffsSection) {
        rgEpTariffsSection.querySelectorAll(".buy_ep_tariff").forEach(el => {
            el.addEventListener("click", () => {
                const form = document.getElementById(el.getAttribute("data-pop"));
                const title = form.querySelector("p.title");
                const tariffs = rgEpTariffsSection.querySelectorAll(".tariff.form-check");
                tariffs.forEach(tariff => {
                    const input = tariff.querySelector('input[name="epTariffDefault"]');
                    const inputValue = input.value;
                    if (input.checked) {
                        title.innerText = inputValue;
                        const price = tariff.querySelector("p.price.rubl").innerText;
                        form.querySelector('input[name="tariff"]').value = `${inputValue} за ${price} рублей`;
                        form.querySelector('input[name="title"]').value = `${inputValue} за ${price} рублей`;
                        form.querySelector('input[name="price"]').value = price;
                    }
                });
            });
        });
    }

    const pageTariffsDop = document.querySelector(".page-tariffs.dop-uslugi");
    if (pageTariffsDop) {
        pageTariffsDop.querySelectorAll('*[data-pop="by_dop_usl"]').forEach(el => {
            el.addEventListener("click", () => {
                const form = document.getElementById(el.getAttribute("data-pop"));
                const boxItem = el.closest(".item");
                if (boxItem) {
                    const title = boxItem.querySelector("p.desc").innerText;
                    const price = boxItem.querySelector("p.price .rubl").innerText;
                    form.querySelector('input[name="tariff"]').value = `${title} за ${price} рублей`;
                    form.querySelector('input[name="price"]').value = price;
                }
            });
        });
    }

    // - /integrations/1c/
    const btnInt1c = document.querySelectorAll('[data-pop="buy_int_1c"]');
    if (btnInt1c && btnInt1c.length) {
        btnInt1c.forEach(el => {
            el.onclick = () => {
                let form = document.getElementById("buy_int_1c");
                if (form) {
                    const accordion = el.closest(".accordion-item");
                    if (accordion) {
                        let title = accordion.querySelector(".title p");
                        let price = accordion.querySelector(".price p");
                        form.querySelector('input[name="tariff"]').value = title.innerText;
                        form.querySelector('input[name="price"]').value = price.innerText;
                    }
                }
            };
        });
    }

    // Страница: /edo-v-logistike/
    const pageLogistic = document.querySelector(".page-7821.section_4");
    if (pageLogistic) {
        const titleBox = pageLogistic.querySelectorAll(".box_style_2");
        titleBox.forEach(el => {
            const boxTitle = el.querySelector("p.title.h1");
            const button = el.querySelectorAll('*[data-pop="by_int"]');
            button.forEach(el => {
                el.addEventListener("click", () => {
                    const popUp = document.getElementById(el.getAttribute("data-pop"));
                    if (popUp) {
                        const form = document.getElementById("by_int");
                        const formTitle = form.querySelector("p.title");
                        formTitle.innerText = boxTitle.textContent;
                        form.querySelector('input[name="tariff"]').value = `ЕДО в логистике - ${formTitle.textContent}`;
                    }
                });
            });
        });
    }
    const pageLogisticTariffs = document.querySelector(".page-7821.tariffs");
    if (pageLogisticTariffs) {
        pageLogisticTariffs.querySelectorAll('*[data-pop="by_tariff_logistic"]').forEach(el => {
            el.addEventListener("click", () => {
                const form = document.getElementById(el.getAttribute("data-pop"));
                const boxItem = el.closest(".item");
                const countDoc = boxItem.querySelector("p.count").innerText;
                const price = boxItem.querySelector("p.price .rubl").innerText;
                if (el.closest(".tabs-panel")) {
                    const who = el.closest(".tabs-panel").querySelector(".btn.active").innerText;
                    form.querySelector('input[name="title"]').value = `Контур.Диадок в Логистике: ${who}`;
                    form.querySelector('input[name="tariff"]').value =
                        `${who} по ${countDoc} документов за ${price} рублей`;
                    form.querySelector('input[name="price"]').value = price;
                } else if (el.closest(".item")) {
                    form.querySelector('input[name="tariff"]').value = `${countDoc} документов за ${price} рублей`;
                    form.querySelector('input[name="price"]').value = price;
                }
            });
        });
    }

    // Страница: /integrations/1c/
    const pageInt1C = document.querySelector(".page-1c.section_3");
    if (pageInt1C) {
        const btnInt1cBy = pageInt1C.querySelectorAll('a[data-pop="by_int"]');
        btnInt1cBy.forEach(el => {
            el.addEventListener("click", () => {
                const form = document.getElementById("by_int");
                const boxItem = el.closest(".item");
                if (boxItem) {
                    const title = el.closest(".item").querySelector(".h3");
                    form.querySelector('input[name="title"]').value = title.textContent;
                }
            });
        });
    }

    // Страница: /actions/
    const pageActions = document.querySelector(".page-actions.box_style_2");
    if (pageActions) {
        pageActions.querySelectorAll('.category-actions a[data-pop="connect_action"]').forEach(el => {
            el.onclick = () => {
                let form = document.getElementById("connect_action");
                let title = el.closest("article").querySelector(".title").innerText;
                form.querySelector('input[name="tariff"]').value = title;
                form.querySelector(".desc").innerText = title;
            };
        });
    }

    // Страница: /vidy-edo/medo/
    const pageMedo = document.querySelector(".page-vidy-edo-medo.section_5");
    if (pageMedo) {
        pageMedo.querySelectorAll('*[data-pop="by_medo"]').forEach(el => {
            el.addEventListener("click", ({ target }) => {
                el = target;
                const form = document.getElementById(el.getAttribute("data-pop"));
                const boxItem = el.closest(".item");
                if (boxItem) {
                    const price = boxItem.querySelector("p.price .rubl").innerText;
                    form.querySelector('input[name="price"]').value = price;
                    if (boxItem.closest(".content")) {
                        const title = boxItem.querySelector("p.title").innerText;
                        form.querySelector('input[name="title"]').value = title;
                    } else {
                        const connect = boxItem.querySelector("p.desc > span").innerText;
                        form.querySelector('input[name="tariff"]').value =
                            `До ${connect} шт. годовых связей за ${price} рублей`;
                    }
                }
            });
        });
    }

    // Страница: /edo-dlya-retail/
    const pageEdoRetail = document.querySelector(".page-9829.favorable-conditions");
    if (pageEdoRetail) {
        const btn = pageEdoRetail.querySelector(".buy_retail_tariff");
        btn.addEventListener("click", () => {
            const form = document.getElementById(btn.getAttribute("data-pop"));
            const title = form.querySelector("p.title");
            const tariffs = pageEdoRetail.querySelectorAll(".form-check");
            tariffs.forEach(tariff => {
                const input = tariff.querySelector('input[name="favorableConditionsTariff"]');
                const inputValue = input.value;
                if (input.checked) {
                    title.innerText = inputValue;
                    const price = tariff.querySelector("p.price .rubl").innerText;
                    form.querySelector('input[name="tariff"]').value = `${inputValue} за ${price} рублей в год`;
                    form.querySelector('input[name="title"]').value = `${inputValue} за ${price} рублей в год`;
                    form.querySelector('input[name="price"]').value = price;
                }
            });
        });
    }

    // Страница: /edo-dlya-sverki-vzaimoraschetov/

    const pageEdoForVerification = document.querySelector(".page-9831.tariffs");
    if (pageEdoForVerification) {
        pageEdoForVerification.querySelectorAll(".buy_mutual_settlements_tariff").forEach(el => {
            el.addEventListener("click", () => {
                const form = document.getElementById(el.getAttribute("data-pop"));
                const container = el.closest(".items");
                let additionalTariff = [];
                let allPrice = [];
                const tariffs = container.querySelectorAll(".form-check");

                // Очищаем поле перед добавлением новых значений
                form.querySelector('input[name="tariff"]').value = "";

                tariffs.forEach(tariff => {
                    const mainTariffInput = tariff.querySelector("input[name^='mutualSettlementsTariffs']");
                    const additionalTariffInput = tariff.querySelector(
                        "input[name^='mutualSettlementsAdditionalTariffs']",
                    );

                    // Проверяем, существует ли основной тариф
                    if (mainTariffInput && mainTariffInput.checked) {
                        const price = mainTariffInput.getAttribute("data-price");
                        allPrice.push(price);
                        form.querySelector('input[name="title"]').value = `Сравнение взаиморасчетов с помощью Диадока`;
                        form.querySelector('input[name="tariff"]').value =
                            `${mainTariffInput.value} за ${price} рублей в год`;
                    }

                    // Добавляем дополнительные тарифы, если они выбраны
                    if (additionalTariffInput && additionalTariffInput.checked) {
                        const additionalPrice = additionalTariffInput.getAttribute("data-price");
                        const additionalValue = additionalTariffInput.value;
                        allPrice.push(additionalPrice);
                        // Проверяем, чтобы не было дублирования при добавлении
                        if (!additionalTariff.includes(`${additionalValue} за ${additionalPrice} рублей в год`)) {
                            additionalTariff.push(`${additionalValue} за ${additionalPrice} рублей в год`);
                        }
                    }
                });
                // Если есть дополнительные тарифы, добавляем их в поле формы один раз
                if (additionalTariff.length > 0) {
                    form.querySelector('input[name="tariff"]').value +=
                        ` + Дополнительно: ${additionalTariff.join(", ")}`;
                }
                if (allPrice.length > 0) {
                    form.querySelector('input[name="price"]').value = allPrice.join(", ");
                }
            });
        });
    }
});

/* Functions */

// - Цели Яндекс.Метрики
function yaMetrics(el, id_metric, event) {
    if (document.querySelector(el)) {
        const numMetric = "3235447";
        document.querySelectorAll(el).forEach(function (elem) {
            if (event === "onclick") {
                elem.setAttribute(event, `ym(${numMetric},'reachGoal','${id_metric}');return true;`);
                return true;
            } else {
                document.addEventListener("wpcf7submit", function (event) {
                    if (event.detail.status === "mail_sent") {
                        ym(numMetric, "reachGoal", id_metric);
                        return true;
                    }
                });
            }
        });
    }
}

// - Функция для получения кук
function getCookie(name) {
    const matches = document.cookie.match(
        new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") + "=([^;]*)"),
    );
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

// - Получить GET параметр

function gets(findValue = "", findKey = "") {
    let url = window.location.search;
    const object = {};
    url = url.substring(1).split("&");
    for (let i = 0; i < url.length; i++) {
        const k = url[i].split("=")[0];
        const v = url[i].split("=")[1];
        object[k] = v;
        if (findValue || findKey) {
            if (findValue.includes(v) || findKey.includes(k)) {
                return { k, v };
            } else {
                return false;
            }
        }
    }
    return object;
}

// - Маска для полей телефонов и ИНН

function maskPhone(selector, masked = "8 (___) ___-__-__") {
    const elems = document.querySelectorAll(selector);

    function mask(event) {
        const keyCode = event.keyCode;
        const template = masked,
            def = template.replace(/\D/g, ""),
            val = this.value.replace(/\D/g, "");
        let i = 0,
            newValue = template.replace(/[_\d]/g, function (a) {
                return i < val.length ? val.charAt(i++) || def.charAt(i) : a;
            });
        i = newValue.indexOf("_");
        if (i !== -1) {
            newValue = newValue.slice(0, i);
        }
        let reg = template
            .substr(0, this.value.length)
            .replace(/_+/g, function (a) {
                return "\\d{1," + a.length + "}";
            })
            .replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (!reg.test(this.value) || this.value.length < 5 || (keyCode > 47 && keyCode < 58)) {
            this.value = newValue;
        }
        if (event.type === "blur" && this.value.length < 5) {
            this.value = "";
        }
    }

    for (const elem of elems) {
        elem.addEventListener("input", mask);
        elem.addEventListener("focus", mask);
        elem.addEventListener("blur", mask);
    }
}

// - Функция анимации скрытия чего-либо
function fadeOut(el, displayClass = "d-none") {
    if (el) {
        if (!el.classList.contains(displayClass)) {
            let op = 1;
            let timer = setInterval(function () {
                if (op <= 0.1) {
                    clearInterval(timer);
                    el.classList.remove("d-block");
                    el.classList.add(displayClass);
                }
                el.style.opacity = op;
                el.style.filter = "alpha(opacity=" + op * 100 + ")";
                op -= op * 0.1;
            }, 10);
        }
    }
}

// - Функция анимации появления чего-либо
function fadeIn(el, displayClass = "d-block") {
    if (el) {
        if (!el.classList.contains(displayClass)) {
            let op = 0.1;
            el.classList.remove("d-none");
            let timer = setInterval(function () {
                if (op >= 1) {
                    clearInterval(timer);
                    el.classList.add(displayClass);
                }
                el.style.opacity = op;
                el.style.filter = "alpha(opacity=" + op * 100 + ")";
                op += op * 0.1;
            }, 10);
        }
    }
}

// - Блок с .adaptive-video
const adaptiveVideoStart = document.querySelectorAll(".adaptive-video");
adaptiveVideoStart.forEach(el => {
    let getVideo = el.querySelector("iframe");
    const overlay = el.querySelector(".bg-layout");
    const playButton = el.querySelector("button");
    let getUrlVideo = getVideo.getAttribute("src");
    playButton.addEventListener("click", () => {
        let newUrlVideo = getUrlVideo + "&autoplay=1";
        overlay.classList.add("blur-hidden");
        if (overlay.classList.contains("blur-hidden")) {
            getVideo.src = newUrlVideo;
            setTimeout(() => {
                overlay.setAttribute("style", "z-index: -1;");
            }, 1000);
        }
    });
});

/* Определение региона пользователя */
window.onload = function () {
    DefineUserRegion();
};
