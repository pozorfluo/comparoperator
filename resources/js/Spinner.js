(function () {
  "use strict";
  const images = [...document.querySelectorAll("img")];

  function removeSpinner(event) {
    event.currentTarget.classList.remove("loading");
  }

  for (let i = 0, length = images.length; i < length; i++) {
    if (!images[i].complete) {
      images[i].classList.add("loading");
      images[i].addEventListener(
        "load",
        function (event) {
          removeSpinner(event);
        },
        false
      );
    }
  }
})();
