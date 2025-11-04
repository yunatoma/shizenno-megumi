
<?php get_header(); ?>

    <main>
      <div class="news-list__container">
        <section id="news-list">
          <div class="bread_crumbs">
            <span>ホーム</span> > <span>お知らせ一覧</span>
          </div>
          <h1 class="title">お知らせ一覧</h1>
          <ul class="news-list__category-list">
            <li>
              <button
                class="news-list__category-item"
                class="news-list__category-item--active"
              >
                すべて
              </button>
            </li>
            <li>
              <button class="news-list__category-item">カテゴリー1</button>
            </li>
            <li>
              <button class="news-list__category-item">カテゴリー2</button>
            </li>
            <li>
              <button class="news-list__category-item">カテゴリー3</button>
            </li>
          </ul>
          <div class="news-list__wrapper">
            <ul class="news-list__list pc-only">
              <li class="news-list__item">
                <img
                  class="news-list__img"
                  src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.svg"
                  alt=""
                />
                <div class="news-list__text">
                  <time class="news-list__time" datetime="">YYYY.MM.DD</time>
                  <div class="news-list__label">カテゴリ</div>
                  <h2 class="news-list__title">
                    タイトルが入ります。タイトルが入ります。タイトルが入ります。
                  </h2>
                  <p class="news-list__body">
                    本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。
                  </p>
                </div>
              </li>

              <li class="news-list__item">
                <img
                  class="news-list__img"
                  src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.svg"
                  alt=""
                />
                <div class="news-list__text">
                  <time class="news-list__time" datetime="">YYYY.MM.DD</time>
                  <div class="news-list__label">カテゴリ</div>
                  <h2 class="news-list__title">
                    タイトルが入ります。タイトルが入ります。タイトルが入ります。
                  </h2>
                  <p class="news-list__body">
                    本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。本文の抜粋が入ります。
                  </p>
                </div>
              </li>
            </ul>

            <ul class="sp-only">
              <li class="news-list__item--sp">
                <div class="news-list__label news-list__label--sp">
                  カテゴリ
                </div>
                <div class="news-list__text--sp">
                  <time class="news-list__time--sp" datetime=""
                    >YYYY.MM.DD</time
                  >
                  <h2 class="news-list__title--sp">
                    タイトルが入ります。タイトルが入ります。タイトルが入ります。
                  </h2>
                </div>
              </li>

              <li class="news-list__item--sp">
                <div class="news-list__label news-list__label--sp">
                  カテゴリ
                </div>
                <div class="news-list__text--sp">
                  <time class="news-list__time--sp" datetime=""
                    >YYYY.MM.DD</time
                  >
                  <h2 class="news-list__title--sp">
                    タイトルが入ります。タイトルが入ります。タイトルが入ります。
                  </h2>
                </div>
              </li>
            </ul>

            <nav class="pagination" aria-label="ページネーション">
              <ul>
                <li><a href="#" aria-label="前のページ">&lt;</a></li>
                <li><a href="#" class="active">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#" aria-label="次のページ">&gt;</a></li>
              </ul>
            </nav>
          </div>
        </section>

        <section id="top-contact">
          <div class="top-contact__wrapper">
            <h2 class="top-contact__title">お問い合わせ</h2>
            <p class="top-contact__caption">
              お仕事のご相談、農園体験、牧場の<br
                class="sp-only"
              />見学、その他ご質問<br />
              お気軽にお問い合わせください。
            </p>
            <a class="btn-green top-contact__btn" href="#">お問い合わせ</a>
            <p class="top-contact__phone">
              問い合わせ電話：<br class="sp-only" /><span>123-4567-8910</span>
            </p>
            <p class="top-contact__opening-hours">
              【受付時間】<br class="sp-only" />10:00~18:00(土日祝を除く)
            </p>
          </div>
        </section>
      </div>
    </main>

<?php get_footer(); ?>