/**
 * Функция по добавлению кнопок на чаты и соц сети
 */

const chatButtons = chatData => {
    const chatButtonsContainer = document.querySelector(".main-button");

    chatData.forEach(chat => {
        const a = document.createElement("a");
        if (chat.popup) {
            a.href = "#";
            a.classList.add("popClick");
            a.setAttribute("data-pop", `popup_${chat.class}_1`);
        } else {
            a.href = chat.link;
            a.target = "_blank";
        }
        a.classList.add("chat-button", chat.class);
        a.style.backgroundColor = chat.color;

        const img = document.createElement("img");
        img.src = chat.icon;
        img.alt = chat.class;

        a.appendChild(img);
        chatButtonsContainer.appendChild(a);
    });

    const floatingButton = document.getElementById("floatingButton");
    const buttonIcon = floatingButton.querySelector(".button-icon");

    let currentIconIndex = 0;
    const iconList = chatData.map(chat => chat.icon);
    let currentIconSrc = iconList[currentIconIndex];

    floatingButton.addEventListener("click", function () {
        const chatButtons = document.querySelector(".chat-buttons");
        chatButtons.classList.toggle("show");

        if (chatButtons.classList.contains("show")) {
            buttonIcon.src = "/wp-content/themes/govorov.top/assets/img/widgets/chat-buttons/close.svg";
            buttonIcon.classList.add("close");
            const buttons = chatButtons.querySelectorAll(".chat-button");
            buttons.forEach((button, index) => {
                setTimeout(() => {
                    button.style.transform = `translateY(-${index + 1}px)`;
                }, index * 100);
            });
        } else {
            buttonIcon.src = currentIconSrc;
            buttonIcon.classList.remove("close");
            const buttons = chatButtons.querySelectorAll(".chat-button");
            buttons.forEach(button => {
                button.style.transform = "translateY(70px)";
            });
        }
    });

    // Меняем иконки в кнопке каждые 1 секунду
    function changeLogo() {
        if (!document.querySelector(".chat-buttons").classList.contains("show")) {
            currentIconIndex = (currentIconIndex + 1) % iconList.length;
            currentIconSrc = iconList[currentIconIndex];
            buttonIcon.src = currentIconSrc;
        }
    }

    changeLogo();
    setInterval(changeLogo, 1000);
};
export default chatButtons;
