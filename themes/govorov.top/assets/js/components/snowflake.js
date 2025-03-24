/**
 * Функция для включения снежинок на сайте
 */
export function snowflake() {
    function createSnowflake() {
        const snowflake = document.createElement("div");
        snowflake.classList.add("rg-snowflake");
        snowflake.style.left = Math.random() * 100 + "vw";
        snowflake.style.animationDuration = Math.random() * 5 + 5 + "s"; // between 2 and 5 seconds
        snowflake.style.opacity = Math.random();
        const size = Math.random() * 5 + 5 + "px";
        snowflake.style.width = size;
        snowflake.style.height = size;

        document.body.appendChild(snowflake);

        setTimeout(() => {
            snowflake.remove();
        }, 20000);

        function checkPosition() {
            const rect = snowflake.getBoundingClientRect();
            if (rect.top > window.innerHeight - 10) {
                snowflake.remove();
            } else {
                requestAnimationFrame(checkPosition);
            }
        }

        checkPosition();
    }

    setInterval(createSnowflake, 50);
}
