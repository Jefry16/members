function getImagesViaAjax() {
  fetch("/ccb/admin/ajax/show-images")
    .then((data) => data.json())
    .then((data) => {
      data.forEach((image) => {
        let element = document.createElement("IMG");
        element.setAttribute("src", "/img/" + image);
        document.querySelector(".images-holder").appendChild(element);
        element.addEventListener("click", function (e) {
          document.getElementById("addThumb").style.display = "none";
          const imgUrl = this.getAttribute("src");
          document
            .querySelectorAll('[name="thumbnail"]')[0]
            .setAttribute("value", imgUrl.substring(5));
          (function () {
            const img = '<img src="' + imgUrl + '">';
            document.getElementById("title-holder").innerHTML = img;
          })();

          const rmvThumbnail = document.createElement("button");
          rmvThumbnail.innerText = "Quitar portada";
          rmvThumbnail.setAttribute("id", "rmvThumbnail");
          rmvThumbnail.setAttribute("type", "button");
          document
            .getElementById("addThumb")
            .insertAdjacentElement("afterend", rmvThumbnail);
          rmvThumbnail.addEventListener("click", function () {
            this.style.display = "none";
            document.getElementById("title-holder").innerHTML = "";
            document.getElementById("addThumb").style.display = "initial";
            document
              .querySelectorAll('[name="thumbnail"]')[0]
              .setAttribute("value", "");
          });
        });
      });
    });
}

document.getElementById("addThumb").addEventListener("click", function () {
  getImagesViaAjax();
  document.querySelector(".ajax-images").style.display = "flex";
});

document.querySelector(".ajax-images").addEventListener("click", function (e) {
  e.stopPropagation();
  this.style.display = "none";
});

window.addEventListener("beforeunload", function (e) {
  // Cancel the event
  e.preventDefault(); // If you prevent default behavior in Mozilla Firefox prompt will always be shown
  // Chrome requires returnValue to be set
  e.returnValue = "cd";
});

if (document.getElementById("rmvThumbnail")) {
  document.getElementById("rmvThumbnail");
}
