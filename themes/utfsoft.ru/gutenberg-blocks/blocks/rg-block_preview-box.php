<?php
/**
 * Block Name: preview-box
 *
 * This is the template that displays the preview-box component.
 */
$id = get_the_ID();
$titlePage = get_the_title();
// Create class attribute allowing for custom "className" and "align" values.
$classes = "block-preview-box";
if (!empty($block["className"])) {
    $classes .= " " . $block["className"];
}
if (!empty($block["align"])) {
    $classes .= " align" . $block["align"];
}
?>
    <section class="page-<?= $id ?> page-<?= $id ?>_preview
        rg-preview posts_preview pt-5 <?= esc_attr($classes) ?>">


        <div class="container items d-flex flex-wrap justify-content-around justify-content-xl-between align-items-center">
            <div class="item content">
                <h1 class="title p-0">
                    <?php if (have_rows("content")): ?>
                        <?php while (have_rows("content")):
                            the_row();
                            $btn_tag = get_sub_field("has-italic") == 1 ? "em" : "span";
                            $title_part = "<" . $btn_tag . " ";
                            $title_part .= 'class="' . get_sub_field("title-classes") . '"' . " ";
                            $title_part .= ">";
                            $title_part .= get_sub_field("title-text");
                            $title_part .= "</" . $btn_tag . ">";
                            echo $title_part;
                        endwhile; ?>
                    <?php endif; ?>
                </h1>
                <div class="items d-flex my-4 my-xl-5 align-items-center">
                    <picture class="item image d-block">
                        <source media="(max-width: 575.98px)" srcset="<?= get_field("image-mini-576") ?>" />
                        <source media="(max-width: 1199.98px)" srcset="<?= get_field("image-mini-1200") ?>" />
                        <img alt="<?= $titlePage ?>" src="<?= get_field("image-mini") ?>">
                    </picture>
                    <div class="item text ms-3">
                       <?php the_field("description"); ?>
                    </div>
                </div>
                <div class="item button-items nav align-items-center">
                    <?php if (have_rows("buttons-and-popup")): ?>
                        <?php while (have_rows("buttons-and-popup")):
                            the_row();
                            $btn_tag = get_sub_field("has-link") == 1 ? "a" : "button";
                            $btn_link = $btn_tag === "a" ? 'href="' . get_sub_field("button-link") . '"' : "";
                            $popup = get_sub_field("popup") == 1;
                            $button = $btn_tag === "a" ? '<p class="mb-0">' : "";
                            $button .= "<" . $btn_tag . " ";
                            $button .= $btn_link . " ";
                            $button .= 'class="' . get_sub_field("button-classes") . '"' . " ";
                            $button .= 'data-pop="';
                            $button .= !empty(get_sub_field("data-pop"))
                                ? get_sub_field("data-pop")
                                : "page-" . $id . "-popup-1";
                            $button .= '"';
                            $btn_scroll = !empty(get_sub_field("button-scroll"))
                                ? 'data-scroll-beacon="' . get_sub_field("button-scroll") . '"' . " "
                                : "";
                            $button .= $btn_scroll . " ";
                            $button .= ">";
                            $button .= get_sub_field("button-text");
                            $button .= "</" . $btn_tag . ">";
                            $button .= $btn_tag === "a" ? "</p>" : "";
                            echo $button;
                        endwhile;endif; ?>
                </div>
            </div>
            <picture class="item image d-none d-md-block">
                <source media="(max-width: 991.98px)" srcset="<?= get_field("image-992") ?>" />
                <source media="(max-width: 1199.98px)" srcset="<?= get_field("image-1200") ?>" />
                <source media="(max-width: 1399.98px)" srcset="<?= get_field("image-1400") ?>" />
                <img alt="<?= $titlePage ?>" src="<?= get_field("image") ?>" />
            </picture>
        </div>
    </section>
<?php if (have_rows("buttons-and-popup")): ?>
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
    endwhile; ?>
<?php endif; ?>
