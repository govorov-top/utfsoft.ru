<?php
/**
 * Block Name: accordion
 *
 * This is the template that displays the preview-box component.
 */
$id = get_the_ID();
$titlePage = get_the_title();
$i = 0;
// Create class attribute allowing for custom "className" and "align" values.
$classes = "block-accordion";
if (!empty($block["className"])) {
    $classes .= " " . $block["className"];
}
if (!empty($block["align"])) {
    $classes .= " align" . $block["align"];
}
?>
<?php if (have_rows("rg-accordion")): ?>
    <div class="accordion rg-accordion mb-0" id="rg-accordion_<?= $id ?>">
        <?php while (have_rows("rg-accordion")):

            the_row();
            $i++;
            ?>
            <div class="accordion-item overflow-hidden">
                <p class="accordion-header" id="rg-accordion_heading_<?= $i ?>">
                    <button class="accordion-button <?= $i !== 1
                        ? "collapsed"
                        : "" ?>" type="button" data-bs-toggle="collapse" data-bs-target="#rg-accordion_collapse_<?= $i ?>" aria-expanded="<?= $i ===
1
    ? "true"
    : "false" ?>" aria-controls="rg-accordion_collapse_<?= $i ?>">
                        <?php the_sub_field("title"); ?>
                    </button>
                </p>
                <div id="rg-accordion_collapse_<?= $i ?>" class="accordion-collapse collapse <?= $i === 1
    ? "show"
    : "" ?>" aria-labelledby="rg-accordion_heading_<?= $i ?>" data-bs-parent="#rg-accordion_<?= $id ?>">
                    <div class="item accordion-body pt-0">
                        <?php the_sub_field("description"); ?>
                        <?php if (have_rows("buttons-and-popup")): ?>
                            <div class="item button-items nav d-flex flex-wrap">
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
                                    $button .= ">";
                                    $button .= get_sub_field("button-text");
                                    $button .= "</" . $btn_tag . ">";
                                    $button .= $btn_tag === "a" ? "</p>" : "";
                                    echo $button;
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
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        endwhile; ?>
    </div>
<?php endif; ?>
