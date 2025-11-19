
<script src="https://unpkg.com/swiper@9/swiper-bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const gallerySwiper = new Swiper('.gallery-swiper', {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 24,
      autoplay: { delay: 4000 },
      pagination: { el: '.gallery-pagination', clickable: true },
      navigation: { nextEl: '.gallery-next', prevEl: '.gallery-prev' },
    });

    const mapSwiper = new Swiper('.map-swiper', {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 24,
      autoplay: { delay: 5000 },
      pagination: { el: '.map-pagination', clickable: true },
      navigation: { nextEl: '.map-next', prevEl: '.map-prev' },
    });
  });
</script>
@stack('scripts')