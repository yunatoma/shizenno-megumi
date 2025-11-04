<?php
/**
 * 自然の恵み農園 Theme Functions
 */

// カスタム投稿タイプ「お知らせ」を登録
function create_news_post_type() {
    register_post_type('news',
        array(
            'labels' => array(
                'name' => 'お知らせ',
                'singular_name' => 'お知らせ',
                'add_new' => '新規追加',
                'add_new_item' => '新しいお知らせを追加',
                'edit_item' => 'お知らせを編集',
                'new_item' => '新しいお知らせ',
                'view_item' => 'お知らせを表示',
                'search_items' => 'お知らせを検索',
                'not_found' => 'お知らせが見つかりませんでした',
                'not_found_in_trash' => 'ゴミ箱にお知らせはありません',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'news'),
            'menu_icon' => 'dashicons-megaphone',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'show_in_rest' => true, // Gutenbergエディタを有効化
        )
    );
}
add_action('init', 'create_news_post_type');

// お知らせ投稿画面でサムネイル設定を有効化
add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails', ['news']);
});

// カスタムタクソノミー「カテゴリ」を登録
function create_news_taxonomy() {
    register_taxonomy(
        'news_category',
        'news',
        array(
            'label' => 'カテゴリ',
            'rewrite' => array('slug' => 'news-category'),
            'hierarchical' => true,
            'show_in_rest' => true,
        )
    );
}
add_action('init', 'create_news_taxonomy');

// 開発環境用：自動リロード機能
// 本番環境では必ずこの関数をコメントアウトしてください
function add_livereload_script() {
    ?>
    <script>
        (function() {
            let lastCssModified = null;
            const cssUrl = '<?php echo get_template_directory_uri(); ?>/assets/css/style.css';
            console.log('[LiveReload] Watching CSS:', cssUrl);

            function checkForCssChanges() {
                fetch(cssUrl + '?t=' + Date.now(), {
                    method: 'HEAD'
                })
                .then(response => {
                    const lastModified = response.headers.get('Last-Modified');
                    console.log('[LiveReload] Current Last-Modified:', lastModified);

                    if (lastCssModified === null) {
                        // 初回
                        lastCssModified = lastModified;
                        console.log('[LiveReload] Initial Last-Modified set:', lastCssModified);
                    } else if (lastModified !== lastCssModified) {
                        // CSSが更新された！ページをリロード
                        console.log('[LiveReload] CSS updated! Reloading page...');
                        console.log('[LiveReload] Old:', lastCssModified);
                        console.log('[LiveReload] New:', lastModified);
                        window.location.reload();
                    }
                })
                .catch(err => {
                    console.error('[LiveReload] Error:', err);
                });
            }

            // 1秒ごとにチェック（SASS→CSSコンパイル後すぐに反映）
            setInterval(checkForCssChanges, 1000);
            checkForCssChanges(); // 初回実行
        })();
    </script>
    <?php
}
add_action('wp_footer', 'add_livereload_script');
