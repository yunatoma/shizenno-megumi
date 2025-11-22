<?php get_header(); ?>

    <main>
      <div class="contact__container">
        <section id="contact">
          <div class="bread_crumbs">
            <?php
            if (function_exists('bcn_display')) {
              bcn_display();
            }
            ?>
          </div>
          <h1 class="title contact__title">お問い合わせ</h1>

          <div class="contact__form-wrapper">
            <h2 class="contact-thanks__thanks">
              お問い合わせ<br class="sp-only" />ありがとうございました。
            </h2>
            <p class="contact-thanks__caption">
              担当者より<br
                class="sp-only"
              />5営業日以内に返信いたします。<br />
              お急ぎの場合は、<br
                class="sp-only"
              />お電話にてお問い合わせください。
            </p>

            <p class="contact-thanks__phone">
              問い合わせ電話<span class="pc-only">：</span
              ><br class="sp-only" /><span class="contact-thanks__phone-number"
                >123-4567-8910</span
              >
            </p>
            <p class="contact-thanks__opening-hours">
              【受付時間】<br class="sp-only" />
              10:00~18:00 (土日祝を除く)
            </p>
            <div class="contact-thanks__submit">
              <a href="<?php echo home_url('/'); ?>" class="btn-green contact-thanks__submit-button">
                <span class="uppercase">Top</span>に戻る
              </a>
            </div>
          </div>
        </section>
      </div>
    </main>

<?php get_footer(); ?>