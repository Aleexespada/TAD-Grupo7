const addButton = document.getElementById("addVariant");
const deleteButton = document.getElementById("removeVariant");
const selectContainer = document.getElementById('sizesInputs');
const stockContainer = document.getElementById("stocksInputs");



addButton.addEventListener('click', () => {
    const select = document.getElementById("size");
    const clonSelect = select.cloneNode(true);
    clonSelect.classList.add("mt-2");
    clonSelect.selectedIndex = -1;

    const input = document.getElementById("stock");
    const clonInput = input.cloneNode(true);
    clonInput.classList.add("mt-2");
    clonInput.value = '';
    
    selectContainer.appendChild(clonSelect);
    stockContainer.appendChild(clonInput);
});

deleteButton.addEventListener('click', () => {
    const selectInputs = selectContainer.querySelectorAll("select");
    const lastSelect = selectInputs[selectInputs.length - 1];
    if (lastSelect && selectInputs.length > 1) {
        selectContainer.removeChild(lastSelect);
    }

    const stockInputs = stockContainer.querySelectorAll("input");
    const lastInput = stockInputs[stockInputs.length - 1];
    if (lastInput && stockInputs.length > 1) {
        stockContainer.removeChild(lastInput);
    }
});