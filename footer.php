    <footer id="footer">
      <div class="footer__wrapper">
        <div class="footer__info">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="" />
          <address>
            <p class="footer__address">
              〒123-4567<br />
              千葉県〇〇市××町1丁目23-45
            </p>
            <p class="footer__tel">TEL:123-4567-8910</p>
            <p class="footer__fax">FAX:12-345-6789</p>
          </address>
        </div>
        <div class="footer__right">
          <ul class="footer__links">
            <li class="footer__item"><a href="#">ホーム</a></li>
            <li class="footer__item"><a href="#about">私たちについて</a></li>
            <li class="footer__item"><a href="#intro">活動紹介</a></li>
            <li class="footer__item"><a href="#faq">よくあるご質問</a></li>
            <li class="footer__item"><a href="#access">アクセス</a></li>
            <li class="footer__item"><a href="#top-news">お知らせ</a></li>
          </ul>
          <ul class="footer__sns-list">
            <li class="footer__sns-item">
              <a href="#" aria-label="X"
                ><i class="fa-brands fa-x-twitter" aria-hidden="true"></i
              ></a>
            </li>
            <li class="footer__sns-item">
              <a href="#" aria-label="Instagram"
                ><i class="fa-brands fa-instagram" aria-hidden="true"></i
              ></a>
            </li>
            <li class="footer__sns-item">
              <a href="#" aria-label="YouTube"
                ><i class="fa-brands fa-youtube" aria-hidden="true"></i
              ></a>
            </li>
          </ul>
        </div>
      </div>
      <p class="footer__copy">©︎ shizen-no-megumi-nouen Inc .2023</p>
    </footer>

    <script
      src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
      crossorigin="anonymous"
    ></script>
    <script
      type="text/javascript"
      src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>
    <?php wp_footer(); ?>
  </body>
</html>
