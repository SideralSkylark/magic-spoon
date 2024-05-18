<div class="content clearfix">
        <div class="left-zone">
            <img class="main-image" src="/Assets/images/MS_VARIETY_4PACK-434857.avif" alt="Main Image">
            <img class="mountain" src="/Assets/images/variety/Montain.png" alt="mountain">
            <div class="circle-images"></div>
        </div>
        <div class="right-zone">
            <h1>Variety</h1>
            <h2>1 CASE (4 BOXES)</h2>
            <p>Try our most popular flavors—Fruity, Frosted, Cocoa, and Peanut Butter.<br>
             We’ve reimagined all your favorite childhood cereals with 4g net carbs, 13-14g <br>
             complete protein, 140-170 calories, and no artificial ingredients.</p>
            <h3>Variety</h3>
            <img class="carrot" src="/Assets/images/variety/Carrot.png" alt="carrot">
            <img class="wave" src="/Assets/images/variety/Wave.png" alt="wave">
            <select id="flavourSelect">
                <option value="Variety">Variety</option>
                <option value="Fruity">Fruity</option>
                <option value="Cocoa">Cocoa</option>
                <option value="PeanutButter">Peanut Butter</option>
                <option value="Frosted">Frosted</option>
                <option value="MappleWaffle">Mapple Waffle</option>
                <option value="CinnamonRoll">Cinnamon Roll</option>
                <option value="BlueberryMuffin">Blueberry Muffin</option>
            </select>
            <p id="price">$39.00</p>
            <div>
                <button onclick="decrementQuantity()">-</button>
                <span id="quantity">1</span>
                <button onclick="incrementQuantity()">+</button>
                <button onclick="addToCart()">Add to Cart</button>
            </div>
        </div>
        <!-- Modal for full image preview -->
        <div id="imageModal" class="image-modal">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="fullImage">
            <div class="modal-nav">
                <span class="prev" onclick="changeImage(-1)">&#10094;</span>
                <span class="next" onclick="changeImage(1)">&#10095;</span>
            </div>
        </div>
    </div>

    <!-- JavaScript functions -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pageClasses = {
                'shopnowfruety-page': [
                    '/Assets/images/variety/1.avif',
                    '/Assets/images/variety/2.avif',
                    '/Assets/images/variety/3.avif',
                    '/Assets/images/variety/4.avif',
                    '/Assets/images/variety/5.avif',
                    '/Assets/images/variety/6.avif'
                ]
                // Add more page-specific arrays here as needed
            };

            Object.keys(pageClasses).forEach(pageClass => {
                if (document.querySelector(`.${pageClass}`)) {
                    const imageContainer = document.querySelector(`.${pageClass} .circle-images`);
                    pageClasses[pageClass].forEach(imageSrc => {
                        const div = document.createElement('div');
                        div.className = 'circle-image';
                        div.style.backgroundImage = `url('${imageSrc}')`;
                        div.dataset.image = imageSrc;
                        div.onclick = function () {
                            showFullImage(this);
                        };
                        imageContainer.appendChild(div);
                    });
                }
            });
        });

        function showFullImage(circle) {
            const images = Array.from(document.querySelectorAll('.circle-image')).map(img => img.dataset.image);
            let currentIndex = images.indexOf(circle.dataset.image);
            const modal = document.getElementById('imageModal');
            const fullImage = document.getElementById('fullImage');
            fullImage.src = images[currentIndex];
            modal.style.display = "block";

            function changeImage(direction) {
                currentIndex += direction;
                if (currentIndex < 0) {
                    currentIndex = images.length - 1;
                } else if (currentIndex >= images.length) {
                    currentIndex = 0;
                }
                fullImage.src = images[currentIndex];
            }

            document.querySelector('.prev').onclick = () => changeImage(-1);
            document.querySelector('.next').onclick = () => changeImage(1);
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = "none";
        }

        function incrementQuantity() {
            var quantity = parseInt(document.getElementById('quantity').textContent);
            quantity++;
            document.getElementById('quantity').textContent = quantity;
        }

        function decrementQuantity() {
            var quantity = parseInt(document.getElementById('quantity').textContent);
            if (quantity > 1) {
                quantity--;
                document.getElementById('quantity').textContent = quantity;
            }
        }

        function addToCart() {
            store.addToCart();
            updateCartUI();
            console.log("Total price:", store.cart.getTotalPrice());
        }

        class Cart {
            constructor() {
                this.items = JSON.parse(localStorage.getItem('cartItems')) || [];
            }

            addItem(item) {
                this.items.push(item);
                this.updateLocalStorage();
                console.log("Cart items after adding:", this.items);
            }

            getTotalPrice() {
                return this.items.reduce((total, item) => total + (item.price || 0), 0);
            }

            getCart() {
                return this.items;
            }

            updateLocalStorage() {
                localStorage.setItem('cartItems', JSON.stringify(this.items));
            }

            clearLocalStorage() {
                localStorage.removeItem('cartItems');
            }
        }

        class Store {
            constructor() {
                this.cart = new Cart();
            }

            addToCart() {
                var quantity = parseInt(document.getElementById('quantity').textContent);
                var itemName = document.querySelector('.right-zone h1').textContent;
                var itemPrice = parseFloat(document.querySelector('#price').textContent.replace('$', ''));
                const productId = 1;

                var totalPrice = itemPrice * quantity;
                this.cart.addItem({ id: productId, name: itemName, quantity: quantity, price: totalPrice });

                console.log("Store addToCart:", { id: productId, name: itemName, quantity, price: totalPrice });
            }
        }

        const store = new Store(); // Ensure store is defined globally

        function updateCartUI() {
            const cartItemsElement = document.getElementById('cartItems');
            const newItem = document.createElement('li');
            const itemName = document.querySelector('.right-zone h1').textContent;
            const itemQuantity = parseInt(document.getElementById('quantity').textContent);
            const itemPrice = parseFloat(document.querySelector('#price').textContent.replace('$', ''));
            const totalPrice = itemPrice * itemQuantity;

            newItem.innerHTML = `<span>${itemName}</span> - ${itemQuantity} packs - $${totalPrice.toFixed(2)} <button class="remove-button" onclick="removeItem('${itemName}')">Remove</button>`;
            cartItemsElement.appendChild(newItem);

            updateTotalPrice(); // Update the total price in the cart overlay
        }

        function removeItem(itemName) {
            const cartItems = document.getElementById('cartItems');
            const items = Array.from(cartItems.children);
            const itemToRemove = items.find(item => item.textContent.includes(itemName));

            // Remove the item from the UI
            cartItems.removeChild(itemToRemove);

            // Remove the item from the cart
            const index = store.cart.items.findIndex(item => item.name === itemName);
            if (index !== -1) {
                store.cart.items.splice(index, 1);
                store.cart.updateLocalStorage();
                updateTotalPrice(); // Update the total price in the cart overlay
            }
        }

        document.getElementById('flavourSelect').addEventListener('change', function() {
            var selectedOption = this.value;
            switch (selectedOption) {
                case 'Variety':
                    window.location.href = 'shopVariety';
                    break;
                case 'Fruity':
                    window.location.href = 'shopFruety';
                    break;
                case 'Cocoa':
                    window.location.href = 'shopCocoa';
                    break;
                case 'PeanutButter':
                    window.location.href = 'shopPeanutButter';
                    break;
                case 'Frosted':
                    window.location.href = 'shopFrosted';
                    break;
                case 'MappleWaffle':
                    window.location.href = 'shopMappleWaffle';
                    break;
                case 'CinnamonRoll':
                    window.location.href = 'shopCinnamonRoll';
                    break;
                case 'BlueberryMuffin':
                    window.location.href = 'shopBlueberryMuffin';
                    break;
                default:
                    break;
            }
        });

        // Function to update the total price in the cart overlay
        function updateTotalPrice() {
            const totalPriceElement = document.getElementById('total-to-pay-at-checkout');
            totalPriceElement.textContent = `Total: $${store.cart.getTotalPrice().toFixed(2)}`;
        }
    </script>

<?php
    include_once("../views/constant/faq.php");
    include_once '../views/constant/footer-banner.php';
?>