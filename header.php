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
    <title>自然の恵み農園 | 自然の恵みを感じ、豊かな未来をつくる</title>
    <meta
      name="description"
      content="自然の恵み農園は、農園運営・牧場運営・オンライン販売を通じ、自然の恵みを感じて、豊かな未来を想像して頂ける取り組みを行なっています。"
    />
  </head>
  <body>
    <header class="header">
      <div class="header__inner">
        <a href="#">
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
            <li><a href="#about" class="header__link">私たちについて</a></li>
            <li><a href="#intro" class="header__link">活動紹介</a></li>
            <li><a href="#faq" class="header__link">よくあるご質問</a></li>
            <li><a href="#top-news" class="header__link">お知らせ</a></li>
            <li><a href="#access" class="header__link">アクセス</a></li>
            <li>
              <a href="#top-contact" class="header__link--contact">
                お問い合わせ
              </a>
            </li>
          </ul>
        </nav>
      </div>

      <nav id="global-menu-sp" class="header__menu--sp" aria-hidden="true">
        <ul class="header__menu-list--sp">
          <li class="header__item--sp">
            <a class="header__link--sp" href="#">
              <div>
                <span class="header__link--sp-main">トップ</span>
                <span class="header__link--sp-sub">top</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="#about">
              <div>
                <span class="header__link--sp-main">私たちについて</span>
                <span class="header__link--sp-sub">about</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="#faq">
              <div>
                <span class="header__link--sp-main">よくあるご質問</span>
                <span class="header__link--sp-sub">faq</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="#intro">
              <div>
                <span class="header__link--sp-main">活動紹介</span>
                <span class="header__link--sp-sub">works</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="#top-news">
              <div>
                <span class="header__link--sp-main">お知らせ</span>
                <span class="header__link--sp-sub">news</span>
              </div>
            </a>
          </li>
          <li class="header__item--sp">
            <a class="header__link--sp" href="#access">
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
          <a href="#top-contact" class="btn-orange header__link-contact--sp">
            お問い合わせ
          </a>
        </div>
      </nav>
    </header>
