<?php
/**
 * Block Name: feedback
 *
 * This is the template that displays the preview-box component.
 */
$id = get_the_ID();
$titlePage = get_the_title();
// Create class attribute allowing for custom "className" and "align" values.
$classes = "block-feedback";
if (!empty($block["className"])) {
    $classes .= " " . $block["className"];
}
if (!empty($block["align"])) {
    $classes .= " align" . $block["align"];
}
?>
<section class="page-<?= $id ?> page-<?= $id ?>_feedback-box feedback-box pt-5 <?= esc_attr($classes) ?>">
    <div class="container">
        <div class="items content position-relative overflow-hidden shadow shadow-box mx-auto">
            <div class="row justify-content-around align-items-center">
                <div class="col-lg-6 col-md-5 mb-4 mb-md-0">
                    <picture class="item picture d-block mb-5">
                        <source media="(max-width: 991.98px)" srcset="<?= get_theme_file_uri(
                            "assets/img/logotypes/header-logotype-white-992.png"
                        ) ?>" />
                        <img  class="w-auto" src="<?= get_theme_file_uri(
                            "assets/img/logotypes/header-logotype-white.png"
                        ) ?>" alt="Фокус Онлайн логотип">
                    </picture>
                    <div class="item texts color-white position-relative">
                        <h2 class="title strong pb-0"><?php the_field("title"); ?></h2>
                        <div class="desc my-4">
                            <?php the_field("description"); ?>
                        </div>
                        <div class="item info border border-2 d-flex flex-wrap justify-content-lg-around py-2 mb-4">
                            <?= do_shortcode("[site_info phone]") ?>
                            <?= do_shortcode("[site_info email]") ?>
                        </div>
                        <div class="items social d-flex flex-wrap gap-4 position-relative">
                            <a href="/"
                               rel="nofollow noopener noreferrer"
                               target="_blank">
                                <img class="w-auto" src="<?= get_theme_file_uri(
                                    "assets/img/components/icon-vk.png"
                                ) ?>" alt="Фокус Онлайн - ВКонтакте">
                            </a>
                            <a href="https://api.whatsapp.com/send?phone=74952258118&text=%D0%94%D0%BE%D0%B1%D1%80%D1%8B%D0%B9%20%D0%B4%D0%B5%D0%BD%D1%8C!%20%D0%AF%20%D1%81%20%D1%81%D0%B0%D0%B9%D1%82%D0%B0%20kontur-center.ru.%20%D0%A3%20%D0%BC%D0%B5%D0%BD%D1%8F%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20"
                               rel="nofollow noopener noreferrer"
                               target="_blank">
                                <img class="w-auto" src="<?= get_theme_file_uri(
                                    "assets/img/components/icon-whatsapp.png"
                                ) ?>" alt="Фокус Онлайн - написать в Вотсапп">
                            </a>
                        </div>
                    </div>
                    <span class="dots position-absolute bottom-0"></span>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-7">
                    <div class="item form shadow shadow-box text-center mx-auto bg-white mb-0">
                        <p class="title h5 pb-3">Оставьте заявку</p>
                        <p class="desc">Заполните простую форму и наш менеджер свяжется с вами!</p>
                        <?= do_shortcode('[contact-form-7 id="523" title="Форма feedback: .rg-block_feedback"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>