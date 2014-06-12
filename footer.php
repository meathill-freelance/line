<?php
/**
 * Created by PhpStorm.
 * Date: 13-11-14
 * Time: 下午11:01
 * @overview 
 * @author Meatill <lujia.zhai@dianjoy.com>
 * @since 
 */

require_once(dirname(__FILE__) . '/inc/mustache.php');
$tpl = new Mustache_Engine();

$result = array(
  'theme_url' => esc_url(home_url('/')),
);
// 公司新闻
if (have_posts()) {
  $blog = array();
  $count = 0;
  while (have_posts()) {
    the_post();
    $blog[] = array(
      'title' => the_title_attribute(array('echo' => FALSE)),
      'link' => apply_filters('the_permalink', get_permalink()),
      'date' => apply_filters('the_time', get_the_time('Y-m-d'), 'Y-m-d'),
    );
    $count ++;
    if ($count >= 2) {
      break;
    }
  }
  $result['blog'] = $blog;
}

$template = dirname(__FILE__) . '/template/footer.html';
$template = file_get_contents($template);
$template = str_replace('"../', '"{{theme_url}}wp-content/themes/line/', $template);
$html = $tpl->render($template, $result);
$htmls = explode('<!-- wp & woo footer -->', $html);

echo $htmls[0];
wp_footer();
woo_foot();
echo $htmls[1];