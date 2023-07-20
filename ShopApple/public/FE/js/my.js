
    var splide = new Splide('.splide');
    var bar = splide.root.find('.my-carousel-progress-bar');
  
    // Updates the bar width whenever the carousel moves:
    splide.on('mounted move', function() {
      var end = splide.Components.Controller.getEnd() + 1;
      var rate = Math.min((splide.index + 1) / end, 1);
      bar.css('width', (100 * rate) + '%');
    });
  
    splide.mount();

  