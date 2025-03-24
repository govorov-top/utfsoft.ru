<?php
/**
 * Block Name: fancy-images
 *
 * This is the template that displays the fancy-images component.
 */

// Create class attribute allowing for custom "className" and "align" values.
$classes = "block-fancy-images";
if (!empty($block["className"])) {
    $classes .= " " . $block["className"];
}
if (!empty($block["align"])) {
    $classes .= " align" . $block["align"];
}
$id_img = get_field("image");
?>
<a title="<?= get_field(
    "image_title"
) ?>" class="d-inline-block shadow shadow-box overflow-hidden p-0 mb-3 <?= esc_attr(
    $classes
) ?>" data-fancybox="<?= get_field("data-fancybox") ?>" href="<?= wp_get_attachment_image_src($id_img, "faq")[0] ?>">
    <picture>
        <source media="(max-width: 535.98px)" srcset="" data-srcset="<?= wp_get_attachment_image_src(
            $id_img,
            "faq_450"
        )[0] ?>" />
        <source media="(max-width: 767.98px)" srcset="" data-srcset="<?= wp_get_attachment_image_src(
            $id_img,
            "faq_513"
        )[0] ?>" />
        <img class="lazy w-100"
             alt="<?= get_field("image_title") ?>" 
             src="" 
             data-src="<?= wp_get_attachment_image_src($id_img, "faq_660")[0] ?>" />
    </picture>
</a>