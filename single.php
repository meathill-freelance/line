<?php
/**
 * Created by PhpStorm.
 * Date: 13-11-14
 * Time: 下午11:38
 * @overview 
 * @author Meatill <lujia.zhai@dianjoy.com>
 * @since 
 */
get_header();

if (have_posts()) {the_post();
  $content = get_the_content('继续阅读');
  $blog = array(
    'id' => get_the_ID(),
    'is_featured' => is_sticky() && is_home() && ! is_paged(),
    'class' => join(' ', get_post_class($class, $post_id)),
    'full_title' => the_title_attribute(array('echo' => FALSE)),
    'is_search' => is_search(),
    'link' => apply_filters('the_permalink', get_permalink()),
    'date' => apply_filters('the_time', get_the_time('Y-m-d'), 'Y年m月d日'),
    'excerpt' => apply_filters('the_excerpt', get_the_excerpt()),
    'content' => apply_filters('the_content', $content),
    'category' => get_the_category_list(' <span class="divider">/</span></li><li>'),
    'tags' => apply_filters('the_tags', get_the_term_list(0, 'post_tag', '', '，'), '', '，', '', 0),
  );
}

require_once(dirname(__FILE__) . '/inc/mustache.php');
$tpl = new Mustache_Engine();
$template = dirname(__FILE__) . '/template/single.html';
$template = file_get_contents($template);
$template = str_replace('"../', '"{{theme_url}}wp-content/themes/line/', $template);

$home_url = esc_url(home_url('/'));
echo $tpl->render($template, $blog);

get_footer();