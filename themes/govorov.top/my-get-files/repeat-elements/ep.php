<div class="tariff form-check d-flex justify-content-between">
    <div>
        <input value="Сертификат без лицензии" class="form-check-input" checked type="radio" name="epTariffDefault"
               id="epTariffDefault1">
        <label class="form-check-label" for="epTariffDefault1">
            Сертификат без лицензии
            <span class="d-block opacity-75">КЭП без лицензии СКЗИ Крипто-ПРО.</span>
        </label>
    </div>
    <p class="price mb-0 rubl strong">4 000</p>
</div>
<hr>
<div class="tariff form-check d-flex justify-content-between">
    <div>
        <input value="Сертификат электронной подписи" class="form-check-input" type="radio" name="epTariffDefault"
               id="epTariffDefault2">
        <label class="form-check-label" for="epTariffDefault2">
            Сертификат электронной подписи
            <span class="d-block opacity-75">КЭП со встроенной лицензией СКЗИ Крипто-ПРО, но без носителя Рутокен.</span>
        </label>
    </div>
    <p class="price mb-0 rubl strong">5 200</p>
</div>
<hr>
<div class="tariff form-check d-flex justify-content-between">
    <div>
        <input value="Квалифицированный сертификат" class="form-check-input" type="radio" name="epTariffDefault"
               id="epTariffDefault3">
        <label class="form-check-label" for="epTariffDefault3">
            Квалифицированный сертификат
            <span class="d-block opacity-75">КЭП со встроенной лицензией СКЗИ Крипто-ПРО и носителем Рутокен.</span>
        </label>
    </div>
    <p class="price mb-0 rubl strong">7 000</p>
</div>
<hr>
<div class="tariff form-check d-flex justify-content-between">
    <div>
        <input value="Лицензия Крипто-Про CSP" class="form-check-input" type="radio" name="epTariffDefault"
               id="epTariffDefault4">
        <label class="form-check-label" for="epTariffDefault4">
            Лицензия Крипто-Про CSP
            <span class="d-block opacity-75">Срок действия Лицензии на СКЗИ «КриптоПро CSP».</span>
        </label>
    </div>
    <p class="price mb-0 rubl strong">от 1 350</p>
</div>
<hr>
<div class="tariff form-check d-flex justify-content-between">
    <div>
        <input value="Носитель Рутокен" class="form-check-input" type="radio" name="epTariffDefault"
               id="epTariffDefault5">
        <label class="form-check-label" for="epTariffDefault5">
            Носитель Рутокен
            <span class="d-block opacity-75">Сертифицированный защищенный носитель Рутокен для подписи.</span>
        </label>
    </div>
    <p class="price mb-0 rubl strong">от 2 000</p>
</div>

<button class="btn popClick d-block d-lg-none my-3 my-lg-0 buy_ep_tariff" data-pop="by_ep_tariff" data-product="ep">
    Оформить ЭП
</button>
<!--noindex-->
<!--googleoff: all-->
<div class="popup" data-max-width="582" id="by_ep_tariff">
    <div class="pop html">
        <p class="title popTitle">Получить <br>электронную подпись</p>
        <p class="desc">Заполните форму и нажмите «Отправить»<br> Наш специалист свяжется с вами в ближайшее время!</p>
		<?= do_shortcode( '[contact-form-7 id="144" title="Получить электронную подпись"]' ) ?>
    </div>
</div>
<!--googleon: all-->
<!--/noindex-->