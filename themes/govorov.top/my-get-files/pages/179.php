<?php if ( ! empty( $_GET['vhod'] ) ) : ?>
    <style>
        #header, #footer {
            display: none !important;
        }
    </style>
    <div class="page-179 game">
        <p class="desc h5 py-4 text-center">Ваша ссылка скоро сформируется, пока поиграйте в нашу игру!</p>
        <div class="container d-flex flex-wrap justify-content-center align-items-center">
            <div id="game-board" class="strong order-1 order-md-0">
                <div class="r">
                    <div class="cell" data-cell></div>
                    <div class="cell" data-cell></div>
                    <div class="cell" data-cell></div>
                </div>
                <div class="r">
                    <div class="cell" data-cell></div>
                    <div class="cell" data-cell></div>
                    <div class="cell" data-cell></div>
                </div>
                <div class="r">
                    <div class="cell" data-cell></div>
                    <div class="cell" data-cell></div>
                    <div class="cell" data-cell></div>
                </div>
            </div>
            <div id="timer" class="text-center order-0 order-md-1 mb-3 mb-md-0">
                <span id="time" class="d-block">02:00</span>
            </div>
        </div>
        <div id="message" class="hidden"></div>
        <p class="d-flex mt-4 text-center">
            <a href="/connect/" class="btn btn_yellow btn_center">Подключить Контур.Диадок</a>
        </p>
    </div>
<?php else: ?>
	<?= do_shortcode( '[rg-code f="repeat-elements/action-25.php"]' ) ?>

    <section class="page-179 section_1">
        <div class="container mini">
            <h2>Вы уже подключились к Контур.<span>Диадок</span>?</h2>
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col">
                    <div class="rg-card shadow text-center">
                        <div class="img d-flex flex-column img justify-content-center shadow">
                            <img class="mx-auto" src="/wp-content/themes/govorov.top/assets/img/pages/vhod/icon_2.png"
                                 alt="Вход в личный кабинет">
                        </div>
                        <p class="title h5">
                            <span>Подключиться</span><br>к сервису<br>Контур.Диадок
                        </p>
                        <p class="desc">Если вы являетесь новичком, но хотите стать постоянным клиентом сервиса, в таком
                            случае нажмите на кнопку «Подключиться».</p>
                        <p class="mb-0"><a href="/connect/" class="btn yellow">Подключиться</a></p>
                    </div>
                </div>
                <div class="col">
                    <div class="rg-card shadow text-center">
                        <div class="img d-flex flex-column img justify-content-center shadow">
                            <img class="mx-auto" src="/wp-content/themes/govorov.top/assets/img/pages/vhod/icon_1.png"
                                 alt="Вход в личный кабинет">
                        </div>
                        <p class="title h5"><span>Вход</span><br>в личный кабинет Контур.Диадок
                        </p>
                        <p class="desc">Если вы уже подсоединились к системе, нажмите «Войти», чтобы попасть в
                            «Персональный кабинет» и начать работать в системе с ЭДО.</p>
                        <p class="mb-0">
                            <a href="https://kontur.ru?utm_sorce=3" class="btn btn-blank"
                               rel="nofollow noopener noreferrer" target="_blank">Войти</a>
                        </p>
                    </div>
                </div>
            </div>
            <p class="mb-0 mt-4">При подключении наши специалисты расскажут вам более подробно, что нужно сделать, чтобы
                освоить отличный онлайн-инструмент, позволяющий упростить электронный документооборот и справиться с
                любой поставленной задачей!
            </p>
        </div>
    </section>
	<?= do_shortcode( '[rg-code f="repeat-elements/fast-connect-form.php"]' ) ?>
<?php endif; ?>
