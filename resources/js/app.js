import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

  // ===== PRODUTOS DATA =====
  const produtos = [
    { id:1, nome:'Ração Premium Adultos', desc:'Sabor Frango – 15kg', preco:'R$ 129,90', precoOld:'R$ 159,00', emoji:'🥩', categoria:'racao', badge:'Destaque' },
    { id:2, nome:'Ração Filhotes', desc:'Super Premium – 10kg', preco:'R$ 89,90', precoOld:'R$ 110,00', emoji:'🍗', categoria:'racao', badge:'Promo', badgePromo:true },
    { id:3, nome:'Ração Gatos Indoor', desc:'Pelo Brilhante – 3kg', preco:'R$ 49,90', precoOld:null, emoji:'🐱', categoria:'racao', badge:null },
    { id:4, nome:'Petisco Dental', desc:'Limpa dentes – cx 12un', preco:'R$ 22,90', precoOld:'R$ 28,00', emoji:'🦴', categoria:'petisco', badge:'Promo', badgePromo:true },
    { id:5, nome:'Bifinhos Salmão', desc:'Petisco natural – 100g', preco:'R$ 18,50', precoOld:null, emoji:'🐟', categoria:'petisco', badge:null },
    { id:6, nome:'Brinquedo Corda', desc:'Resistente e divertido', preco:'R$ 34,90', precoOld:null, emoji:'🪢', categoria:'brinquedo', badge:'Novo' },
    { id:7, nome:'Bolinha Squeaky', desc:'Pack com 3 unidades', preco:'R$ 27,90', precoOld:'R$ 35,00', emoji:'⚽', categoria:'brinquedo', badge:'Promo', badgePromo:true },
    { id:8, nome:'Shampoo Pelos Claros', desc:'400ml – Perfumado', preco:'R$ 31,90', precoOld:null, emoji:'🛁', categoria:'higiene', badge:null },
    { id:9, nome:'Escova Dentes Pet', desc:'Kit completo', preco:'R$ 19,90', precoOld:'R$ 25,00', emoji:'🪥', categoria:'higiene', badge:'Promo', badgePromo:true },
    { id:10, nome:'Ração Sênior', desc:'Para pets acima de 7 anos', preco:'R$ 99,90', precoOld:null, emoji:'💊', categoria:'racao', badge:'Novo' },
    { id:11, nome:'Comedouro Automático', desc:'2L – Temporizador', preco:'R$ 189,90', precoOld:'R$ 230,00', emoji:'🍽️', categoria:'brinquedo', badge:'Destaque' },
    { id:12, nome:'Areia Sanitária', desc:'Granulado – 4kg', preco:'R$ 39,90', precoOld:null, emoji:'🪣', categoria:'higiene', badge:null },
  ];
 
  let filtroAtivo = 'todos';
  let cartCount = 0;
 
  function renderProdutos(lista) {
    const grid = document.getElementById('produtos-grid');
    grid.innerHTML = '';
    lista.forEach((p, i) => {
      const card = document.createElement('div');
      card.className = 'produto-card fade-in';
      card.style.animationDelay = `${i * 0.05}s`;
      card.innerHTML = `
        ${p.badge ? `<div class="produto-badge${p.badgePromo?' promo':''}">${p.badge}</div>` : ''}
        <div class="produto-img">${p.emoji}</div>
        <div class="produto-info">
          <div class="produto-nome">${p.nome}</div>
          <div class="produto-desc">${p.desc}</div>
          <div class="produto-preco-row">
            <div>
              ${p.precoOld ? `<div class="produto-preco-old">${p.precoOld}</div>` : ''}
              <div class="produto-preco">${p.preco}</div>
            </div>
            <button class="btn-add" onclick="addToCart(event, '${p.nome}')">+</button>
          </div>
        </div>
      `;
      grid.appendChild(card);
      setTimeout(() => card.classList.add('visible'), 50 + i * 60);
    });
  }
 
  function setFiltro(el, filtro) {
    filtroAtivo = filtro;
    document.querySelectorAll('.filtro-chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    const lista = filtro === 'todos' ? produtos : produtos.filter(p => p.categoria === filtro);
    renderProdutos(lista);
  }
 
  function addToCart(e, nome) {
    e.stopPropagation();
    cartCount++;
    document.getElementById('cart-count').textContent = cartCount;
    showToast(`✅ ${nome} adicionado ao carrinho!`);
    const btn = e.target;
    btn.style.transform = 'scale(1.4)';
    setTimeout(() => btn.style.transform = '', 200);
  }
 
  function filterPets(pet) {
    document.getElementById('produtos').scrollIntoView({ behavior: 'smooth' });
    showToast(`🐾 Mostrando produtos para ${pet}!`);
  }
 
  function showToast(msg) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 2800);
  }
 
  // ===== SCROLL ANIMATIONS =====
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.12 });
 
  document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
 
  // ===== INIT =====
  renderProdutos(produtos);

