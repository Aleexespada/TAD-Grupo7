var productImgs = document.querySelectorAll('.product-img');
var modalImg = document.querySelector('#product-img-modal-img');

for (var i = 0; i < productImgs.length; i++) {
    productImgs[i].addEventListener('click', function() {
        var src = this.querySelector('img').getAttribute('src');
        console.log(src);
        console.log(modalImg);
        modalImg.setAttribute('src', src);
    });
}