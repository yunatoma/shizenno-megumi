<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/apple-touch-icon.svg" />
    <link
      rel="stylesheet"
      type="text/css"
      href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400..700;1,400..700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" />

    <?php
    // ページごとのメタ情報を設定
    $page_title = '';
    $page_description = '';
    $ogp_title = '';
    $ogp_description = '';
    $ogp_image = '';
    $current_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    if (is_front_page()) {
        // トップページ
        $page_title = get_custom_meta('home', 'title') ?: '自然の恵み農園 | 自然の恵みを感じ、豊かな未来をつくる';
        $page_description = get_custom_meta('home', 'description') ?: '自然の恵み農園は、農園運営・牧場運営・オンライン販売を通じ、自然の恵みを感じて、豊かな未来を想像して頂ける取り組みを行なっています。';
        $ogp_title = get_custom_meta('home', 'ogp_title') ?: $page_title;
        $ogp_description = get_custom_meta('home', 'ogp_description') ?: $page_description;
        $ogp_image = get_custom_meta('home', 'ogp_image') ?: get_template_directory_uri() . '/assets/img/ogp-default.jpg';
    } elseif (is_post_type_archive('news') || is_tax('news_category')) {
        // お知らせ一覧またはカテゴリーページ
        if (is_tax('news_category')) {
            $term = get_queried_object();
            $page_title = esc_html($term->name) . ' - お知らせ一覧 | 自然の恵み農園';
            $page_description = esc_html($term->name) . 'に関するお知らせ一覧です。';
            $ogp_title = $page_title;
            $ogp_description = $page_description;
        } else {
            $page_title = get_custom_meta('news', 'title') ?: 'お知らせ一覧 | 自然の恵み農園';
            $page_description = get_custom_meta('news', 'description') ?: '季節の農作物のお知らせ、見学ツアーのご案内、オンライン販売セールのお知らせなど、自然の恵み農園の最新情報をお届けします。';
            $ogp_title = get_custom_meta('news', 'ogp_title') ?: $page_title;
            $ogp_description = get_custom_meta('news', 'ogp_description') ?: $page_description;
        }
        $ogp_image = get_custom_meta('news', 'ogp_image') ?: get_template_directory_uri() . '/assets/img/ogp-news.jpg';
    } elseif (is_page('contact')) {
        // お問い合わせページ
        $page_title = get_custom_meta('contact', 'title') ?: 'お問い合わせ | 自然の恵み農園';
        $page_description = get_custom_meta('contact', 'description') ?: '自然の恵み農園への、お仕事のご相談、農園体験、牧場の見学、その他ご質問など、お気軽にお問い合わせください。';
        $ogp_title = get_custom_meta('contact', 'ogp_title') ?: $page_title;
        $ogp_description = get_custom_meta('contact', 'ogp_description') ?: $page_description;
        $ogp_image = get_custom_meta('contact', 'ogp_image') ?: get_template_directory_uri() . '/assets/img/ogp-contact.jpg';
    } elseif (is_singular('news')) {
        // お知らせ個別ページ
        $page_title = get_the_title() . ' - 自然の恵み農園';
        $page_description = get_the_excerpt() ?: '自然の恵み農園のお知らせです。';
        $ogp_title = get_the_title();
        $ogp_description = $page_description;
        $ogp_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : get_template_directory_uri() . '/assets/img/ogp-news.jpg';
    } else {
        // その他のページ（デフォルト）
        $page_title = wp_get_document_title();
        $page_description = get_bloginfo('description');
        $ogp_title = $page_title;
        $ogp_description = $page_description;
        $ogp_image = get_template_directory_uri() . '/assets/img/ogp-default.jpg';
    }
    ?>

    <title><?php echo esc_html($page_title); ?></title>
    <meta name="description" content="<?php echo esc_attr($page_description); ?>" />

    <!-- OGP設定 -->
    <meta property="og:title" content="<?php echo esc_attr($ogp_title); ?>" />
    <meta property="og:description" content="<?php echo esc_attr($ogp_description); ?>" />
    <meta property="og:type" content="<?php echo is_front_page() ? 'website' : 'article'; ?>" />
    <meta property="og:url" content="<?php echo esc_url($current_url); ?>" />
    <meta property="og:image" content="<?php echo esc_url($ogp_image); ?>" />
    <meta property="og:site_name" content="自然の恵み農園" />
    <meta property="og:locale" content="ja_JP" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr($ogp_title); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr($ogp_description); ?>" />
    <meta name="twitter:image" content="<?php echo esc_url($ogp_image); ?>" />

    <?php wp_head(); ?>
  </head>
  <body>
    <header class="header">
      <div class="header__inner">
        <a href="/">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="自然の恵み農園のロゴ" />
        </a>

        <div
          class="menu_btn"
          type="button"
          aria-label="メニュー"
          aria-expanded="false"
        >
          <span></span>
          <span></span>
        </div>

        <nav class="header__menu">
          <ul>
            <li><a href="<?php echo home_url('/#about'); ?>" class="header__link">私たちについて</a></li>
            <li><a href="<?php echo home_url('/#intro'); ?>" class="header__link">活動紹介</a></li>
            <li><a href="<?php echo home_url('/#faq'); ?>" class="header__link">よくあるご質問</a></li>
            <li><a href="<?php echo home_url('/#top-news'); ?>" class="header__link">お知らせ</a></li>
            <li><a href="<?php echo home_url('/#access'); ?>" class="header__link">アクセス</a></li>
            <li>
              <a href="<?php echo home_url('/contact/'); ?>" class="header__link--contact">
                お問い合わせ
              </a>
            </li>
          </ul>
        </nav>
      </div>

      <nav id="global-menu-sp" class="header__menu--sp" aria-hidden="true">
        <ul class="header__menu-list--sp">
          <li class="header__item--sp">
            <a class="header__link--sp" href="<?php echo home_url('/'); ?>">
              <div>
                <span class="header__link--sp-main">トップ</span>
                <span class="header__link--sp-sub">top</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="<?php echo home_url('/#about'); ?>">
              <div>
                <span class="header__link--sp-main">私たちについて</span>
                <span class="header__link--sp-sub">about</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="<?php echo home_url('/#faq'); ?>">
              <div>
                <span class="header__link--sp-main">よくあるご質問</span>
                <span class="header__link--sp-sub">faq</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="<?php echo home_url('/#intro'); ?>">
              <div>
                <span class="header__link--sp-main">活動紹介</span>
                <span class="header__link--sp-sub">works</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="<?php echo home_url('/#top-news'); ?>">
              <div>
                <span class="header__link--sp-main">お知らせ</span>
                <span class="header__link--sp-sub">news</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="<?php echo home_url('/#access'); ?>">
              <div>
                <span class="header__link--sp-main">アクセス</span>
                <span class="header__link--sp-sub">access</span>
              </div>
            </a>
          </li>
        </ul>

        <div class="header__contact-info--sp">
          <p class="header__contact-label--sp">問い合わせ電話</p>
          <p class="header__contact-number--sp">123-4567-8910</p>
          <p class="header__contact-hours--sp">
            <span>【受付時間】<br /></span>
            10:00 ~ 18:00（土日祝を除く）
          </p>
          <a href="<?php echo home_url('/contact/'); ?>" class="btn-orange header__link-contact--sp">
            お問い合わせ
          </a>
        </div>
      </nav>
    </header>
