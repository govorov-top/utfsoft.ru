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

function rg_testimonials()
{

    /**
     * Post Type: Отзывы.
     */
    register_post_type("testimonials", [
        "label" => __("Отзывы", "utfsoft.ru"),
        "labels" => [
            "name" => __("Отзывы", "utfsoft.ru"),
            "singular_name" => __("Отзывы", "utfsoft.ru"),
            "menu_name" => __("Отзывы", "utfsoft.ru"),
            "all_items" => __("Все отзывы", "utfsoft.ru"),
            "add_new" => __("Добавить", "utfsoft.ru"),
            "add_new_item" => __("Добавить новый отзыв", "utfsoft.ru"),
            "edit_item" => __("Редактировать отзыв", "utfsoft.ru"),
            "new_item" => __("Новый отзыв", "utfsoft.ru"),
            "view_item" => __("Просмотр", "utfsoft.ru"),
            "view_items" => __("Просмотр", "utfsoft.ru"),
            "search_items" => __("Поиск", "utfsoft.ru"),
            "not_found" => __("Отзыв не найден", "utfsoft.ru"),
            "not_found_in_trash" => __("В корзине нет отзывов", "utfsoft.ru"),
            "parent" => __("Parent Отзывы:", "utfsoft.ru"),
            "featured_image" => __("Главное изображение для этого отзыва", "utfsoft.ru"),
            "set_featured_image" => __("Установить рекомендуемое изображение для этого отзыва", "utfsoft.ru"),
            "remove_featured_image" => __("Удалить избранные изображения для этого отзыва", "utfsoft.ru"),
            "use_featured_image" => __("Использовать как изображение для этого отзыва", "utfsoft.ru"),
            "archives" => __("Архив", "utfsoft.ru"),
            "insert_into_item" => __("Вставить", "utfsoft.ru"),
            "uploaded_to_this_item" => __("Загрузить", "utfsoft.ru"),
            "filter_items_list" => __("Фильтр", "utfsoft.ru"),
            "items_list_navigation" => __("Навигация", "utfsoft.ru"),
            "items_list" => __("Отзывы list", "utfsoft.ru"),
            "attributes" => __("Отзывы attributes", "utfsoft.ru"),
            "name_admin_bar" => __("Отзывы", "utfsoft.ru"),
            "item_published" => __("Отзывы published", "utfsoft.ru"),
            "item_published_privately" => __("Отзывы published privately.", "utfsoft.ru"),
            "item_reverted_to_draft" => __("Отзывы reverted to draft.", "utfsoft.ru"),
            "item_scheduled" => __("Отзывы scheduled", "utfsoft.ru"),
            "item_updated" => __("Отзывы обновлены", "utfsoft.ru"),
            "parent_item_colon" => __("Parent Отзывы:", "utfsoft.ru"),
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
        "rewrite" => ["slug" => "testimonials", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-admin-users",
        'taxonomies' => array('mark'),
        "supports" => ["title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats"],
    ]);
}

add_action('init', 'rg_testimonials');
// - Метки для страницы Отзывов
function rg_testimonials_taxes()
{

    /**
     * Taxonomy: marks.
     */

    $labels = [
        "name" => __("Метки", "utfsoft.ru"),
        "singular_name" => __("Метка", "utfsoft.ru"),
        "menu_name" => __("Метки", "utfsoft.ru"),
        "all_items" => __("Все метки", "utfsoft.ru"),
        "edit_item" => __("Редактировать метку", "utfsoft.ru"),
        "view_item" => __("Просмотр метри", "utfsoft.ru"),
        "update_item" => __("Обновить метку", "utfsoft.ru"),
        "add_new_item" => __("Добавить метку", "utfsoft.ru"),
        "new_item_name" => __("Название метки", "utfsoft.ru"),
        "parent_item" => __("Родительская метка", "utfsoft.ru"),
        "parent_item_colon" => __("Родительская метка:", "utfsoft.ru"),
        "search_items" => __("Найти метку", "utfsoft.ru"),
        "popular_items" => __("Популярная метка", "utfsoft.ru"),
        "separate_items_with_commas" => __("Разделяйте метки запятыми", "utfsoft.ru"),
        "add_or_remove_items" => __("Добавить или удалить метку", "utfsoft.ru"),
        "choose_from_most_used" => __("Выберите из наиболее часто используемых меток", "utfsoft.ru"),
        "not_found" => __("Метка не найдена", "utfsoft.ru"),
        "no_terms" => __("Нет меток", "utfsoft.ru"),
        "items_list_navigation" => __("Навигация по списку меток", "utfsoft.ru"),
        "items_list" => __("Список меток", "utfsoft.ru"),
        "back_to_items" => __("Вернуться к метке", "utfsoft.ru"),
    ];
    $args = [
        "label" => __("Метки", "utfsoft.ru"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'mark', 'with_front' => true,],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "mark",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("mark", ["testimonials"], $args);
}

add_action('init', 'rg_testimonials_taxes');
