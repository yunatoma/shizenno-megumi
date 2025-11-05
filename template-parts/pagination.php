<?php
/**
 * ページネーション テンプレートパーツ
 *
 * ニュース一覧とタクソノミーアーカイブで使用されるページネーション
 */

global $wp_query;

$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
$max_pages = max(1, $wp_query->max_num_pages);

// ページネーションリンクを生成
$pagination_links = paginate_links(array(
  'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
  'format'    => '?paged=%#%',
  'current'   => max(1, $paged),
  'total'     => $max_pages,
  'type'      => 'array',
  'prev_text' => '&lt;',
  'next_text' => '&gt;',
  'mid_size'  => 1,
  'end_size'  => 1,
));

// 1ページしかない場合も表示
if ($max_pages <= 1) {
  $pagination_links = array(
    '<span class="page-numbers" aria-label="前のページ">&lt;</span>',
    '<span aria-current="page" class="page-numbers current">1</span>',
    '<span class="page-numbers" aria-label="次のページ">&gt;</span>'
  );
}
?>

<?php if (!empty($pagination_links)) : ?>
  <nav class="pagination" aria-label="ページネーション">
    <ul>
      <?php foreach ($pagination_links as $link) : ?>
        <li><?php echo $link; ?></li>
      <?php endforeach; ?>
    </ul>
  </nav>
<?php endif; ?>
