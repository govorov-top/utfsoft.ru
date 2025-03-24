"use strict";

/******************************
 * import Libs
 * Действия на определенных страницах
 * - /actions/bonusy-ot-diadoka/
 * *******************************/

/* import Libs */
document.addEventListener("DOMContentLoaded", () => {
    /* Действия на определенных страницах */
    // - /actions/bonusy-ot-diadoka/
    const btnActionPodarkiVsem = document.querySelectorAll('[data-pop="action-go"]');
    if (btnActionPodarkiVsem && btnActionPodarkiVsem.length) {
        btnActionPodarkiVsem.forEach(btn => {
            const greenBoxAction = document.querySelector(".page-action.section_1");
            const formId = btn.getAttribute("data-pop");
            const form = document.getElementById(formId);

            if (!form) return;

            btn.onclick = () => {
                if (btn.closest(".page-action.section_1")) {
                    const titleGreenBox = greenBoxAction.querySelector("h1")?.innerText || "";
                    form.querySelector('input[name="tariff"]').value = titleGreenBox;
                    form.querySelector('input[name="price"]').value = 0;
                } else {
                    const shadowBox = btn.closest(".shadow-box");
                    const title = shadowBox.querySelector("p.title")?.innerText || "";
                    const price = shadowBox.querySelector("p.price .rubl")?.innerText || 0;
                    form.querySelector('input[name="tariff"]').value = title;
                    form.querySelector('input[name="price"]').value = price;
                }
            };
        });
    }
});

//window.onload = function (e) {};
