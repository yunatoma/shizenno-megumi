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
