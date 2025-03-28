/**
 * Адаптивное меню - добавление пункта меню ещё
 */

const AdaptiveMenu = () => {
    function adaptiveMenu(e, headerMenuSite) {
        const moreMenuButton = document.querySelector(".more-menu-button");

        if (moreMenuButton) {
            if (
                (!headerMenuSite.classList.contains("desktop") && window.matchMedia("(min-width: 575.98px)").matches) ||
                (headerMenuSite.classList.contains("desktop") && window.matchMedia("(min-width: 991.98px)").matches)
            ) {
                const dropdown = moreMenuButton.querySelector(".dropdown-menu");
                const weight = e ? e.target.innerWidth : window.innerWidth;

                function cutAndPaste(elements) {
                    if (elements && elements.length) {
                        elements.forEach(el => {
                            el.classList.add("dropend");
                            el.querySelector("a").classList.add("dropdown-item");
                            dropdown.append(el);
                            moreMenuButton.classList.contains("d-none")
                                ? moreMenuButton.classList.remove("d-none")
                                : null;
                        });
                    }
                }

                function cutAndReturn(elements) {
                    if (elements && elements.length) {
                        elements.forEach(el => {
                            if (!el.classList.contains("dontDelete")) {
                                el.classList.remove("dropend");
                                el.querySelector("a").classList.remove("dropdown-item");
                                moreMenuButton.parentNode.insertBefore(el, moreMenuButton);
                            }
                        });
                    }
                }

                const screens = [1400, 1200, 992, 768, 576, 450, 360];
                screens.forEach(screen => {
                    if (weight <= screen) {
                        cutAndPaste(headerMenuSite.querySelectorAll("li.visible_after_" + screen));
                    } else {
                        cutAndReturn(moreMenuButton.querySelectorAll("li.visible_after_" + screen));
                    }
                });
                if (weight < 360) {
                    cutAndPaste(headerMenuSite.querySelectorAll("ul.navbar-nav > li"));
                }

                if (moreMenuButton.querySelectorAll("ul li").length === 0) {
                    moreMenuButton.classList.add("d-none");
                }
            }
        }
    }

    const navMenu = document.querySelector("#header nav");
    if (navMenu) {
        if (navMenu.classList.contains("menu")) {
            const headerMenuSite = document.querySelector("#header nav.menu");
            const headerMenuSiteUL = headerMenuSite.querySelector("ul");
            const moreMenuButtonHTML = `
                <li class="menu-item dropdown more-menu-button d-none">
                    <a title="Ещё" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle d-flex no-line align-items-center nav-link" id="nav-item-dropdown-service">
                        <span></span><span></span><span></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="nav-item-dropdown-service" role="menu" style="">
            
                    </ul>
                </li>
            `;
            headerMenuSiteUL.insertAdjacentHTML("beforeend", moreMenuButtonHTML);
            adaptiveMenu(false, headerMenuSite);
            window.addEventListener(
                `resize`,
                event => {
                    adaptiveMenu(event, headerMenuSite);
                },
                false,
            );
        }
    }
};

export default AdaptiveMenu;
