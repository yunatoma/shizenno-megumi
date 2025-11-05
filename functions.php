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


/**
 * お知らせ投稿を複製する機能
 */
function duplicate_news_post() {
    // nonceチェック
    if (!isset($_GET['duplicate_nonce']) || !wp_verify_nonce($_GET['duplicate_nonce'], 'duplicate_news_' . $_GET['post'])) {
        wp_die('セキュリティチェックに失敗しました。');
    }

    // 権限チェック
    if (!current_user_can('edit_posts')) {
        wp_die('この操作を実行する権限がありません。');
    }

    // 投稿IDを取得
    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
    $post = get_post($post_id);

    if (!$post) {
        wp_die('投稿が見つかりませんでした。');
    }

    // 新しい投稿データを作成
    $new_post = array(
        'post_title'   => $post->post_title . ' (コピー)',
        'post_content' => $post->post_content,
        'post_excerpt' => $post->post_excerpt,
        'post_status'  => 'draft', // 下書きとして作成
        'post_type'    => $post->post_type,
        'post_author'  => get_current_user_id(),
    );

    // 新しい投稿を作成
    $new_post_id = wp_insert_post($new_post);

    if (is_wp_error($new_post_id)) {
        wp_die('投稿の複製に失敗しました。');
    }

    // タクソノミー（カテゴリなど）をコピー
    $taxonomies = get_object_taxonomies($post->post_type);
    foreach ($taxonomies as $taxonomy) {
        $terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
        wp_set_object_terms($new_post_id, $terms, $taxonomy);
    }

    // アイキャッチ画像をコピー
    $thumbnail_id = get_post_thumbnail_id($post_id);
    if ($thumbnail_id) {
        set_post_thumbnail($new_post_id, $thumbnail_id);
    }

    // カスタムフィールドをコピー
    $post_meta = get_post_meta($post_id);
    foreach ($post_meta as $key => $values) {
        // WordPressの内部メタデータはスキップ
        if (substr($key, 0, 1) === '_') {
            continue;
        }
        foreach ($values as $value) {
            add_post_meta($new_post_id, $key, maybe_unserialize($value));
        }
    }

    // 編集画面にリダイレクト
    wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
    exit;
}
add_action('admin_action_duplicate_news_post', 'duplicate_news_post');

// 管理画面の投稿一覧に「複製」リンクを追加
function add_duplicate_link($actions, $post) {
    if ($post->post_type === 'news' && current_user_can('edit_posts')) {
        $nonce = wp_create_nonce('duplicate_news_' . $post->ID);
        $actions['duplicate'] = '<a href="' . admin_url('admin.php?action=duplicate_news_post&post=' . $post->ID . '&duplicate_nonce=' . $nonce) . '">複製</a>';
    }
    return $actions;
}
add_filter('post_row_actions', 'add_duplicate_link', 10, 2);

// 一括操作に「複製」オプションを追加
function add_bulk_duplicate_action($bulk_actions) {
    $bulk_actions['duplicate'] = '複製';
    return $bulk_actions;
}
add_filter('bulk_actions-edit-news', 'add_bulk_duplicate_action');

// 一括操作の処理
function handle_bulk_duplicate($redirect_to, $action, $post_ids) {
    if ($action !== 'duplicate') {
        return $redirect_to;
    }

    $duplicated = 0;
    foreach ($post_ids as $post_id) {
        $post = get_post($post_id);
        if (!$post || $post->post_type !== 'news') {
            continue;
        }

        // 新しい投稿データを作成
        $new_post = array(
            'post_title'   => $post->post_title . ' (コピー)',
            'post_content' => $post->post_content,
            'post_excerpt' => $post->post_excerpt,
            'post_status'  => 'draft',
            'post_type'    => $post->post_type,
            'post_author'  => get_current_user_id(),
        );

        $new_post_id = wp_insert_post($new_post);

        if (is_wp_error($new_post_id)) {
            continue;
        }

        // タクソノミーをコピー
        $taxonomies = get_object_taxonomies($post->post_type);
        foreach ($taxonomies as $taxonomy) {
            $terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
            wp_set_object_terms($new_post_id, $terms, $taxonomy);
        }

        // アイキャッチ画像をコピー
        $thumbnail_id = get_post_thumbnail_id($post_id);
        if ($thumbnail_id) {
            set_post_thumbnail($new_post_id, $thumbnail_id);
        }

        // カスタムフィールドをコピー
        $post_meta = get_post_meta($post_id);
        foreach ($post_meta as $key => $values) {
            if (substr($key, 0, 1) === '_') {
                continue;
            }
            foreach ($values as $value) {
                add_post_meta($new_post_id, $key, maybe_unserialize($value));
            }
        }

        $duplicated++;
    }

    $redirect_to = add_query_arg('bulk_duplicated', $duplicated, $redirect_to);
    return $redirect_to;
}
add_filter('handle_bulk_actions-edit-news', 'handle_bulk_duplicate', 10, 3);

// 一括操作完了時のメッセージ表示
function bulk_duplicate_admin_notice() {
    if (!empty($_REQUEST['bulk_duplicated'])) {
        $duplicated = intval($_REQUEST['bulk_duplicated']);
        printf(
            '<div id="message" class="updated notice is-dismissible"><p>%d件の投稿を複製しました。</p></div>',
            $duplicated
        );
    }
}
add_action('admin_notices', 'bulk_duplicate_admin_notice');

// Contact Form 7のカスタマイズ
// CF7のデフォルトCSSを無効化（テーマのCSSを使用するため）
add_filter('wpcf7_load_css', '__return_false');

// CF7のフォームにカスタムクラスを追加
add_filter('wpcf7_form_class_attr', 'custom_wpcf7_form_class');
function custom_wpcf7_form_class($class) {
    $class .= ' contact__form';
    return $class;
}
