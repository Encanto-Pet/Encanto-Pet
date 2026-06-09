import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const cartStorageKey = 'encantoPetCart';

function readCart() {
    try {
        return JSON.parse(localStorage.getItem(cartStorageKey)) || [];
    } catch {
        return [];
    }
}

function writeCart(cart) {
    localStorage.setItem(cartStorageKey, JSON.stringify(cart));
}

function formatCurrency(value) {
    return Number(value || 0).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    });
}

function escapeHtml(value) {
    return String(value || '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function updateCartCount() {
    const counter = document.getElementById('cart-count');
    if (counter) counter.textContent = readCart().length;
}

window.showToast = function showToast(message) {
    const toast = document.getElementById('toast');

    if (!toast) return;

    toast.textContent = message;
    toast.classList.add('show');

    window.clearTimeout(window.toastTimer);
    window.toastTimer = window.setTimeout(() => {
        toast.classList.remove('show');
    }, 2600);
};

window.addToCart = function addToCart(event, product) {
    event.preventDefault();
    event.stopPropagation();

    const normalizedProduct = typeof product === 'string'
        ? { id: Date.now(), name: product, description: '', price: 0, image: '' }
        : product;

    const cart = readCart();
    cart.push(normalizedProduct);
    writeCart(cart);
    updateCartCount();

    window.showToast(`${normalizedProduct.name} adicionado ao carrinho!`);
};

let activeProductFilter = 'todos';
let activeSearchTerm = '';

function normalizeText(value) {
    return String(value || '')
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .toLowerCase()
        .trim();
}

function getProductSearchText(card) {
    return normalizeText([
        card.dataset.productName,
        card.dataset.productDescription,
        card.dataset.category,
        card.textContent,
    ].join(' '));
}

function applyProductFilters() {
    const cards = document.querySelectorAll('.produto-card');
    const term = normalizeText(activeSearchTerm);
    let visibleCount = 0;

    cards.forEach((card) => {
        const category = card.dataset.category || 'outros';
        const price = Number(card.dataset.price || 0);

        const matchesCategory =
            activeProductFilter === 'todos' ||
            activeProductFilter === category ||
            (activeProductFilter === 'ate-50' && price <= 50) ||
            (activeProductFilter === 'ate-100' && price <= 100) ||
            (activeProductFilter === 'acima-100' && price > 100);

        const matchesSearch = !term || getProductSearchText(card).includes(term);
        const shouldShow = matchesCategory && matchesSearch;

        card.classList.toggle('is-hidden', !shouldShow);
        if (shouldShow) visibleCount += 1;
    });

    const emptySearch = document.getElementById('products-search-empty');
    if (emptySearch) {
        emptySearch.classList.toggle('is-hidden', visibleCount > 0 || !term);
    }
}

window.setFiltro = function setFiltro(button, filter) {
    document.querySelectorAll('.filter-option').forEach((item) => {
        item.classList.remove('active');
    });

    if (button) button.classList.add('active');
    activeProductFilter = filter;
    applyProductFilters();
};

window.filterPets = function filterPets(filter) {
    const products = document.getElementById('produtos');
    if (products) products.scrollIntoView({ behavior: 'smooth' });

    const matchingButton = Array.from(document.querySelectorAll('.filter-option'))
        .find((button) => button.getAttribute('onclick')?.includes(`'${filter}'`));

    window.setFiltro(matchingButton, filter);
};

function setupProductSearch() {
    const forms = document.querySelectorAll('.search');

    forms.forEach((form) => {
        const input = form.querySelector('input[name="search"]');
        if (!input) return;

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const term = input.value.trim();

            if (!document.getElementById('produtos-grid')) {
                window.location.href = `/?search=${encodeURIComponent(term)}#produtos`;
                return;
            }

            activeSearchTerm = term;
            applyProductFilters();

            const products = document.getElementById('produtos');
            if (products) products.scrollIntoView({ behavior: 'smooth' });
        });

        input.addEventListener('input', () => {
            if (!document.getElementById('produtos-grid')) return;
            activeSearchTerm = input.value;
            applyProductFilters();
        });
    });

    const params = new URLSearchParams(window.location.search);
    const initialSearch = params.get('search') || params.get('q') || '';

    if (initialSearch && document.getElementById('produtos-grid')) {
        activeSearchTerm = initialSearch;
        document.querySelectorAll('.search input[name="search"]').forEach((input) => {
            input.value = initialSearch;
        });
        applyProductFilters();

        const products = document.getElementById('produtos');
        if (products) products.scrollIntoView({ behavior: 'smooth' });
    }
}

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) entry.target.classList.add('visible');
    });
}, { threshold: 0.1 });

document.querySelectorAll('.fade-in').forEach((element) => {
    observer.observe(element);
});

function renderCheckoutCart() {
    const checkoutItems = document.getElementById('checkout-items');
    const subtotalElement = document.getElementById('checkout-subtotal');
    const totalElement = document.getElementById('checkout-total');

    if (!checkoutItems || !subtotalElement || !totalElement) return;

    const cart = readCart();

    if (!cart.length) {
        subtotalElement.textContent = subtotalElement.dataset.fallback || 'R$ 0,00';
        totalElement.textContent = totalElement.dataset.fallback || 'R$ 0,00';
        return;
    }

    checkoutItems.innerHTML = cart.map((item) => `
        <div class="order-item">
            <div class="order-item-img">
                ${item.image ? `<img src="${escapeHtml(item.image)}" alt="${escapeHtml(item.name)}">` : '<span>🐾</span>'}
            </div>
            <div class="order-item-text">
                <div class="order-item-name">${escapeHtml(item.name)}</div>
                <div class="order-item-desc">${escapeHtml(item.description || 'Produto Encanto Pet')}</div>
                <div class="order-item-price">${formatCurrency(item.price)}</div>
            </div>
        </div>
    `).join('');

    const subtotal = cart.reduce((sum, item) => sum + Number(item.price || 0), 0);
    subtotalElement.textContent = formatCurrency(subtotal);
    totalElement.textContent = formatCurrency(subtotal);
}

window.selectPayment = function selectPayment(option) {
    document.querySelectorAll('.payment-option .radio-circle').forEach((circle) => {
        circle.classList.remove('selected');
        circle.innerHTML = '';
    });

    const selectedCircle = option.querySelector('.radio-circle');
    selectedCircle.classList.add('selected');
    selectedCircle.innerHTML = '<div class="radio-dot"></div>';
};

window.finishCheckout = function finishCheckout() {
    writeCart([]);
    updateCartCount();
    renderCheckoutCart();
    window.showToast('Pagamento finalizado!');
};

setupProductSearch();
updateCartCount();
renderCheckoutCart();
