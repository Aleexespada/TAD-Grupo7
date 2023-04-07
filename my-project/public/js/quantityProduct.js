// Obtener el campo de entrada y los botones
var quantityInput = document.getElementById('quantity-input');
var quantityMinus = document.getElementById('quantity-minus');
var quantityPlus = document.getElementById('quantity-plus');

// Configurar la cantidad mínima y máxima
var minQuantity = parseInt(quantityInput.getAttribute('min')) || 1;
var maxQuantity = parseInt(quantityInput.getAttribute('max')) || 999;

// Restar un elemento cuando se hace clic en el botón de resta
quantityMinus.addEventListener('click', function () {
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > minQuantity) {
        quantityInput.value = currentQuantity - 1;
    }
});

// Sumar un elemento cuando se hace clic en el botón de suma
quantityPlus.addEventListener('click', function () {
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity < maxQuantity) {
        quantityInput.value = currentQuantity + 1;
    }
});