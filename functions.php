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

// TODO: 開発環境用：PHPファイルの変更時刻を返すエンドポイント
function livereload_check_php_files() {
    $theme_dir = get_template_directory();
    $php_files = [
        $theme_dir . '/functions.php',
        $theme_dir . '/header.php',
        $theme_dir . '/footer.php',
        $theme_dir . '/front-page.php',
        $theme_dir . '/archive-news.php',
    ];

    $latest_mtime = 0;
    foreach ($php_files as $file) {
        if (file_exists($file)) {
            $mtime = filemtime($file);
            if ($mtime > $latest_mtime) {
                $latest_mtime = $mtime;
            }
        }
    }

    wp_send_json(['mtime' => $latest_mtime]);
}
add_action('wp_ajax_nopriv_livereload_check', 'livereload_check_php_files');
add_action('wp_ajax_livereload_check', 'livereload_check_php_files');

// TODO: 開発環境用：自動リロード機能
// TODO: 本番環境では必ずこの関数をコメントアウトしてください
function add_livereload_script() {
    ?>
    <script>
        (function() {
            let lastCheck = {};
            const files = [
                '<?php echo get_template_directory_uri(); ?>/assets/css/style.css',
                '<?php echo get_template_directory_uri(); ?>/assets/js/script.js',
            ];
            console.log('[LiveReload] Watching files:', files);

            function checkForChanges() {
                // CSS/JSファイルの変更チェック
                files.forEach(fileUrl => {
                    fetch(fileUrl + '?t=' + Date.now(), {
                        method: 'HEAD'
                    })
                    .then(response => {
                        const lastModified = response.headers.get('Last-Modified');
                        const fileName = fileUrl.split('/').pop();

                        if (!lastCheck[fileUrl]) {
                            lastCheck[fileUrl] = lastModified;
                            console.log('[LiveReload] Initial check:', fileName, lastModified);
                        } else if (lastModified !== lastCheck[fileUrl]) {
                            console.log('[LiveReload] File updated:', fileName);
                            console.log('[LiveReload] Reloading page...');
                            window.location.reload();
                        }
                    })
                    .catch(err => {
                        console.error('[LiveReload] Error checking:', fileUrl, err);
                    });
                });

                // PHPファイルの変更チェック（専用エンドポイント使用）
                fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=livereload_check&t=' + Date.now())
                .then(response => response.json())
                .then(data => {
                    if (!lastCheck['php']) {
                        lastCheck['php'] = data.mtime;
                        console.log('[LiveReload] Initial PHP check:', data.mtime);
                    } else if (data.mtime !== lastCheck['php']) {
                        console.log('[LiveReload] PHP file updated! Reloading...');
                        window.location.reload();
                    }
                })
                .catch(err => {
                    console.error('[LiveReload] Error checking PHP:', err);
                });
            }

            // 2秒ごとにチェック（負荷軽減）
            setInterval(checkForChanges, 2000);
            checkForChanges(); // 初回実行
        })();
    </script>
    <?php
}
add_action('wp_footer', 'add_livereload_script');
