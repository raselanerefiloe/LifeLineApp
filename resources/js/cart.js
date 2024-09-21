document.addEventListener('DOMContentLoaded', function() {
    const cartButton = document.getElementById('cartButton');
    const cartPopup = document.getElementById('cartPopup');

    // Toggle the visibility of the cart popup
    cartButton.addEventListener('click', function() {
        if (cartPopup.classList.contains('hidden')) {
            cartPopup.classList.remove('hidden');
        } else {
            cartPopup.classList.add('hidden');
        }
    });

    // Close the cart popup if clicked outside of it
    document.addEventListener('click', function(event) {
        if (!cartButton.contains(event.target) && !cartPopup.contains(event.target)) {
            cartPopup.classList.add('hidden');
        }
    });

    // Function to increment item
    window.incrementItem = function(itemId) {
        fetch(routes.increment, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    item_id: itemId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartUI(data.updatedCart, data.cartItemCount, data.total);
                }
            });
    };

    // Function to decrement item
    window.decrementItem = function(itemId) {
        fetch(routes.decrement, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    item_id: itemId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartUI(data.updatedCart, data.cartItemCount, data.total);
                }
            });
    };

    // Function to delete item
    window.deleteItem = function(itemId) {
        fetch(routes.delete, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    item_id: itemId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartUI(data.updatedCart, data.cartItemCount, data.total);
                }
            });
    };

    // Function to add item to cart
    window.addToCart = function(productId, pack_size) {
        console.log("Pack size.............: ",pack_size);
        fetch(routes.add, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                pack_size: pack_size,
            })
        })
        .then(response => {
            if (response.status === 401) {
                // User is not authenticated, redirect to login or show a message
                alert('You need to log in to add products to your cart.');
                window.location.href = '/login'; // Redirect to login
                return;
            }
            return response.json();
        })
        .then(data => {
            if (data && data.success) {
                updateCartUI(data.updatedCart, data.cartItemCount, data.total);
            } else {
                alert(data.message || 'Failed to add product to cart.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    


    // Function to update the UI of the cart
    function updateCartUI(updatedCart, cartItemCount, total) {
        console.log("Updated Cart: ", updatedCart);
        const cartItemsContainer = document.querySelector('#cartPopup .p-4');
        cartItemsContainer.innerHTML = ''; // Clear existing items

        if (updatedCart.length === 0) {
            cartItemsContainer.innerHTML = '<p class="text-sm text-gray-500">Your cart is empty.</p>';
            document.getElementById('cartBadge').classList.add('hidden');
            return;
        }

        updatedCart.forEach(item => {
            console.log(item);
            const price = parseFloat(item.product.price);
            const itemDiv = document.createElement('div');
            itemDiv.className = 'flex items-center justify-between my-2 p-2 border-b border-gray-200';
            itemDiv.innerHTML = `
                <img src="${item.product.image_url}" alt="${item.product.name}" class="w-12 h-12 object-cover rounded">
                <div class="flex-1 ml-2">
                    <div class="text-sm font-semibold">${item.product.name}</div>
                    <div class="text-sm text-gray-500">R${price.toFixed(2)}</div>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="text-gray-600 hover:text-gray-900" onclick="decrementItem(${item.id})">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                    <span>${item.pack_size}</span>
                    <button class="text-gray-600 hover:text-gray-900" onclick="incrementItem(${item.id})">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-900" onclick="deleteItem(${item.id})">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            `;
            cartItemsContainer.appendChild(itemDiv);
        });

        const totalDiv = document.createElement('div');
        totalDiv.className = 'mt-4 font-semibold';
        totalDiv.innerHTML = `Total: R${total.toFixed(2)}`;
        cartItemsContainer.appendChild(totalDiv);

        // Create and insert place order container
        const placeOrderContainer = document.createElement('div');
        placeOrderContainer.className = 'mt-4';
        placeOrderContainer.innerHTML = `
            <a href="/checkout"
                class="inline-block w-full text-center text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg">
                Place Order
            </a>
        `;
        cartItemsContainer.appendChild(placeOrderContainer);

        const cartBadge = document.getElementById('cartBadge');
        if (cartItemCount > 0) {
            cartBadge.innerText = cartItemCount;
            cartBadge.classList.remove('hidden');
        } else {
            cartBadge.classList.add('hidden');
        }
    }
});
