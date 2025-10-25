// スライダーの設定
const slickSettings = {
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  arrows: false,
  dots: false,
  responsive: [
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 560,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
};

// スライダーの初期化
const initSlider = ($slider) => {
  if (!$slider.length) return;

  if (typeof $slider.slick !== "function") return;

  if ($slider.hasClass("slick-initialized")) {
    $slider.slick("setPosition");
    $slider.slick("slickPlay");
  } else {
    $slider.slick(slickSettings);
  }
};

// 活動紹介セクションのタブを初期化
const initIntroTabs = () => {
  const $buttons = $(".intro__btn");
  const $textBlocks = $("#intro .intro__content .content");
  const $carousels = $("#intro .intro__img-list");

  if (!$buttons.length) {
    $(".autoplay").each(function () {
      initSlider($(this));
    });
    return;
  }

  // タブの切り替え
  const showTab = (target) => {
    if (!target) return;

    $buttons.each(function () {
      const $btn = $(this);
      const isCurrent = $btn.data("tab") === target;
      $btn.toggleClass("is-active", isCurrent);
      $btn.attr("aria-selected", isCurrent);
    });

    $textBlocks.each(function () {
      const $block = $(this);
      const isTarget = $block.data("tab") === target;
      $block.toggleClass("show", isTarget);
      $block.prop("hidden", !isTarget);
    });

    $carousels.each(function () {
      const $slider = $(this);
      const isTarget = $slider.data("tab") === target;
      $slider.toggleClass("show", isTarget);
      $slider.prop("hidden", !isTarget);

      if (isTarget) {
        $slider.css("display", "");
        initSlider($slider);
      } else {
        if ($slider.hasClass("slick-initialized")) {
          $slider.slick("slickPause");
        }
        $slider.css("display", "none");
      }
    });
  };

  const initialTarget =
    $buttons.filter(".is-active").data("tab") || $buttons.first().data("tab");

  showTab(initialTarget);

  $buttons.on("click", function () {
    const target = $(this).data("tab");
    if (target) {
      showTab(target);
    }
  });
};

// FAQアコーディオンを初期化
const initFaqAccordion = () => {
  const $faqDetails = $(".faq__accordion details");

  if (!$faqDetails.length) return;

  $faqDetails.on("toggle", function () {
    if (this.open) {
      $faqDetails.not(this).prop("open", false);
    }
  });
};

$(function () {
  initIntroTabs();
  initFaqAccordion();
});
