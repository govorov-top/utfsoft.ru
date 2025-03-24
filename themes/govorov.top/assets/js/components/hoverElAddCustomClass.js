/**
 * При наведении на элемент вешаем класс
 * @param elParent
 * @param elChildren
 * @param customClass
 */
export function hoverElAddCustomClass(elParent, elChildren, customClass = "active") {
    const parent = document.querySelector(elParent);
    if (parent) {
        const children = parent.querySelectorAll(elChildren);

        parent.addEventListener("mouseover", ({ target }) => {
            if (target.matches(elChildren) || target.closest(elChildren)) {
                // Удаляем класс у всех children
                children.forEach(el => el.classList.remove(customClass));
                // Назначаем класс текущему элементу
                const child = target.matches(elChildren) ? target : target.closest(elChildren);
                child.classList.add(customClass);
            }
        });

        parent.addEventListener("mouseleave", () => {
            // Удаляем класс у всех children, когда мышь покидает родительский элемент
            children.forEach(el => el.classList.remove(customClass));
        });
    }
}
