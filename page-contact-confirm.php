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
            <?php echo do_shortcode('[contact-form-7 id="d2b5c73" title="お問い合わせ確認"]'); ?>
          </div>
        </section>
      </div>
    </main>
    
<?php get_footer(); ?>