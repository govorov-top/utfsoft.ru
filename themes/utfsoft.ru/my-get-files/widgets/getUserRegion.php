<div class="rgGetUserRegion item">
    <p class="d-inline-block mb-0">
        <i class="bi bi-geo-alt me-0 color-blue"></i>
        <span class="text d-none d-xl-inline-block">Ваш город:</span>
        <span class="setUserCity mb-0">
        <a href="javascript:" class="popClick strong" data-pop="rgGetUserRegion">
            <?= ! empty( $_COOKIE['cityUser'] ) ? $_COOKIE['cityUser'] : 'Москва' ?>
        </a>
    </span>
    </p>

    <div class="d-none hintCheckUserRegion shadow">
        <p class="mb-1">Это ваш город?</p>
        <div class="items d-flex flex-wrap justify-content-around">
            <p class="item stopPopupGetRegion">Да</p>
            <p class="item popClick" data-pop="rgGetUserRegion">Нет</p>
        </div>
    </div>

    <!--noindex-->
    <!--googleoff: all-->
    <div class="popup" data-max-width="620" id="rgGetUserRegion">
        <div class="pop html bg-white">
            <p class="title text-start">Ваш регион</p>
            <p class="desc text-start mx-0">Для корректного отображения цен и акций, уточните ваш город в поле ниже:</p>

            <div class="myform items d-flex align-items-center">
                <div class="item">
				<span class="form-floating d-block">
                    <?php
                    $city = ! empty( $_COOKIE['cityUser'] ) ? $_COOKIE['cityUser'] : 'Москва';
                    $region = ! empty( $_COOKIE['regionUser'] ) ? $_COOKIE['regionUser'] : 'Московская обл';
                    ?>
					<input autocomplete="off" type="text" name="region" value="<?= $city . ', ' . $region ?>"
                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"
                           id="rgInputUserRegion" aria-required="true" aria-invalid="false"
                           placeholder="<?= $city . ', ' . $region ?>">
					<label for="rgInputUserRegion" style="color: #949494">
						Укажите ваш город
					</label>
				</span>
                </div>
                <div>
                    <p class="mb-0"><a href="javascript:" class="btn setUserRegionInfo" data-city="<?= $city ?>"
                                       data-region="<?= $region ?>">Сохранить</a></p>
                </div>
            </div>

            <p class="clearInputRegion">
                <i class="bi bi-arrow-repeat"></i>
                Очистить поле
            </p>

            <div class="offers dropdown">
                <ul class="list-offers mb-0 p-3 shadow">
                    <li data-city="Москва" data-region="Московская область">Москва, Московская обл</li>
                    <li data-city="Санкт-Петербург" data-region="Ленинградская обл">Санкт-Петербург, Ленинградская обл
                    </li>
                    <li data-city="Новосибирск" data-region="Новосибирская обл">Новосибирск, Новосибирская обл</li>
                    <li data-city="Екатеринбург" data-region="Свердловская обл">Екатеринбург, Свердловская обл</li>
                    <li data-city="Казань" data-region="Респ Татарстан">Казань, Респ Татарстан</li>
                    <li data-city="Нижний Новгород" data-region="Нижегородская обл">Нижний Новгород, Нижегородская обл
                    </li>
                    <li data-city="Челябинск" data-region="Челябинская обл">Челябинск, Челябинская обл</li>
                    <li data-city="Самара" data-region="Самарская обл">Самара, Самарская обл</li>
                    <li data-city="Омск" data-region="Омская обл">Омск, Омская обл</li>
                    <li data-city="Ростов-на-Дону" data-region="Ростовская обл">Ростов-на-Дону, Ростовская обл</li>
                    <li data-city="Уфа" data-region="Респ Башкортостан">Уфа, Республика Башкортостан</li>
                </ul>
            </div>
            <p class="cities mt-3 strong">Часто используемые города:</p>
            <div class="offers not-absolute visible">
                <ul class="list-offers rg-list rg-list_circle pb-0 position-relative" style="z-index: 0">
                    <li data-city="Москва" data-region="Московская область">Москва, Московская обл</li>
                    <li data-city="Санкт-Петербург" data-region="Ленинградская обл">Санкт-Петербург, Ленинградская обл
                    </li>
                    <li data-city="Новосибирск" data-region="Новосибирская обл">Новосибирск, Новосибирская обл</li>
                    <li data-city="Екатеринбург" data-region="Свердловская обл">Екатеринбург, Свердловская обл</li>
                    <li data-city="Казань" data-region="Респ Татарстан">Казань, Респ Татарстан</li>
                    <li data-city="Нижний Новгород" data-region="Нижегородская обл">Нижний Новгород, Нижегородская обл
                    </li>
                    <li data-city="Челябинск" data-region="Челябинская обл">Челябинск, Челябинская обл</li>
                    <li data-city="Самара" data-region="Самарская обл">Самара, Самарская обл</li>
                    <li data-city="Омск" data-region="Омская обл">Омск, Омская обл</li>
                    <li data-city="Ростов-на-Дону" data-region="Ростовская обл">Ростов-на-Дону, Ростовская обл</li>
                    <li data-city="Уфа" data-region="Респ Башкортостан">Уфа, Республика Башкортостан</li>
                </ul>
            </div>
        </div>
    </div>
    <!--googleon: all-->
    <!--/noindex-->

</div>