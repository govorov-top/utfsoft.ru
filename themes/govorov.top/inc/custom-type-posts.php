<?php
/***************************************************************
 * Кастомные страницы
 * - Отзывы
 ****************************************************************/

/**
 * Кастомные страницы
 */

/**
 * Отзывы
 */

function rg_testimonials() {

    /**
     * Post Type: Отзывы.
     */
    register_post_type( "testimonials", [
        "label" => __( "Отзывы", "govorov.top" ),
        "labels" => [
            "name" => __( "Отзывы", "govorov.top" ),
            "singular_name" => __( "Отзывы", "govorov.top" ),
            "menu_name" => __( "Отзывы", "govorov.top" ),
            "all_items" => __( "Все отзывы", "govorov.top" ),
            "add_new" => __( "Добавить", "govorov.top" ),
            "add_new_item" => __( "Добавить новый отзыв", "govorov.top" ),
            "edit_item" => __( "Редактировать отзыв", "govorov.top" ),
            "new_item" => __( "Новый отзыв", "govorov.top" ),
            "view_item" => __( "Просмотр", "govorov.top" ),
            "view_items" => __( "Просмотр", "govorov.top" ),
            "search_items" => __( "Поиск", "govorov.top" ),
            "not_found" => __( "Отзыв не найден", "govorov.top" ),
            "not_found_in_trash" => __( "В корзине нет отзывов", "govorov.top" ),
            "parent" => __( "Parent Отзывы:", "govorov.top" ),
            "featured_image" => __( "Главное изображение для этого отзыва", "govorov.top" ),
            "set_featured_image" => __( "Установить рекомендуемое изображение для этого отзыва", "govorov.top" ),
            "remove_featured_image" => __( "Удалить избранные изображения для этого отзыва", "govorov.top" ),
            "use_featured_image" => __( "Использовать как изображение для этого отзыва", "govorov.top" ),
            "archives" => __( "Архив", "govorov.top" ),
            "insert_into_item" => __( "Вставить", "govorov.top" ),
            "uploaded_to_this_item" => __( "Загрузить", "govorov.top" ),
            "filter_items_list" => __( "Фильтр", "govorov.top" ),
            "items_list_navigation" => __( "Навигация", "govorov.top" ),
            "items_list" => __( "Отзывы list", "govorov.top" ),
            "attributes" => __( "Отзывы attributes", "govorov.top" ),
            "name_admin_bar" => __( "Отзывы", "govorov.top" ),
            "item_published" => __( "Отзывы published", "govorov.top" ),
            "item_published_privately" => __( "Отзывы published privately.", "govorov.top" ),
            "item_reverted_to_draft" => __( "Отзывы reverted to draft.", "govorov.top" ),
            "item_scheduled" => __( "Отзывы scheduled", "govorov.top" ),
            "item_updated" => __( "Отзывы обновлены", "govorov.top" ),
            "parent_item_colon" => __( "Parent Отзывы:", "govorov.top" ),
        ],
        "description" => "Отзывы",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => null,
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "post_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "testimonials", "with_front" => true ],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-users",
        'taxonomies' => array('mark'),
        "supports" => [ "title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats" ],
    ] );
}
add_action( 'init', 'rg_testimonials' );
// - Метки для страницы Отзывов
function rg_testimonials_taxes() {

    /**
     * Taxonomy: marks.
     */

    $labels = [
        "name" => __( "Метки", "govorov.top" ),
        "singular_name" => __( "Метка", "govorov.top" ),
        "menu_name" => __( "Метки", "govorov.top" ),
        "all_items" => __( "Все метки", "govorov.top" ),
        "edit_item" => __( "Редактировать метку", "govorov.top" ),
        "view_item" => __( "Просмотр метри", "govorov.top" ),
        "update_item" => __( "Обновить метку", "govorov.top" ),
        "add_new_item" => __( "Добавить метку", "govorov.top" ),
        "new_item_name" => __( "Название метки", "govorov.top" ),
        "parent_item" => __( "Родительская метка", "govorov.top" ),
        "parent_item_colon" => __( "Родительская метка:", "govorov.top" ),
        "search_items" => __( "Найти метку", "govorov.top" ),
        "popular_items" => __( "Популярная метка", "govorov.top" ),
        "separate_items_with_commas" => __( "Разделяйте метки запятыми", "govorov.top" ),
        "add_or_remove_items" => __( "Добавить или удалить метку", "govorov.top" ),
        "choose_from_most_used" => __( "Выберите из наиболее часто используемых меток", "govorov.top" ),
        "not_found" => __( "Метка не найдена", "govorov.top" ),
        "no_terms" => __( "Нет меток", "govorov.top" ),
        "items_list_navigation" => __( "Навигация по списку меток", "govorov.top" ),
        "items_list" => __( "Список меток", "govorov.top" ),
        "back_to_items" => __( "Вернуться к метке", "govorov.top" ),
    ];
    $args = [
        "label" => __( "Метки", "govorov.top" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'mark', 'with_front' => true, ],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "mark",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "mark", [ "testimonials" ], $args );
}
add_action( 'init', 'rg_testimonials_taxes' );