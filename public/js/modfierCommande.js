document.addEventListener('DOMContentLoaded', function () {
    const productList = document.getElementById('product-list');
    const totalPriceElement = document.getElementById('total-price');
    const totalInputElement = document.getElementById('total-input');

    function calculateTotal() {
        let total = 0;
        const productItems = productList.getElementsByClassName('product-item');

        Array.from(productItems).forEach(item => {
            const quantite = item.querySelector('.quantite').value;
            const prix = item.querySelector('.prix').value;
            total += quantite * prix;
        });

        totalPriceElement.textContent = total;
        totalInputElement.value = total;
    }

    productList.addEventListener('input', function (event) {
        if (event.target.classList.contains('quantite') || event.target.classList.contains('prix')) {
            calculateTotal();
        }
    });

    calculateTotal();
});
