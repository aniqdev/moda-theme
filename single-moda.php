<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Kumle
 */


if (isset($_GET['amp'])) {

	get_header('amp');

	include __DIR__.'/single-moda-amp.php';

	get_footer('amp');

}else{

	get_header();

	include __DIR__.'/single-moda-original.php';

	get_footer();

}

