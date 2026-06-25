/**
 * Функция по добавлению кнопки перейти в whatsapp
 */

const AddCustomMenuItemB24 = options => {
    const { id, type, classes, href, target, attributes, text } = options;
    if (id && !document.getElementById(options.id)) {
        const paste = document.querySelector(".b24-widget-button-wrapper .b24-widget-button-social");
        if (paste) {
            const a = document.createElement("a");
            if (id) a.id = id;
            if (type !== "link") {
                a.href = "#";
                a.classList.add("popClick");
            } else {
                a.href = href ? href : "#";
            }
            if (classes.length > 0) {
                classes.forEach(myClass => {
                    a.classList.add(myClass);
                });
            }

            if (target) {
                a.target = target;
            }
            if (attributes.length > 0) {
                attributes.forEach(myAttr => {
                    a.setAttribute(myAttr[0], myAttr[1]);
                });
            }

            const span = document.createElement("span");
            span.classList.add("b24-widget-button-social-tooltip");
            span.innerText = text;
            span.setAttribute("data-b24-crm-button-tooltip", "data-b24-crm-button-tooltip");
            a.append(span);

            const i = document.createElement("i");
            a.append(i);

            paste.append(a);
            a.addEventListener("click", () => {
                const overlay = document.querySelector(".b24-widget-button-shadow.b24-widget-button-show");
                if (overlay) {
                    overlay.remove();
                    /*const bitrixFrame = document.querySelector(
                        ".b24-widget-button-wrapper.b24-widget-button-position-bottom-right.b24-widget-button-visible.b24-widget-button-bottom",
                    );
                    if (bitrixFrame) {
                        bitrixFrame.classList.add("d-none");
                        setTimeout(() => {
                            bitrixFrame.classList.remove("d-none");
                        }, 10000);
                    }*/
                }
            });
        }
    }
};

const AddCustomMenuItemB24Render = widgetBitrixButton => {
    const defaultForm = widgetBitrixButton.querySelector("[data-b24-crm-button-widget='crmform']");
    if (defaultForm) defaultForm.remove();
    console.log(defaultForm);
    // Добавляем свой пункт меню WhatsApp
    const optionsWhatsApp = {
        id: "b24_whatsapp",
        type: "popup",
        namePopup: "popup_wa_1",
        classes: ["b24-widget-button-social-item", "b24-widget-button-whatsapp", "ui-icon", "ui-icon-service-whatsapp"],
        attributes: [
            ["data-b24-widget-sort", "1"],
            ["data-pop", "popup_wa_1"],
        ],
        text: "Мы в WhatsApp", // Добавленный параметр для текста элемента меню
    };
    if (window.matchMedia("(max-width: 768px)").matches) {
        optionsWhatsApp.type = "link";
        optionsWhatsApp.target = "_blank";
        optionsWhatsApp.href =
            "https://api.whatsapp.com/send?phone=74952258118&text=Добрый%20день!%20Я%20с%20сайта%20" +
            window.location.hostname +
            ".%20У%20меня%20вопрос%20...";
    }
    AddCustomMenuItemB24(optionsWhatsApp);

    // Добавление пункта меню для Telegram
    const optionsTelegram = {
        id: "b24_telegram",
        type: "link",
        target: "_blank",
        href: "https://t.me/NITbuss_bot",
        classes: ["b24-widget-button-social-item", "b24-widget-button-telegram", "ui-icon", "ui-icon-service-telegram"],
        attributes: [["data-b24-widget-sort", "2"]],
        text: "Мы в Telegram",
    };
    AddCustomMenuItemB24(optionsTelegram);

    // Добавление пункта меню для VKontakte
    const optionsVKontakte = {
        id: "b24_vk",
        type: "link",
        target: "_blank",
        href: "https://vk.me/kontur_center",
        classes: ["b24-widget-button-social-item", "b24-widget-button-vk", "ui-icon", "ui-icon-service-vk"],
        attributes: [["data-b24-widget-sort", "2"]],
        text: "Мы в Вконтакте",
    };
    AddCustomMenuItemB24(optionsVKontakte);

    widgetBitrixButton.addEventListener("mouseover", ({ target }) => {
        const widget = target.closest(".b24-widget-button-wrapper");
        if (widget) {
            //Меняем подсказку с url сайта на сообщение «Написать в чат»
            const chatLabel = widget.querySelector(
                'a[data-b24-crm-button-widget="openline_livechat"] span.b24-widget-button-social-tooltip',
            );
            if (chatLabel) {
                chatLabel.innerText = "Написать в чат";
            }
            //Меняем классы у кнопок
            const allFormsBitrix = document.querySelectorAll(".b24-form");
            allFormsBitrix.forEach(form => {
                const btns = form.querySelectorAll("button.b24-form-btn");
                btns.forEach(btn => {
                    btn.classList.add("btn", "btn-center");
                    btn.classList.remove("b24-form-btn");
                });
            });
        }
    });
    // replaceIcons icons
    const iconsContainer = document.querySelector(".b24-widget-button-icon-container");
    if (iconsContainer) {
        if (!iconsContainer.classList.contains("active")) {
            iconsContainer.classList.add("active");
        }
        const replaceIcons = iconsContainer.querySelectorAll("div");
        if (replaceIcons.length) {
            replaceIcons.forEach(el => {
                el.querySelector("svg").remove();
            });
        }
    }
};
export default AddCustomMenuItemB24Render;
