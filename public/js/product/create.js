/* =====================================================
   ENCANTO PET — Produtos Cadastrados
   Arquivo: produtos.js
   ===================================================== */

(function () {

  /* --------------------------------------------------
     Dados dos produtos (mock)
  -------------------------------------------------- */
  const PRODUCTS = [
    {
      id: 1,
      name: 'Ração Fórmula Salmão – 10kg',
      price: 'R$149,00',
      stars: 4,
      reviews: 131,
      category: 'Ração de Cachorro',
      emoji: '🛍️',
    },
    {
      id: 2,
      name: 'Ração Fórmula Frango – 10kg',
      price: 'R$139,00',
      stars: 5,
      reviews: 87,
      category: 'Ração de Cachorro',
      emoji: '🛍️',
    },
    {
      id: 3,
      name: 'Petisco Golden Bone',
      price: 'R$29,90',
      stars: 4,
      reviews: 214,
      category: 'Petiscos',
      emoji: '🦴',
    },
    {
      id: 4,
      name: 'Areia Sanitária Premium 4kg',
      price: 'R$34,90',
      stars: 3,
      reviews: 56,
      category: 'Higiene Felina',
      emoji: '🐱',
    },
    {
      id: 5,
      name: 'Coleira Refletiva M',
      price: 'R$59,90',
      stars: 5,
      reviews: 42,
      category: 'Acessórios',
      emoji: '🐕',
    },
    {
      id: 6,
      name: 'Shampoo Neutro Pet 500ml',
      price: 'R$24,90',
      stars: 4,
      reviews: 99,
      category: 'Higiene',
      emoji: '🚿',
    },
  ];

  const PAGE_SIZE = 3;
  let currentPage = 1;
  const totalPages = Math.ceil(PRODUCTS.length / PAGE_SIZE);

  /* --------------------------------------------------
     Renderização
  -------------------------------------------------- */
  function starsHTML(n) {
    return '★'.repeat(n) + '☆'.repeat(5 - n);
  }

  function renderCard(product) {
    const card = document.createElement('div');
    card.className = 'product-card';
    card.dataset.productId = product.id;

    card.innerHTML = `
      <div class="product-img-wrap">
        <button class="prod-nav-btn left" title="Imagem anterior">‹</button>
        <div style="font-size:80px;display:flex;align-items:center;justify-content:center;height:100%">
          ${product.emoji}
        </div>
        <button class="prod-nav-btn right" title="Próxima imagem">›</button>
      </div>
      <div class="product-name">${product.name}</div>
      <div class="product-price">${product.price}</div>
      <div class="product-stars">${starsHTML(product.stars)} <span>(${product.reviews})</span></div>
      <div class="product-cat"><b>Categoria:</b> ${product.category}</div>
      <div class="product-actions">
        <button class="prod-btn btn-edit"   title="Editar">✏️</button>
        <button class="prod-btn btn-remove" title="Remover">❌</button>
      </div>
    `;

    /* Editar */
    card.querySelector('.btn-edit').addEventListener('click', () => {
      alert(`Editar produto: ${product.name}`);
    });

    /* Remover */
    card.querySelector('.btn-remove').addEventListener('click', () => {
      if (confirm(`Remover "${product.name}"?`)) {
        card.style.transition = 'opacity 0.3s';
        card.style.opacity = '0';
        setTimeout(() => {
          card.remove();
          updateCounter(-1);
        }, 300);
      }
    });

    return card;
  }

  function renderGrid() {
    const grid = document.querySelector('#page-produtos .products-grid');
    if (!grid) return;

    grid.innerHTML = '';

    const start = (currentPage - 1) * PAGE_SIZE;
    const slice = PRODUCTS.slice(start, start + PAGE_SIZE);
    slice.forEach(p => grid.appendChild(renderCard(p)));

    renderPagination();
  }

  /* --------------------------------------------------
     Paginação
  -------------------------------------------------- */
  function renderPagination() {
    const nums = document.querySelector('#page-produtos .pag-nums');
    if (!nums) return;

    nums.innerHTML = '';
    for (let i = 1; i <= totalPages; i++) {
      const btn = document.createElement('button');
      btn.className = 'pag-num' + (i !== currentPage ? ' inactive' : '');
      btn.textContent = i;
      btn.addEventListener('click', () => {
        currentPage = i;
        renderGrid();
      });
      nums.appendChild(btn);
    }

    const prevBtn = document.querySelector('#page-produtos .pag-btn-prev');
    const nextBtn = document.querySelector('#page-produtos .pag-btn-next');
    if (prevBtn) prevBtn.disabled = currentPage === 1;
    if (nextBtn) nextBtn.disabled = currentPage === totalPages;
  }

  /* --------------------------------------------------
     Contador de produtos cadastrados
  -------------------------------------------------- */
  function updateCounter(delta) {
    const el = document.querySelector('#page-produtos .prod-registered-count');
    if (!el) return;
    el.textContent = parseInt(el.textContent, 10) + delta;
  }

  /* --------------------------------------------------
     Botões Anterior / Próximo
  -------------------------------------------------- */
  function bindPaginationButtons() {
    const prev = document.querySelector('#page-produtos .pag-btn-prev');
    const next = document.querySelector('#page-produtos .pag-btn-next');

    if (prev) {
      prev.addEventListener('click', () => {
        if (currentPage > 1) { currentPage--; renderGrid(); }
      });
    }
    if (next) {
      next.addEventListener('click', () => {
        if (currentPage < totalPages) { currentPage++; renderGrid(); }
      });
    }
  }

  /* --------------------------------------------------
     Init
  -------------------------------------------------- */
  function init() {
    renderGrid();
    bindPaginationButtons();
  }

  /* Aguarda o DOM estar pronto */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();