
<?php get_header(); ?>

    <main>
      <div class="contact__container">
        <section id="contact">
          <div class="bread_crumbs">
            <span>ホーム</span> > <span>お問い合わせ</span>
          </div>
          <h1 class="title contact__title">お問い合わせ</h1>
          <p class="contact__caption">
            お仕事のご相談、農園体験、牧場の見学、<br
              class="sp-only"
            />その他ご質問など、お気軽にお問い合わせください。
          </p>
          <div class="contact__form-wrapper">
            <!-- WordPressでは通常、この中に Contact Form 7 のショートコードが記述されます。 -->
            <!-- CF7の出力：<div class="wpcf7">...</div> -->
            <form class="contact__form">
              <div class="contact__field-wrapper">
                <label for="contact-type" class="contact__label">
                  お問い合わせ種別
                  <span class="contact__required">必須</span>
                </label>
                <!-- CF7ではこの部分が [select* contact-type] などのショートコードになります -->
                <!-- Select要素の外側にカスタム矢印用のラッパーを配置 -->
                <div class="contact__select-wrapper">
                  <select
                    id="contact-type"
                    name="contact-type"
                    class="contact__select"
                  >
                    <option value="service">
                      サービスに関するお問い合わせ
                    </option>
                    <option value="recruit">採用に関するお問い合わせ</option>
                    <option value="other">その他</option>
                  </select>
                </div>
              </div>

              <div class="contact__field-wrapper">
                <label for="contact-name" class="contact__label">
                  お名前
                  <span class="contact__required">必須</span>
                </label>
                <!-- CF7ではこの部分が [text* your-name] などのショートコードになります -->
                <input
                  type="text"
                  id="contact-name"
                  name="your-name"
                  class="contact__input"
                />
              </div>

              <div class="contact__field-wrapper">
                <label for="contact-email" class="contact__label">
                  メールアドレス
                  <span class="contact__required">必須</span>
                </label>
                <!-- CF7ではこの部分が [email* your-email] などのショートコードになります -->
                <input
                  type="email"
                  id="contact-email"
                  name="your-email"
                  class="contact__input"
                />
              </div>

              <div class="contact__field-wrapper">
                <label for="contact-tel" class="contact__label">
                  電話番号
                </label>
                <!-- CF7ではこの部分が [tel your-tel] などのショートコードになります -->
                <input
                  type="tel"
                  id="contact-tel"
                  name="your-tel"
                  class="contact__input"
                />
              </div>

              <div class="contact__field-wrapper">
                <label for="contact-message" class="contact__label">
                  お問い合わせ内容
                  <span class="contact__required">必須</span>
                </label>
                <!-- CF7ではこの部分が [textarea* your-message] などのショートコードになります -->
                <textarea
                  id="contact-message"
                  name="your-message"
                  rows="8"
                  class="contact__textarea"
                ></textarea>
              </div>

              <div class="contact__submit">
                <!-- CF7ではこの部分が [submit "確認する"] などのショートコードになります -->
                <button type="submit" class="btn-green contact__submit-button">
                  確認する
                </button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </main>

<?php get_footer(); ?>