<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto - Encanto Pet</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <style>
        :root { --yellow:#f6b60b; --green:#49aa3d; --bg:#f5f6fb; --card:#fff; --text:#272936; --muted:#8a92a3; --line:#e9eef5; --shadow:0 16px 35px rgba(32,45,70,.08); --sidebar:178px; }
        * { box-sizing: border-box; }
        body { margin:0; min-height:100vh; display:flex; background:var(--bg); color:var(--text); font-family:Nunito,sans-serif; }
        a { color:inherit; text-decoration:none; }
        button,input,textarea { font:inherit; }
        .sidebar { position:fixed; inset:0 auto 0 0; width:var(--sidebar); padding:30px 18px 22px; display:flex; flex-direction:column; gap:12px; background:#fff; }
        .logo-area { display:grid; place-items:center; margin-bottom:28px; }
        .logo-area img { width:76px; }
        .nav-link,.logout-button { min-height:34px; display:flex; align-items:center; gap:12px; border:0; border-bottom:2px solid transparent; padding:6px 0; color:#1e2430; background:transparent; font-size:14px; font-weight:800; cursor:pointer; text-align:left; }
        .nav-link i,.logout-button i { width:19px; font-size:19px; }
        .nav-link.active { border-bottom-color:var(--yellow); }
        .nav-link:hover,.logout-button:hover { color:var(--yellow); }
        .logout-form { margin-top:auto; }
        .main { width:calc(100% - var(--sidebar)); margin-left:var(--sidebar); }
        .topbar { height:56px; padding:0 34px 0 22px; display:flex; align-items:center; justify-content:space-between; background:#fff; }
        .search-bar { width:min(410px,48vw); height:36px; display:flex; align-items:center; gap:10px; border-radius:10px; padding:0 14px; background:#eef4fa; color:#9eb5c4; }
        .search-bar input { width:100%; border:0; outline:0; color:#617080; background:transparent; font-size:12px; font-weight:800; }
        .topbar-right { display:flex; align-items:center; gap:15px; color:#7ab5c4; }
        .admin-face { width:34px; height:34px; border-radius:50%; display:grid; place-items:center; overflow:hidden; background:var(--yellow); }
        .admin-face img { width:100%; height:100%; object-fit:cover; }
        .admin-name { color:var(--text); font-size:12px; font-weight:900; line-height:1; }
        .admin-role { color:var(--muted); font-size:11px; font-weight:800; }
        .content { min-height:calc(100vh - 56px); padding:34px clamp(18px,3vw,38px) 46px; }
        .header { display:flex; justify-content:space-between; gap:24px; }
        h1 { margin:0; font-size:28px; line-height:1; font-weight:900; }
        .subtitle { margin-top:9px; color:var(--muted); font-size:12px; font-weight:800; }
        .dog-badge { width:144px; height:144px; margin-right:clamp(8px,7vw,96px); border-radius:44% 56% 54% 46%; display:grid; place-items:end center; overflow:hidden; background:var(--yellow); }
        .dog-badge img { width:116px; height:116px; object-fit:contain; }
        .form-layout { display:grid; grid-template-columns:minmax(280px,360px) minmax(280px,320px); justify-content:space-between; align-items:start; gap:clamp(40px,12vw,150px); margin-top:78px; max-width:850px; }
        .product-form { display:grid; gap:24px; }
        .field { position:relative; display:block; }
        .field span { position:absolute; top:-9px; left:0; z-index:2; max-width:90%; border-radius:5px; padding:3px 9px; color:#4f5f70; background:#dfeaf2; font-size:10px; font-weight:900; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .field input,.field textarea,.field select { width:100%; min-height:42px; border:0; border-radius:8px; padding:12px 14px; color:var(--text); background:#eef4fa; box-shadow:0 7px 13px rgba(42,58,78,.16); outline:0; font-size:12px; font-weight:800; }
        .field textarea { min-height:58px; resize:vertical; }
        .field input:focus,.field textarea:focus,.field select:focus { background:#fff; box-shadow:0 0 0 3px rgba(246,182,11,.22),0 7px 13px rgba(42,58,78,.14); }
        .field input[type=file] { color:transparent; cursor:pointer; }
        .field input[type=file]::file-selector-button { border:0; border-radius:7px; padding:7px 11px; color:#fff; background:#76b7c6; font-weight:900; cursor:pointer; }
        .actions { display:flex; align-items:center; justify-content:space-between; gap:16px; }
        .save-btn { min-width:112px; min-height:36px; border:0; border-radius:8px; color:#fff; background:var(--green); font-size:12px; font-weight:900; cursor:pointer; }
        .back-link { color:var(--yellow); font-size:11px; font-weight:900; }
        .preview-card { width:320px; border-radius:10px; overflow:hidden; background:#fff; box-shadow:var(--shadow); }
        .preview-image { height:270px; display:grid; grid-template-columns:38px 1fr 38px; align-items:center; background:#fff; }
        .preview-image button { width:28px; height:28px; border:0; border-radius:50%; color:#9aa4b3; background:#eef4fa; font-size:22px; cursor:pointer; }
        .preview-image img { width:190px; max-height:205px; justify-self:center; object-fit:contain; filter:drop-shadow(0 12px 16px rgba(32,45,70,.14)); }
        .preview-info { padding:22px 24px 28px; }
        .preview-info h2 { margin:0; color:#2c2f39; font-size:16px; line-height:1.22; font-weight:900; }
        .preview-price { display:block; margin-top:8px; color:#62b7c9; font-size:14px; font-weight:900; }
        .stars { margin-top:7px; color:#ff9e00; font-size:13px; font-weight:900; }
        .stars span { color:#a0a7b3; font-size:11px; }
        .category-label { display:block; margin-top:14px; color:#8d95a2; font-size:10px; font-weight:900; }
        .category-value { margin:0; color:#303341; font-size:12px; font-weight:900; }
        .error-list { max-width:650px; margin-top:18px; border-radius:10px; padding:14px 18px; color:#b42318; background:#fff0f0; font-weight:800; }
        @media (max-width: 900px) { .form-layout { grid-template-columns:1fr; max-width:520px; } .preview-card { width:100%; } .dog-badge { margin-right:0; } }
        @media (max-width: 720px) { body { display:block; } .sidebar { position:static; width:100%; display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:8px 18px; } .logo-area { grid-column:1/-1; margin-bottom:8px; } .logout-form { margin-top:0; } .main { width:100%; margin-left:0; } .topbar { height:auto; padding:14px 18px; flex-wrap:wrap; } .search-bar { width:100%; } .header { flex-direction:column; } }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="logo-area"><a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.svg') }}" alt="Encanto Pet"></a></div>
    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="ph ph-gauge"></i>Dashboard</a>
    <a class="nav-link" href="{{ route('admin.dashboard', ['section' => 'clientes']) }}"><i class="ph ph-user"></i>Minha conta</a>
    <a class="nav-link active" href="{{ route('admin.dashboard', ['section' => 'produtos']) }}"><i class="ph ph-shopping-cart-simple"></i>Produtos cadastrados</a>
    <a class="nav-link" href="{{ route('admin.dashboard', ['section' => 'pedidos']) }}"><i class="ph ph-package"></i>Pedidos</a>
    <form class="logout-form" method="POST" action="{{ route('logout') }}">@csrf<button class="logout-button" type="submit"><i class="ph ph-sign-out"></i>Sair</button></form>
</aside>

<main class="main">
    <header class="topbar">
        <form class="search-bar" method="GET" action="{{ route('admin.dashboard') }}"><input name="customer_search" placeholder="Pesquise produtos..."><i class="ph ph-magnifying-glass"></i></form>
        <div class="topbar-right"><div class="admin-face"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div><div><div class="admin-name">{{ auth()->user()->name }}</div><div class="admin-role">Adm</div></div><i class="ph ph-heart"></i><i class="ph ph-globe-hemisphere-west"></i><i class="ph ph-bell"></i></div>
    </header>

    <section class="content">
        <div class="header">
            <div><h1>Olá, Adm! <span style="color:var(--yellow)">👋</span></h1><p class="subtitle">Cadastre mais produtos e aumente a sua variedade.</p></div>
            <div class="dog-badge"><img src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt=""></div>
        </div>
        @if($errors->any())
            <div class="error-list">{{ $errors->first() }}</div>
        @endif
        <div class="form-layout">
            <form class="product-form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="redirect_to" value="{{ route('admin.dashboard', ['section' => 'produtos']) }}">
                <label class="field"><span>Produto</span><input type="text" name="name" id="adminProductName" value="{{ old('name') }}" required></label>
                <label class="field"><span>Descrição</span><textarea name="description" id="adminProductDescription" required>{{ old('description') }}</textarea></label>
                <label class="field"><span>Preço</span><input type="number" name="price" id="adminProductPrice" value="{{ old('price') }}" step="0.01" min="0.01" required></label>
                <label class="field"><span>Estoque</span><input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" step="1" required></label>
                <label class="field">
                    <span>Categoria</span>
                    <select name="category" id="adminProductCategory" required>
                        <option value="" disabled @selected(! old('category'))>Selecione uma categoria</option>
                        @foreach($categoryOptions as $value => $label)
                            <option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="field"><span>Faça o upload da foto do produto</span><input type="file" name="image" id="adminProductImage" accept="image/*"></label>
                <div class="actions"><button class="save-btn" type="submit">Salvar Produto</button><a class="back-link" href="{{ route('admin.dashboard', ['section' => 'produtos']) }}">Voltar</a></div>
            </form>
            <aside class="preview-card" aria-label="Prévia do produto">
                <div class="preview-image"><button type="button" aria-label="Anterior">‹</button><img id="adminPreviewImage" src="{{ asset('assets/img/cachorro-feliz.svg') }}" alt="Prévia"><button type="button" aria-label="Próximo">›</button></div>
                <div class="preview-info"><h2 id="adminPreviewName">Ração Fórmula Salmão - 10kg</h2><strong class="preview-price" id="adminPreviewPrice">R$149,00</strong><div class="stars">★★★★<span>★ (131)</span></div><small class="category-label">Categoria</small><p class="category-value" id="adminPreviewCategory">Ração</p></div>
            </aside>
        </div>
    </section>
</main>
<script>
const nameInput = document.getElementById('adminProductName');
const priceInput = document.getElementById('adminProductPrice');
const categoryInput = document.getElementById('adminProductCategory');
const imageInput = document.getElementById('adminProductImage');
const previewName = document.getElementById('adminPreviewName');
const previewPrice = document.getElementById('adminPreviewPrice');
const previewCategory = document.getElementById('adminPreviewCategory');
const previewImage = document.getElementById('adminPreviewImage');
function price(value) { const n = Number(value); return value && !Number.isNaN(n) ? n.toLocaleString('pt-BR', { style:'currency', currency:'BRL' }) : 'R$149,00'; }
function updatePreview() { previewName.textContent = nameInput.value || 'Ração Fórmula Salmão - 10kg'; previewPrice.textContent = price(priceInput.value); previewCategory.textContent = categoryInput.selectedOptions[0]?.text || 'Ração'; }
[nameInput, priceInput, categoryInput].forEach((field) => field.addEventListener('input', updatePreview));
imageInput.addEventListener('change', (event) => { const file = event.target.files[0]; if (!file) return; const reader = new FileReader(); reader.onload = (e) => previewImage.src = e.target.result; reader.readAsDataURL(file); });
</script>
</body>
</html>
