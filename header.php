<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge" >
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <title>
    <?php
    if (is_category()) {
        echo 'Category: ' . single_cat_title('', false) . ' | ' . get_bloginfo('name');
    } elseif (is_single()) {
        echo get_the_title() . ' | ' . get_bloginfo('name');
    } elseif (is_home() || is_front_page()) {
        echo get_bloginfo('name');
    } else {
        echo wp_title('', false) . ' | ' . get_bloginfo('name');
    }
    ?>
  </title>
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="wrapper">
      <header class="header">
        <div class="header__container"></div>
      </header>
      <main class="page">
