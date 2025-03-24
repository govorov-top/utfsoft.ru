/**
 * BC - Bootstrap Components
 * @constructor
 */
import { Dropdown, Offcanvas, Popover, Tooltip } from "bootstrap";

// Функция инициализации Dropdown
const initializeDropdowns = element => {
    if (element.matches(".dropdown-toggle") && !element.dataset.bsToggleInitialized) {
        new Dropdown(element);
        element.dataset.bsToggleInitialized = "true";
    }
};

// Функция инициализации Popover
const initPopover = element => {
    return new Popover(element);
};

// Функция инициализации Tooltip
const initTooltip = element => {
    return new Tooltip(element, {
        customClass: "dd-tooltip",
    });
};

// Функция инициализации Offcanvas
const initOffcanvas = element => {
    if (element.matches('[data-bs-toggle="offcanvas"]') && !element.dataset.bsToggleInitialized) {
        new Offcanvas(element);
        element.dataset.bsToggleInitialized = "true";
    }
};

// Обработчик мутаций
const handleMutations = mutations => {
    mutations.forEach(mutation => {
        if (mutation.type === "childList") {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === Node.ELEMENT_NODE) {
                    // Dropdowns
                    if (node.matches(".dropdown-toggle")) {
                        initializeDropdowns(node);
                    }
                    node.querySelectorAll(".dropdown-toggle").forEach(initializeDropdowns);

                    // Popovers
                    if (node.matches('[data-bs-toggle="popover"]')) {
                        initPopover(node);
                    }
                    node.querySelectorAll('[data-bs-toggle="popover"]').forEach(initPopover);

                    // Tooltips
                    if (node.matches('[data-bs-toggle="tooltip"]')) {
                        initTooltip(node);
                    }
                    node.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(initTooltip);

                    // Offcanvas
                    if (node.matches('[data-bs-toggle="offcanvas"]')) {
                        initOffcanvas(node);
                    }
                    node.querySelectorAll('[data-bs-toggle="offcanvas"]').forEach(initOffcanvas);
                }
            });
        }
    });
};

// Настройка наблюдателя
const observer = new MutationObserver(handleMutations);
observer.observe(document.body, { childList: true, subtree: true });

// Экспорт функций для принудительной инициализации
const initializeAll = () => {
    document.querySelectorAll(".dropdown-toggle:not([data-bs-toggle-initialized])").forEach(initializeDropdowns);
    document.querySelectorAll('[data-bs-toggle="popover"]').forEach(initPopover);
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(initTooltip);
    document.querySelectorAll('[data-bs-toggle="offcanvas"]').forEach(initOffcanvas);
};

export { initializeAll };
