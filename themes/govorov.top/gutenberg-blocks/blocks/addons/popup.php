<!--noindex-->
<!--googleoff: all-->
<div class="popup" data-max-width="<?= $args["popup-max-width"] ?>" id="<?= $args["data-pop"] ?>">
    <div class="pop html">
        <p class="title mb-3"><?= $args["popup-title"] ?></p>
        <?php if ($args["popup-tariff"]): ?>
            <p class="rg-font-24-regular text-center mb-3"><?= $args["popup-tariff"] ?></p>
        <?php endif; ?>
        <p class="desc mb-3"><?= $args["popup-description"] ?></p>
        <?= do_shortcode($args["popup-shortcode"]) ?>
    </div>
</div>
<!--googleon: all-->
<!--/noindex-->