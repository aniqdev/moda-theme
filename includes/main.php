<?php
/**
 * Load files.
 *
 * @package Kumle
 */

// Customizer additions.
require_once trailingslashit( KW_TEMPLATE_DIRECTORY ) . '/includes/customizer/customizer.php';

// Load core functions.
require_once trailingslashit( KW_TEMPLATE_DIRECTORY ) . '/includes/customizer/core.php';

// Load helper functions.
require_once trailingslashit( KW_TEMPLATE_DIRECTORY ) . '/includes/helpers.php';

// Custom template tags for this theme.
require_once trailingslashit( KW_TEMPLATE_DIRECTORY ) . '/includes/template-tags.php';

// Custom functions that act independently of the theme templates.
require_once trailingslashit( KW_TEMPLATE_DIRECTORY ) . '/includes/template-functions.php';

// Load hooks.
// require_once trailingslashit( KW_TEMPLATE_DIRECTORY ) . '/includes/hooks.php';

// Load dynamic css.
require_once trailingslashit( KW_TEMPLATE_DIRECTORY ) . '/includes/dynamic.php';

// Load dynamic css.
require_once trailingslashit( KW_TEMPLATE_DIRECTORY ) . '/includes/admin-page-reading.php';