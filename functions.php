<?php
/**
 * Created by PhpStorm.
 * Date: 13-11-14
 * Time: 下午11:27
 * @overview 
 * @author Meatill <lujia.zhai@dianjoy.com>
 * @since 
 */

function woo_load_frontend_css () {
  // do nothing
}

function line_setup() {
  add_image_size('homepage-active', 257, 193);
  add_image_size('single-active', 100, 100);
}
add_action('after_setup_theme', 'line_setup');