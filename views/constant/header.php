<header>
    <nav>
        <ul class="header-links-left homePage">
            <li><a href="/about">ABOUT US</a></li>
        </ul>
        <div class="header-logo">
            <a href="/">
                <span class="magic">MAGIC</span>
                <span class="spoon">SPOON</span>
            </a>
        </div>
        <ul class="header-links-right">
            <li>
                <a href="/shop" class="shopnow">SHOP NOW</a>
                <ul>
                    <li><a href="/cereal">CEREAL</a></li>
                    <li><a href="/treats">TREATS</a></li>
                    <li><a href="/bundles">BUNDLES</a></li>
                </ul>
            </li>
        </ul>
        <div class="header-actions">
            <a href="/login"><img src="/Assets/icons/user.png" alt="user"></a>
            <a href="#" class="cart-icon" onclick="toggleCart()"><img src="/Assets/icons/magic-hat.png" alt="cart"></a>
        </div>
    </nav>
</header>

<div class="cart-overlay" id="cartOverlay" onclick="closeCart()">
    <div class="cart-content" onclick="event.stopPropagation()">
        <h2>Cart</h2>
        <button class="close-cart-btn" onclick="closeCart()">Close</button>
        <ul id="cartItems">
            <!-- Cart items will be dynamically added here -->
        </ul>
        <p id="total-to-pay-at-checkout">$0</p>
        <button class="checkout-btn" onclick="checkout()">Checkout</button>
    </div>
</div>

<script>
    // Ensure these functions are available globally
    function toggleCart() {
        var cartOverlay = document.getElementById('cartOverlay');
        if (cartOverlay.style.right === '-37%') {
            cartOverlay.style.right = '0'; // Show cart
            document.body.style.overflow = 'hidden'; // Hide body overflow
            updateTotalPrice();
            
        } else {
            cartOverlay.style.right = '-37%'; // Hide cart
            document.body.style.overflow = ''; // Restore body overflow
        }
    }

    function updateCartUI() {
        const cartItemsElement = document.getElementById('cartItems');
        cartItemsElement.innerHTML = ''; // Clear existing items
        store.cart.getCart().forEach(item => {
            const newItem = document.createElement('li');
            const totalPrice = item.price * item.quantity;

            newItem.innerHTML = `<span>${item.name}</span> - ${item.quantity} packs - $${totalPrice.toFixed(2)} <button class="remove-button" onclick="removeItem('${item.name}')">Remove</button>`;
            cartItemsElement.appendChild(newItem);
        });
        updateTotalPrice();
    }


    function closeCart() {
        var cartOverlay = document.getElementById('cartOverlay');
        cartOverlay.style.right = '-37%'; // Hide cart
        document.body.style.overflow = ''; // Restore body overflow
    }



    function updateTotalPrice() {
        var totalElement = document.getElementById('total-to-pay-at-checkout');
        totalElement.textContent = '$' + calculateTotalPrice().toFixed(2); // Format as currency with 2 decimal places
    }

    function calculateTotalPrice() {
        return store.cart.getTotalPrice();
        
    }

    function checkout() {
        const cartItems = JSON.parse(localStorage.getItem('cartItems'));
        fetch('cart/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cartItems) // Pass the cart items as the request body
        })
        .then(response => {
            if (response.ok) {
                localStorage.removeItem('cartItems');
                window.location.href = '/shop?checkout=success';
            } else {
                console.error('Checkout failed:', response.statusText);
                alert('Checkout failed. Please try again later.');
            }
        })
        .catch(error => {
            console.error('Checkout failed:', error);
            alert('Checkout failed. Please check your network connection and try again.');
        });
    }

    window.addEventListener('load', function() {
        const cartItems = document.getElementById('cartItems');
        const storedItems = JSON.parse(localStorage.getItem('cartItems'));
        console.log("Loaded items from local storage:", storedItems);
        if (storedItems) {
            storedItems.forEach(item => {
                const newItem = document.createElement('li');
                newItem.innerHTML = `<span>${item.name}</span> - ${item.quantity} packs - $${(item.price || 0).toFixed(2)} <button class="remove-button" onclick="removeItem('${item.name}')">Remove</button>`;
                cartItems.appendChild(newItem);
            });
        }
        updateTotalPrice(); // Update the total price in the cart overlay
        
        // Bind the checkout function to the checkout button
        const checkoutButton = document.getElementById('checkoutButton');
        if (!checkoutButton.hasAttribute('data-clicked')) {
            checkoutButton.setAttribute('data-clicked', true);
            checkoutButton.addEventListener('click', checkout);
        }
    });
</script>
