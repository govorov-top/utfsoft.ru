<!--noindex-->
<!--googleoff: all-->
<div id="social-block" class="hidden">
    <div class="item phone popClick" data-pop="web-zvonok_pop" data-bs-toggle="tooltip" data-bs-placement="right"
         title="Обратный звонок"></div>
    <div class="item mail popClick" data-pop="social-block_feedback" data-bs-toggle="tooltip" data-bs-placement="right"
         title="Отправить сообщение"></div>
    <div class="item chat" data-bs-toggle="tooltip" data-bs-placement="right" title="Написать в чат"></div>
    <div class="item calculator popClick" data-pop="brief_popUp" data-bs-toggle="tooltip" data-bs-placement="right"
         title="Получить расчет"></div>
    <div class="item hidden" data-bs-toggle="tooltip" data-bs-placement="right" title="Скрыть окно"></div>
</div>
<div id="social-block-fade" class="visible"></div>
<div class="popup" data-max-width="582" id="social-block_feedback">
    <div class="pop html">
        <p class="title">Возник вопрос?</p>
        <p class="desc">Заполните форму и нажмите «Отправить»<br> Наш специалист свяжется с вами в ближайшее время!</p>
		<?= do_shortcode( '[contact-form-7 id="7550" title="Обратная связь"]' ) ?>
    </div>
</div>
<!--googleon: all-->
<!--/noindex-->