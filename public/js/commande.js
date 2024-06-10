document.addEventListener('DOMContentLoaded', function() {
    const addProductButton = document.getElementById('add-product');
    const productList = document.getElementById('product-list');
    const totalInput = document.getElementById('total-input');
    const totalPrice = document.getElementById('total-price');

    function updateTotalPrice() {
        let total = 0;
        const productItems = document.querySelectorAll('.product-item');
        productItems.forEach(item => {
            const quantite = item.querySelector('.quantite').value;
            const prix = item.querySelector('.prix').value;
            if (quantite && prix) {
                total += quantite * prix;
            }
        });
        totalPrice.textContent = total;
        totalInput.value = total;
    }

    addProductButton.addEventListener('click', function() {
        const newProductItem = document.querySelector('.product-item').cloneNode(true);
        newProductItem.querySelector('select.produit').value = '';
        newProductItem.querySelector('input.quantite').value = '';
        newProductItem.querySelector('input.prix').value = '';
        productList.appendChild(newProductItem);
    });

    productList.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-product')) {
            event.target.closest('.product-item').remove();
            updateTotalPrice();
        }
    });

    productList.addEventListener('input', function(event) {
        if (event.target.classList.contains('quantite')) {
            updateTotalPrice();
        }
    });

    productList.addEventListener('change', function(event) {
        if (event.target.classList.contains('produit')) {
            const selectedOption = event.target.options[event.target.selectedIndex];
            const prix = selectedOption.getAttribute('data-prix');
            const prixInput = event.target.closest('.product-item').querySelector('.prix');
            prixInput.value = prix;
            updateTotalPrice();
        }
    });
});
