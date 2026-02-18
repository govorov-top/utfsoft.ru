<?php
$btn_tag = $args["has-link"] == 1 ? "a" : "button";
$btn_link = $btn_tag === "a" ? 'href="' . $args["button-link"] . '"' : "";
$popup = $args["popup"] == 1;
$button = $btn_tag === "a" ? '<p class="mb-0">' : "";
$button .= "<" . $btn_tag . " ";
$button .= $btn_link . " ";
$button .= 'class="' . $args["button-classes"] . '"' . " ";
$button .= 'data-pop="';
$button .= !empty($args["data-pop"]) ? $args["data-pop"] : "page-" . $id . "-popup-1";
$button .= '"';
$btn_scroll = !empty($args["button-scroll"]) ? 'data-scroll-beacon="' . $args("button-scroll") . '"' . " " : "";
$button .= $btn_scroll . " ";
$button .= ">";
$button .= $args["button-text"];
$button .= "</" . $btn_tag . ">";
$button .= $btn_tag === "a" ? "</p>" : "";
echo $button;
