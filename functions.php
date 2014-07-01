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

// 为ajax提供接口
function line_add_ajax_url() {
  wp_localize_script('function', 'line', array(
    'ajax_url' => admin_url('admin-ajax.php'),
  ));
}
add_action('template_redirect', 'line_add_ajax_url');

// 把jquery放到最后
if( !is_admin()){
  wp_deregister_script('jquery');
  wp_register_script('jquery', ("//cdn.staticfile.org/jquery/2.1.1/jquery.min.js"), null, '2.1.1', true);
  wp_enqueue_script('jquery');
}

// 登录
function line_login() {
  if ($_POST['action'] == 'line_login') {
    $credentials = array();
    $result = array();
    $credentials['user_login'] = $_POST['user_login'];
    $credentials['user_password'] = $_POST['user_password'];
    $credentials['remember'] =  $_POST['remember'];
    if ($credentials['user_login'] == '') {
      $result['code'] = 1;
      $result['msg'] = '用户名不能为空';
    } elseif($credentials['user_password']=='') {
      $result['code'] = 2;
      $result['msg'] = '密码不能为空';
    } elseif($credentials['remember']=='') {
      $result['code'] = 3;
      $result['msg'] = '致命错误';
    } else {
      $user = wp_signon($credentials, false);//array,是否加密cookie
      if (is_wp_error($user)) {
        $result['code'] = 4;
        $result['msg'] = $user->get_error_message();
      } else {
        $result['code'] = 0;
        $result['msg'] = '登录成功';
      }
    }
    header("Content-Type: application/json");
    echo json_encode($result);
    exit;
  }
}