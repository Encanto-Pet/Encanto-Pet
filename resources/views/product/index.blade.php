 <!-- PRODUTOS PAGE -->
  <div class="page" id="page-produtos" style="position:relative">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:24px">
      <div>
        <div class="page-title">Olá, Adm! 👋</div>
        <div class="page-subtitle">Cadastre mais produtos e aumente a sua variedade.</div>
        <div class="prod-stats">
          <div class="prod-stat-card">
            <div>
              <div class="stat-label">Produtos Cadastrados</div>
              <div class="stat-value">{{ $productsCount ?? 0 }}</div>
            </div>
            <div class="stat-icon green">🐾</div>
          </div>
          <div class="prod-stat-card">
            <div>
              <div class="stat-label">Produtos Arquivados</div>
              <div class="stat-value">{{ $archivedProductsCount ?? 0 }}</div>
            </div>
            <div class="stat-icon red">📦</div>
          </div>
        </div>
      </div>
      <div style="width:120px;height:120px;border-radius:50%;background:var(--yellow);overflow:hidden;display:flex;align-items:center;justify-content:center;margin-top:8px;flex-shrink:0">
        <img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt="" style="width:88%;height:88%;object-fit:contain">
      </div>
    </div>

    <div class="admin-product-create">
      <form class="admin-product-form" id="adminProductForm"
      action="/product/store"
      method="POST"
      enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="redirect_to" value="/admin/dashboard?section=produtos">

        <label class="admin-field">
          <span>Produto</span>
          <input type="text" name="name" id="adminProductName" required>
        </label>

        <label class="admin-field">
          <span>Descrição</span>
          <textarea name="description" id="adminProductDescription" rows="2" required></textarea>
        </label>

        <label class="admin-field">
          <span>Preço</span>
          <input type="number" name="price" id="adminProductPrice" step="0.01" required>
        </label>

        <label class="admin-field">
          <span>Categoria</span>
          <input type="text" name="category" id="adminProductCategory" required>
        </label>

        <label class="admin-field admin-field-file" for="adminProductImage">
          <span>Faça o upload da foto do produto</span>
          <input type="file" name="image" id="adminProductImage" accept="image/*">
        </label>

        <div class="admin-product-actions">
          <button type="submit" class="admin-save-btn">Salvar Produto</button>
          <a href="/product" class="admin-back-link">Voltar</a>
        </div>
      </form>

      <aside class="admin-product-preview" aria-label="Prévia do produto">
        <div class="admin-preview-image">
          <button type="button" aria-label="Produto anterior">‹</button>
          <img id="adminPreviewImage" src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt="Prévia do produto">
          <button type="button" aria-label="Próximo produto">›</button>
        </div>

        <div class="admin-preview-info">
          <h3 id="adminPreviewName">Ração Fórmula Salmão - 10kg</h3>
          <strong id="adminPreviewPrice">R$149,00</strong>
          <div class="admin-preview-stars">★★★★☆ <span>(131)</span></div>
          <small>Categoria:</small>
          <p id="adminPreviewCategory">Ração de Cachorro</p>
        </div>
      </aside>
    </div>

    <div class="admin-products-header">
      <div>
        <div class="section-title" style="margin-top:0">Sua prateleira</div>
        <div class="page-subtitle">Produtos cadastrados recentemente.</div>
      </div>
      <a class="add-link" href="/product">Ver todos</a>
    </div>

    <div class="products-grid">
      @forelse(($products ?? collect()) as $product)
        <div class="product-card">
          <div class="product-img-wrap">
            <div class="prod-nav-btn left">‹</div>
            @if($product->image)
              <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            @else
              <img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt="{{ $product->name }}">
            @endif
            <div class="prod-nav-btn right">›</div>
          </div>
          <div class="product-name">{{ $product->name }}</div>
          <div class="product-price">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
          <div class="product-stars">★★★★☆ <span>(131)</span></div>
          <div class="product-cat"><b>Categoria:</b> {{ $product->category }}</div>
          <div class="product-actions">
            <a class="prod-btn" href="/product/edit/{{ $product->id }}" title="Editar">✏️</a>
            <a class="prod-btn" href="/product/delete/{{ $product->id }}" title="Remover">❌</a>
          </div>
        </div>
      @empty
        <div class="empty-products">Nenhum produto cadastrado ainda.</div>
      @endforelse
    </div>
  </div>