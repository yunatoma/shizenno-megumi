<?php
/**
 * メタ情報管理機能
 * トップページ、お知らせ一覧、お問い合わせページのメタ情報を管理画面で設定可能にする
 */

// 管理画面にメタ情報設定ページを追加
function add_meta_settings_page() {
    add_menu_page(
        'メタ情報設定',           // ページタイトル
        'メタ情報設定',           // メニュータイトル
        'manage_options',         // 権限
        'meta-settings',          // スラッグ
        'render_meta_settings_page', // コールバック関数
        'dashicons-admin-settings', // アイコン
        80                        // メニュー位置
    );
}
add_action('admin_menu', 'add_meta_settings_page');

// メディアアップローダーのスクリプトとスタイルを読み込む
function enqueue_meta_settings_scripts($hook) {
    if ($hook !== 'toplevel_page_meta-settings') {
        return;
    }
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'enqueue_meta_settings_scripts');

// 設定ページのHTML出力
function render_meta_settings_page() {
    // 設定を保存
    if (isset($_POST['meta_settings_nonce']) && wp_verify_nonce($_POST['meta_settings_nonce'], 'save_meta_settings')) {
        if (current_user_can('manage_options')) {
            // トップページ
            update_option('meta_home_title', sanitize_text_field($_POST['meta_home_title']));
            update_option('meta_home_description', sanitize_textarea_field($_POST['meta_home_description']));
            update_option('meta_home_ogp_title', sanitize_text_field($_POST['meta_home_ogp_title']));
            update_option('meta_home_ogp_description', sanitize_textarea_field($_POST['meta_home_ogp_description']));

            // OGP画像のアップロード処理
            if (!empty($_POST['meta_home_ogp_image'])) {
                update_option('meta_home_ogp_image', esc_url_raw($_POST['meta_home_ogp_image']));
            }

            // お知らせ一覧
            update_option('meta_news_title', sanitize_text_field($_POST['meta_news_title']));
            update_option('meta_news_description', sanitize_textarea_field($_POST['meta_news_description']));
            update_option('meta_news_ogp_title', sanitize_text_field($_POST['meta_news_ogp_title']));
            update_option('meta_news_ogp_description', sanitize_textarea_field($_POST['meta_news_ogp_description']));

            if (!empty($_POST['meta_news_ogp_image'])) {
                update_option('meta_news_ogp_image', esc_url_raw($_POST['meta_news_ogp_image']));
            }

            // お問い合わせ
            update_option('meta_contact_title', sanitize_text_field($_POST['meta_contact_title']));
            update_option('meta_contact_description', sanitize_textarea_field($_POST['meta_contact_description']));
            update_option('meta_contact_ogp_title', sanitize_text_field($_POST['meta_contact_ogp_title']));
            update_option('meta_contact_ogp_description', sanitize_textarea_field($_POST['meta_contact_ogp_description']));

            if (!empty($_POST['meta_contact_ogp_image'])) {
                update_option('meta_contact_ogp_image', esc_url_raw($_POST['meta_contact_ogp_image']));
            }

            echo '<div class="notice notice-success"><p>設定を保存しました。</p></div>';
        }
    }

    // 現在の設定値を取得
    $home_title = get_option('meta_home_title', '自然の恵み農園 | 自然の恵みを感じ、豊かな未来をつくる');
    $home_description = get_option('meta_home_description', '自然の恵み農園は、農園運営・牧場運営・オンライン販売を通じ、自然の恵みを感じて、豊かな未来を想像して頂ける取り組みを行なっています。');
    $home_ogp_title = get_option('meta_home_ogp_title', '自然の恵み農園 | 自然の恵みを感じ、豊かな未来をつくる');
    $home_ogp_description = get_option('meta_home_ogp_description', '自然の恵み農園は、農園運営・牧場運営・オンライン販売を通じ、自然の恵みを感じて、豊かな未来を想像して頂ける取り組みを行なっています。');
    $home_ogp_image = get_option('meta_home_ogp_image', '');

    $news_title = get_option('meta_news_title', 'お知らせ一覧 | 自然の恵み農園');
    $news_description = get_option('meta_news_description', '季節の農作物のお知らせ、見学ツアーのご案内、オンライン販売セールのお知らせなど、自然の恵み農園の最新情報をお届けします。');
    $news_ogp_title = get_option('meta_news_ogp_title', 'お知らせ一覧 | 自然の恵み農園');
    $news_ogp_description = get_option('meta_news_ogp_description', '季節の農作物のお知らせ、見学ツアーのご案内、オンライン販売セールのお知らせなど、自然の恵み農園の最新情報をお届けします。');
    $news_ogp_image = get_option('meta_news_ogp_image', '');

    $contact_title = get_option('meta_contact_title', 'お問い合わせ | 自然の恵み農園');
    $contact_description = get_option('meta_contact_description', '自然の恵み農園への、お仕事のご相談、農園体験、牧場の見学、その他ご質問など、お気軽にお問い合わせください。');
    $contact_ogp_title = get_option('meta_contact_ogp_title', 'お問い合わせ | 自然の恵み農園');
    $contact_ogp_description = get_option('meta_contact_ogp_description', '自然の恵み農園への、お仕事のご相談、農園体験、牧場の見学、その他ご質問など、お気軽にお問い合わせください。');
    $contact_ogp_image = get_option('meta_contact_ogp_image', '');
    ?>

    <div class="wrap">
        <h1>メタ情報設定</h1>
        <p>各ページのタイトル、ディスクリプション、OGP設定を管理できます。</p>

        <form method="post" action="">
            <?php wp_nonce_field('save_meta_settings', 'meta_settings_nonce'); ?>

            <style>
                .meta-settings-section {
                    background: #fff;
                    border: 1px solid #ccd0d4;
                    border-radius: 4px;
                    padding: 20px;
                    margin-bottom: 30px;
                }
                .meta-settings-section h2 {
                    margin-top: 0;
                    padding-bottom: 10px;
                    border-bottom: 2px solid #93c572;
                }
                .meta-field {
                    margin-bottom: 20px;
                }
                .meta-field label {
                    display: block;
                    font-weight: bold;
                    margin-bottom: 5px;
                }
                .meta-field input[type="text"],
                .meta-field textarea {
                    width: 100%;
                    max-width: 600px;
                    padding: 8px;
                    font-size: 14px;
                }
                .meta-field textarea {
                    height: 80px;
                }
                .meta-field small {
                    display: block;
                    color: #666;
                    margin-top: 5px;
                }
                .image-upload-field {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                .image-preview {
                    max-width: 200px;
                    max-height: 100px;
                    border: 1px solid #ddd;
                    padding: 5px;
                    display: none;
                }
                .image-preview.active {
                    display: block;
                }
            </style>

            <!-- トップページ -->
            <div class="meta-settings-section">
                <h2>トップページ</h2>

                <div class="meta-field">
                    <label for="meta_home_title">ページタイトル (title)</label>
                    <input type="text" id="meta_home_title" name="meta_home_title" value="<?php echo esc_attr($home_title); ?>">
                    <small>ブラウザのタブに表示されるタイトルです。</small>
                </div>

                <div class="meta-field">
                    <label for="meta_home_description">ディスクリプション (description)</label>
                    <textarea id="meta_home_description" name="meta_home_description"><?php echo esc_textarea($home_description); ?></textarea>
                    <small>検索結果に表示される説明文です。</small>
                </div>

                <div class="meta-field">
                    <label for="meta_home_ogp_title">OGPタイトル (og:title)</label>
                    <input type="text" id="meta_home_ogp_title" name="meta_home_ogp_title" value="<?php echo esc_attr($home_ogp_title); ?>">
                    <small>SNSでシェアされた時のタイトルです。</small>
                </div>

                <div class="meta-field">
                    <label for="meta_home_ogp_description">OGPディスクリプション (og:description)</label>
                    <textarea id="meta_home_ogp_description" name="meta_home_ogp_description"><?php echo esc_textarea($home_ogp_description); ?></textarea>
                    <small>SNSでシェアされた時の説明文です。</small>
                </div>

                <div class="meta-field">
                    <label for="meta_home_ogp_image">OGP画像 (og:image)</label>
                    <div class="image-upload-field">
                        <input type="text" id="meta_home_ogp_image" name="meta_home_ogp_image" value="<?php echo esc_url($home_ogp_image); ?>" placeholder="画像のURLを入力">
                        <button type="button" class="button upload-image-button" data-target="meta_home_ogp_image">画像を選択</button>
                    </div>
                    <img src="<?php echo esc_url($home_ogp_image); ?>" class="image-preview <?php echo $home_ogp_image ? 'active' : ''; ?>" id="preview_meta_home_ogp_image">
                    <small>推奨サイズ: 1200px × 630px</small>
                </div>
            </div>

            <!-- お知らせ一覧 -->
            <div class="meta-settings-section">
                <h2>お知らせ一覧</h2>

                <div class="meta-field">
                    <label for="meta_news_title">ページタイトル (title)</label>
                    <input type="text" id="meta_news_title" name="meta_news_title" value="<?php echo esc_attr($news_title); ?>">
                </div>

                <div class="meta-field">
                    <label for="meta_news_description">ディスクリプション (description)</label>
                    <textarea id="meta_news_description" name="meta_news_description"><?php echo esc_textarea($news_description); ?></textarea>
                </div>

                <div class="meta-field">
                    <label for="meta_news_ogp_title">OGPタイトル (og:title)</label>
                    <input type="text" id="meta_news_ogp_title" name="meta_news_ogp_title" value="<?php echo esc_attr($news_ogp_title); ?>">
                </div>

                <div class="meta-field">
                    <label for="meta_news_ogp_description">OGPディスクリプション (og:description)</label>
                    <textarea id="meta_news_ogp_description" name="meta_news_ogp_description"><?php echo esc_textarea($news_ogp_description); ?></textarea>
                </div>

                <div class="meta-field">
                    <label for="meta_news_ogp_image">OGP画像 (og:image)</label>
                    <div class="image-upload-field">
                        <input type="text" id="meta_news_ogp_image" name="meta_news_ogp_image" value="<?php echo esc_url($news_ogp_image); ?>" placeholder="画像のURLを入力">
                        <button type="button" class="button upload-image-button" data-target="meta_news_ogp_image">画像を選択</button>
                    </div>
                    <img src="<?php echo esc_url($news_ogp_image); ?>" class="image-preview <?php echo $news_ogp_image ? 'active' : ''; ?>" id="preview_meta_news_ogp_image">
                    <small>推奨サイズ: 1200px × 630px</small>
                </div>
            </div>

            <!-- お問い合わせ -->
            <div class="meta-settings-section">
                <h2>お問い合わせ</h2>

                <div class="meta-field">
                    <label for="meta_contact_title">ページタイトル (title)</label>
                    <input type="text" id="meta_contact_title" name="meta_contact_title" value="<?php echo esc_attr($contact_title); ?>">
                </div>

                <div class="meta-field">
                    <label for="meta_contact_description">ディスクリプション (description)</label>
                    <textarea id="meta_contact_description" name="meta_contact_description"><?php echo esc_textarea($contact_description); ?></textarea>
                </div>

                <div class="meta-field">
                    <label for="meta_contact_ogp_title">OGPタイトル (og:title)</label>
                    <input type="text" id="meta_contact_ogp_title" name="meta_contact_ogp_title" value="<?php echo esc_attr($contact_ogp_title); ?>">
                </div>

                <div class="meta-field">
                    <label for="meta_contact_ogp_description">OGPディスクリプション (og:description)</label>
                    <textarea id="meta_contact_ogp_description" name="meta_contact_ogp_description"><?php echo esc_textarea($contact_ogp_description); ?></textarea>
                </div>

                <div class="meta-field">
                    <label for="meta_contact_ogp_image">OGP画像 (og:image)</label>
                    <div class="image-upload-field">
                        <input type="text" id="meta_contact_ogp_image" name="meta_contact_ogp_image" value="<?php echo esc_url($contact_ogp_image); ?>" placeholder="画像のURLを入力">
                        <button type="button" class="button upload-image-button" data-target="meta_contact_ogp_image">画像を選択</button>
                    </div>
                    <img src="<?php echo esc_url($contact_ogp_image); ?>" class="image-preview <?php echo $contact_ogp_image ? 'active' : ''; ?>" id="preview_meta_contact_ogp_image">
                    <small>推奨サイズ: 1200px × 630px</small>
                </div>
            </div>

            <p class="submit">
                <input type="submit" class="button button-primary" value="設定を保存">
            </p>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // メディアアップローダー
        $('.upload-image-button').click(function(e) {
            e.preventDefault();

            var button = $(this);
            var targetId = button.data('target');
            var inputField = $('#' + targetId);
            var previewImage = $('#preview_' + targetId);

            var mediaUploader = wp.media({
                title: '画像を選択',
                button: {
                    text: 'この画像を使用'
                },
                multiple: false
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
                previewImage.attr('src', attachment.url).addClass('active');
            });

            mediaUploader.open();
        });

        // 画像URLが変更されたらプレビューを更新
        $('input[name$="_ogp_image"]').on('input', function() {
            var url = $(this).val();
            var previewId = 'preview_' + $(this).attr('id');
            var preview = $('#' + previewId);

            if (url) {
                preview.attr('src', url).addClass('active');
            } else {
                preview.removeClass('active');
            }
        });
    });
    </script>
    <?php
}

// メタ情報を取得する関数
function get_custom_meta($page_type, $meta_type) {
    $option_name = 'meta_' . $page_type . '_' . $meta_type;
    return get_option($option_name, '');
}
