"use strict";

/******************************
 * import Libs
 * Инициализация bootstrap компонентов
 * LazyLoad
 * Собираем данные сквозной аналитики Битрикс
 * Меняем дату на всем сайте внутри тегов с классом rg-today-date
 * Антиспам
 * Плавный scroll к маяку (Beacon) по клику на *[data-scroll-beacon]
 * Ссылка на блок
 * PopUp
 * Определение региона пользователя
 * [CF7] Валидация
 * [Lib Swiper] Слайдеры
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
import IMask from "imask";
import PopUp from "./components/popUp";
import DefineUserRegion from "./components/DefineUserRegion";
import AdaptiveMenu from "./components/AdaptiveMenu";

document.addEventListener("DOMContentLoaded", () => {
    /* Инициализация bootstrap компонентов */
    initializeAll();

    AdaptiveMenu();

    /* LazyLoad */

    const lazyLoadInstance = new LazyLoad({
        // Your custom settings go here
    });

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
    document.addEventListener("click", ({ target }) => {
        new PopUp(target.closest(".popClick"));
    });

    /* Настройка меню */

    const headerSite = document.querySelector("header.header#header");
    if (headerSite) {
        const headerMenuSite = document.querySelector("#header nav.menu");

        if (headerMenuSite) {
            const headerFixBlock = headerSite.querySelector(".container_header");
            const isMobile = window.matchMedia("(max-width: 991.98px)").matches;
            const wpAdminBar = document.getElementById("wpadminbar");

            window.onscroll = () => {
                const haveClassFixed = headerFixBlock.classList.contains("fixed");
                let step = 1;
                headerSite.style.minHeight = `${headerSite.clientHeight}px`;

                const top = window.scrollY;
                if (top > step) {
                    if (!haveClassFixed && !isMobile) {
                        headerFixBlock.classList.add("fixed");
                        if (wpAdminBar) {
                            headerFixBlock.style.top = `${wpAdminBar.clientHeight}px`;
                        }
                    }
                }
                if (top < step) {
                    if (haveClassFixed && !isMobile) {
                        headerFixBlock.classList.remove("fixed");
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
                            document.documentElement.style.overflow = "hidden";
                            btnMobileMenu.classList.toggle("active");
                            if (btnMobileMenu.classList.contains("active")) {
                                document.documentElement.style.overflow = "hidden";
                            } else {
                                document.documentElement.style.overflow = "auto";
                            }
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
                        closeBtn.addEventListener("click", () => {
                            btnMobileMenu.classList.remove("active");
                            document.documentElement.style.overflow = "auto";
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
