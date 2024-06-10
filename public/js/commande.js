document.addEventListener('DOMContentLoaded', function() {
    const addProductButton = document.getElementById('add-product');
    const productList = document.getElementById('product-list');
    const totalPriceElement = document.getElementById('total-price');
    const totalInput = document.getElementById('total-input');

    function updateTotalPrice() {
        let total = 0;
        document.querySelectorAll('.product-item').forEach(function(productItem) {
            const quantite = parseFloat(productItem.querySelector('.quantite').value) || 0;
            const prix = parseFloat(productItem.querySelector('.prix').value) || 0;
            total += quantite * prix;
        });
        totalPriceElement.textContent = total.toFixed(2);
        totalInput.value = total.toFixed(2);
    }

    function removeProduct(event) {
        event.target.closest('.product-item').remove();
        updateTotalPrice();
    }

    addProductButton.addEventListener('click', function() {
        const productItem = document.createElement('div');
        productItem.className = 'product-item mb-3';
        productItem.innerHTML = `
            <div class="form-group">
                <label for="produit">Produit</label>
                <input type="text" class="form-control produit" name="produits[]" required>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité</label>
                <input type="number" class="form-control quantite" name="quantites[]" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" class="form-control prix" name="prix[]" required>
            </div>
            <button type="button" class="btn btn-danger remove-product">Supprimer</button>
        `;
        productList.appendChild(productItem);

        productItem.querySelector('.quantite').addEventListener('input', updateTotalPrice);
        productItem.querySelector('.prix').addEventListener('input', updateTotalPrice);
        productItem.querySelector('.remove-product').addEventListener('click', removeProduct);
    });

    document.querySelectorAll('.quantite').forEach(function(input) {
        input.addEventListener('input', updateTotalPrice);
    });

    document.querySelectorAll('.prix').forEach(function(input) {
        input.addEventListener('input', updateTotalPrice);
    });

    document.querySelectorAll('.remove-product').forEach(function(button) {
        button.addEventListener('click', removeProduct);
    });

    updateTotalPrice(); // Initial calculation
});
