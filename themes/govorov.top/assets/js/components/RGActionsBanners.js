/**
 * Функция анимации появления чего-либо
 */
export class RGActionsBanners {
    static urlImages = "/wp-content/themes/govorov.top/assets/img/widgets/RGActionsBanners/";
    obj;
    /**
     * Constructor
     * @param nodes
     * @param obj
     */
    constructor(nodes, obj) {
        this.obj = obj;
        // Checking the object for correctness
        if (nodes && nodes.length > 0 && this.checkObject()) {
            // Checking publication dates
            this.obj = this.publish();
            if (this.obj && typeof this.obj === "object") {
                for (const k in this.obj) {
                    nodes.forEach(node => {
                        const wrapper = node.querySelector(".swiper-wrapper");
                        if (wrapper) {
                            // Creating slide and images inside a slide
                            this.createSlides(wrapper, this.obj[k]);
                        }
                    });
                }
            }
        }
    }

    /**
     * Checking the object for correctness
     * @returns {boolean}
     */
    checkObject() {
        if (this.obj && typeof this.obj === "object" && this.obj.length > 0) {
            for (const objKey in this.obj) {
                if (!this.obj[objKey].hasOwnProperty("event")) this.obj[objKey].event = "everyday";
                if (!this.obj[objKey].hasOwnProperty("show")) this.obj[objKey].show = null;
                if (!this.obj[objKey].hasOwnProperty("period")) throw Error("There is no property «period»");
                if (!this.obj[objKey].hasOwnProperty("popup")) this.obj[objKey].popup = false;
                if (!this.obj[objKey].hasOwnProperty("urlAction")) throw Error("There is no property «urlAction»");
                if (!this.obj[objKey].hasOwnProperty("formatImg")) this.obj[objKey].formatImg = "png";
                if (window.location.pathname.indexOf(this.obj[objKey].urlAction) >= 0) delete this.obj[objKey];
            }
            return true;
        } else {
            throw Error("Wrong parameter!");
        }
    }

    /**
     * Checking publication dates
     * @returns {boolean|array}
     */
    publish() {
        const dateNow = Date.now();
        this.obj = this.obj.filter(o => {
            const dateStart = Date.parse(o.period.start);
            const dateFinish = Date.parse(o.period.finish);
            if (dateNow - dateStart >= 0 && dateNow - dateFinish <= 0) {
                return true;
            }
        });
        if (this.obj.find(o => o.show === "single")) {
            return this.obj.filter(o => o.show === "single");
        }
        return this.obj;
    }

    /**
     * Creating slide and images inside a slide
     * @param wrapper
     * @param obj
     */
    createSlides(wrapper, obj) {
        const slide = document.createElement("div");
        const a = document.createElement("a");
        const picture = document.createElement("picture");
        const sources = document.createDocumentFragment();
        const img = document.createElement("img");

        slide.classList.add("swiper-slide");

        a.href = `/actions/${obj.urlAction}`;
        if (obj.popup) {
            a.href = "javascript:;";
            a.classList.add("popClick");
            a.setAttribute("data-pop", "RGActionsBanners");
            a.setAttribute("data-pop-title", obj.titleActionInPopup);
            a.setAttribute("data-pop-title-lead", obj.titleLead);
            a.setAttribute("data-pop-comment-lead", obj.commentLead);
        }

        for (let i = 0; i < 6; i++) {
            const source = document.createElement("source");
            let imgSize = 425;
            switch (i) {
                case 0:
                    source.media = "(max-width: 424.98px)";
                    break;
                case 1:
                    source.media = "(max-width: 575.98px)";
                    imgSize = 576;
                    break;
                case 2:
                    source.media = "(max-width: 767.98px)";
                    imgSize = 768;
                    break;
                case 3:
                    source.media = "(max-width: 991.98px)";
                    imgSize = 992;
                    break;
                case 4:
                    source.media = "(max-width: 1199.98px)";
                    imgSize = 1200;
                    break;
                case 5:
                    source.media = "(max-width: 1399.98px)";
                    imgSize = 1400;
                    break;
            }
            source.setAttribute(
                "srcset",
                `${RGActionsBanners.urlImages}${obj.event}/${obj.urlAction}-${imgSize}.${obj.formatImg}`,
            );
            sources.append(source);
        }

        img.src = `${RGActionsBanners.urlImages}${obj.event}/${obj.urlAction}.${obj.formatImg}`;
        if (obj.popup) {
            img.alt = obj.titleActionInPopup;
        }

        sources.append(img);
        picture.append(sources);
        a.append(picture);
        slide.append(a);
        wrapper.append(slide);
    }
}
