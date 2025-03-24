export const AutoShowQuiz = ({ timer = 45000, btnSelector = "", modalSelector = "" }) => {
    if (!localStorage.getItem("modalQuizShown")) {
        const modalButton = document.querySelector(btnSelector);
        let timerId = null;

        // Функция для показа модалки и записи в localStorage
        const showModal = () => {
            // Кликаем по кнопке
            if (modalButton) {
                modalButton.click();

                // Проверяем через 300ms появилась ли модалка
                setTimeout(() => {
                    const modal = document.querySelector(modalSelector);
                    if (modal && modal.classList.contains("active")) {
                        localStorage.setItem("modalQuizShown", "true");
                    }
                }, 300);
            }
        };

        // Запускаем таймер только если кнопка существует
        if (modalButton) {
            timerId = setTimeout(showModal, timer);

            // Обработчик для ручного нажатия кнопки
            modalButton.addEventListener("click", () => {
                // Отменяем запланированный показ
                if (timerId) clearTimeout(timerId);
                // Помечаем модалку как показанную
                localStorage.setItem("modalQuizShown", "true");
            });
        }
    }
};
