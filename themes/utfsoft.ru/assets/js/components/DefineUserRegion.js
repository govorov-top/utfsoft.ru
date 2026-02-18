/**
 * Определение региона пользователя
 */

const DefineUserRegion = () => {
    const token = "6eac2e0967d1257ccf8a1c9017cc05f81d5e415d";
    const url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address";

    if (!checkCookies(["cityUser", "regionUser"])) {
        fetchLocation();
    }
    fetchLocation();

    //console.log(getCookie("cityUser"));
    //console.log(getCookie("regionUser"));

    function fetchLocation() {
        const options = {
            method: "POST",
            mode: "cors",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: `Token ${token}`,
            },
            body: JSON.stringify({
                count: 1,
                query: "",
                from_bound: { value: "city" },
                to_bound: { value: "city" },
                locations: [{ country: "Россия" }],
            }),
        };
        fetch(url, options)
            .then(response => response.json())
            .then(data => {
                if (data.suggestions && data.suggestions.length > 0) {
                    const city = data.suggestions[0].data.city;
                    let region = data.suggestions[0].data.region_with_type;

                    if (region === "г Москва" || region === "Москва") {
                        region = "Московская обл";
                    } else if (region === "г Санкт-Петербург" || region === "Санкт-Петербург") {
                        region = "Ленинградская обл";
                    }

                    setCookies({
                        cityUser: city,
                        regionUser: region,
                        popUpGetRegion: "1",
                    });
                } else {
                    setDefaultLocation();
                }
            })
            .catch(() => {
                setDefaultLocation();
            });
    }

    function setDefaultLocation() {
        setCookies({
            cityUser: "Москва",
            regionUser: "Московская обл",
            popUpGetRegion: "1",
        });
    }

    function setCookies(cookies) {
        const expires = "Fri, 31 Dec 9999 23:59:59 GMT";
        Object.entries(cookies).forEach(([name, value]) => {
            document.cookie = `${name}=${value}; path=/; expires=${expires}`;
        });
    }

    function getCookie(name) {
        const matches = document.cookie.match(
            new RegExp("(?:^|; )" + name.replace(/([.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") + "=([^;]*)"),
        );
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function checkCookies(cookies) {
        return cookies.every(cookie => getCookie(cookie));
    }
};

export default DefineUserRegion;
