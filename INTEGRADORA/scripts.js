document.addEventListener("DOMContentLoaded", () => {
  const prevButton = document.querySelector('.prev');
  const nextButton = document.querySelector('.next');
  const carousel = document.querySelector('.carousel');
  const items = document.querySelectorAll('.carousel-item');
  let index = 0;

  const updateCarousel = () => {
      carousel.style.transform = `translateX(-${index * 100}%)`;
      items.forEach((item, idx) => {
          if (idx === index) {
              item.classList.add('active');
          } else {
              item.classList.remove('active');
          }
      });
  };

  prevButton.addEventListener('click', () => {
      index = (index > 0) ? index - 1 : items.length - 1;
      updateCarousel();
  });

  nextButton.addEventListener('click', () => {
      index = (index < items.length - 1) ? index + 1 : 0;
      updateCarousel();
  });

  updateCarousel();
});


