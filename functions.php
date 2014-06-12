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

/**
 * 添加文章类型
 * feedback 业内评价
 * partner 合作伙伴
 */
function create_post_type() {
  register_post_type('faq',
    array(
      'labels' => array(
        'name' => '常见问题',
        'singular_name' => '常见问题',
        'all_items' => '全部问题',
        'add_new' => '新增问题',
        'add_new_item' => '新增问题',
        'new_item' => '常见问题',
      ),
      'public' => true,
      'rewrite' => array('slug' => 'faq'),
      'description' => '常见问题页的问答，每篇对应一条，标题是问题，内容是答案。',
      'exclude_from_search' => false,
      'show_in_nav_menus' => false,
      'publicly_queryable' => false,
      'supports' => array('title', 'editor'),
    )
  );
}
add_action('init', 'create_post_type');

// 把jquery放到最后
if( !is_admin()){
  wp_deregister_script('jquery');
  wp_register_script('jquery', ("//cdn.staticfile.org/jquery/2.1.1/jquery.min.js"), false, '2.1.1', true);
  wp_enqueue_script('jquery');
}