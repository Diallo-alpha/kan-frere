document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const cartCount = document.querySelector(".cart-count");
    const cartItemsContainer = document.querySelector("#cartItemsContainer");
    const cartFormItems = document.querySelector("#cartFormItems");

    // Supprimer le produit par défaut du panier
    localStorage.removeItem("cart");

    addToCartButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const produitId = this.getAttribute("data-id");
            const produitNom = this.getAttribute("data-nom");
            const produitPrix = parseFloat(this.getAttribute("data-prix"));

            const cartItem = {
                id: produitId,
                nom: produitNom,
                prix: produitPrix,
                quantite: 1
            };

            addToCart(cartItem);
            updateCartUI();
        });
    });

    function addToCart(cartItem) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const existingItemIndex = cart.findIndex(item => item.id === cartItem.id);

        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantite++;
        } else {
            cart.push(cartItem);
        }

        localStorage.setItem("cart", JSON.stringify(cart));
    }

    function updateCartUI() {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cartCount.textContent = cart.reduce((total, item) => total + item.quantite, 0);
        cartItemsContainer.innerHTML = "";
        cartFormItems.innerHTML = "";

        cart.forEach(item => {
            const itemTotal = (item.prix * item.quantite).toFixed(2);
            const cartItemHTML = `
                <tr>
                    <td>${item.nom}</td>
                    <td>${item.prix} CFA</td>
                    <td>
                        <button class="btn btn-sm btn-primary increase-quantity" data-id="${item.id}">+</button>
                        ${item.quantite}
                        <button class="btn btn-sm btn-primary decrease-quantity" data-id="${item.id}">-</button>
                    </td>
                    <td>${itemTotal} CFA</td>
                    <td><button class="btn btn-sm btn-danger remove-item" data-id="${item.id}">Supprimer</button></td>
                </tr>
            `;
            cartItemsContainer.innerHTML += cartItemHTML;

            const cartFormItemHTML = `
                <input type="hidden" name="products[${item.id}][quantity]" value="${item.quantite}">
            `;
            cartFormItems.innerHTML += cartFormItemHTML;
        });

        document.querySelectorAll(".increase-quantity").forEach(button => {
            button.addEventListener("click", function () {
                const produitId = this.getAttribute("data-id");
                updateQuantity(produitId, 1);
            });
        });

        document.querySelectorAll(".decrease-quantity").forEach(button => {
            button.addEventListener("click", function () {
                const produitId = this.getAttribute("data-id");
                updateQuantity(produitId, -1);
            });
        });

        document.querySelectorAll(".remove-item").forEach(button => {
            button.addEventListener("click", function () {
                const produitId = this.getAttribute("data-id");
                removeItem(produitId);
            });
        });

        updateTotal();
    }

    function updateQuantity(produitId, change) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const itemIndex = cart.findIndex(item => item.id === produitId);

        if (itemIndex !== -1) {
            cart[itemIndex].quantite += change;
            if (cart[itemIndex].quantite <= 0) {
                cart.splice(itemIndex, 1);
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartUI();
        }
    }

    function removeItem(produitId) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart = cart.filter(item => item.id !== produitId);

        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartUI();
    }

    function updateTotal() {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const total = cart.reduce((sum, item) => sum + (item.prix * item.quantite), 0).toFixed(2);
        document.querySelector("#cartTotal").textContent = `${total} CFA`;
    }

    updateCartUI();
});
