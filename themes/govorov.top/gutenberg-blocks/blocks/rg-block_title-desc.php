<?php
/**
 * Block Name: title-desc
 *
 * This is the template that displays the title-desc component.
 */
$id = get_the_ID();
$titlePage = get_the_title();
// Create class attribute allowing for custom "className" and "align" values.
$classes = "block-title-desc title-desc";
if (!empty($block["className"])) {
    $classes .= " " . $block["className"];
}
if (!empty($block["align"])) {
    $classes .= " align" . $block["align"];
}
$typeTitle = get_field("type_title");
?>
<div class="<?= esc_attr($classes) ?>">
    <<?= $typeTitle ?> class="title text-center pb-4"><?= get_field("title") ?></<?= $typeTitle ?>>
    <div class="desc text-center <?= !have_rows("buttons-and-popup") ? "mb-4 mb-lg-5" : "" ?>"><?= get_field(
    "desc"
) ?></div>

    <?php if (have_rows("buttons-and-popup")): ?>
        <div class="item button-items nav justify-content-center align-items-center mt-4 mb-4 mb-lg-5">
            <?php while (have_rows("buttons-and-popup")):
                the_row();
                ob_start();
                get_template_part("gutenberg-blocks/blocks/addons/buttons", "", [
                    "id" => $id,
                    "has-link" => get_sub_field("has-link"),
                    "button-link" => get_sub_field("button-link"),
                    "popup" => get_sub_field("popup"),
                    "button-classes" => get_sub_field("button-classes"),
                    "data-pop" => get_sub_field("data-pop"),
                    "button-scroll" => get_sub_field("button-scroll"),
                    "button-text" => get_sub_field("button-text"),
                ]);
                $output = ob_get_contents();
                ob_end_clean();
                echo $output;
            endwhile; ?>
        </div>
        <?php while (have_rows("buttons-and-popup")):
            the_row();
            if (get_sub_field("popup") == 1):
                $btn_data = get_sub_field("data-pop");
                $btn_data = !empty($btn_data) ? $btn_data : "page-" . $id . "-popup-1";
                ob_start();
                get_template_part("gutenberg-blocks/blocks/addons/popup", "", [
                    "data-pop" => $btn_data,
                    "popup-max-width" => get_sub_field("popup-max-width"),
                    "popup-title" => get_sub_field("popup-title"),
                    "popup-description" => get_sub_field("popup-description"),
                    "popup-tariff" => get_sub_field("popup-tariff"),
                    "popup-shortcode" => get_sub_field("popup-shortcode"),
                ]);
                $output = ob_get_contents();
                ob_end_clean();
                echo $output;
            endif;
        endwhile;endif; ?>
</div>
