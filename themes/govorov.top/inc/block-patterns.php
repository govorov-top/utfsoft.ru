<?php
/**
 * Регистрирует шаблоны блоков и категории.
 *
 */

/**
 * Registers block patterns and categories.
 */
function rg_register_block_patterns() {
	$block_pattern_categories = array(
        'Компоненты'   => array( 'label' => __( 'Компоненты', 'rg' ) ),
	);

	/**
	 * Фильтрует категории шаблонов тематических блоков.
	 */
	$block_pattern_categories = apply_filters( 'rg_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	$block_patterns = array(
		'header',
		'tariffs',
	);

	/**
	 * Фильтрует шаблоны тематических блоков.
	 */
	$block_patterns = apply_filters( 'rg_block_patterns', $block_patterns );
	foreach ( $block_patterns as $block_pattern ) {
		$pattern_file = get_theme_file_path( '/inc/patterns/' . $block_pattern . '.php' );
		register_block_pattern(
			'rg/' . $block_pattern,
			require $pattern_file
		);
	}
}
add_action( 'init', 'rg_register_block_patterns', 9 );
