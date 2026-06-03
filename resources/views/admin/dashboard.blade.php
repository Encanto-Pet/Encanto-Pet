<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Encanto Pet</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --yellow: #F5C518;
    --yellow-light: #FFF8DC;
    --yellow-hover: #e6b800;
    --green: #4CAF50;
    --green-light: #E8F5E9;
    --red: #F44336;
    --red-light: #FFEBEE;
    --blue: #2196F3;
    --blue-light: #E3F2FD;
    --sidebar-bg: #fff;
    --bg: #F4F6FA;
    --card: #fff;
    --text: #222;
    --text-muted: #888;
    --border: #EBEBEB;
    --shadow: 0 2px 16px rgba(0,0,0,0.07);
    --radius: 16px;
    --sidebar-width: 210px;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Nunito', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; }

  /* SIDEBAR */
  .sidebar {
    width: var(--sidebar-width);
    background: var(--sidebar-bg);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    padding: 28px 0 20px 0;
    border-right: 1px solid var(--border);
    position: fixed;
    top: 0; left: 0; bottom: 0;
    z-index: 100;
    box-shadow: 2px 0 12px rgba(0,0,0,0.04);
  }
  .logo-area {
    display: flex; align-items: center; gap: 10px;
    padding: 0 22px 28px 22px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 12px;
  }
  .logo-icon {
    width: 46px; height: 46px;
    background: var(--yellow);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
  }
  .logo-text { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 15px; line-height: 1.2; }
  .logo-text span { color: var(--yellow); }
  .nav-link {
    display: flex; align-items: center; gap: 11px;
    padding: 11px 22px;
    color: var(--text-muted);
    font-size: 14px; font-weight: 600;
    cursor: pointer;
    border-left: 3px solid transparent;
    transition: all .18s;
    text-decoration: none;
  }
  .nav-link:hover { color: var(--text); background: var(--yellow-light); }
  .nav-link.active { color: var(--text); border-left: 3px solid var(--yellow); background: var(--yellow-light); }
  .nav-link svg { flex-shrink: 0; }
  .nav-sair { margin-top: auto; }

  /* MAIN */
  .main { margin-left: var(--sidebar-width); flex: 1; min-height: 100vh; }

  /* TOPBAR */
  .topbar {
    background: var(--card);
    border-bottom: 1px solid var(--border);
    padding: 14px 32px;
    display: flex; align-items: center; gap: 16px;
    position: sticky; top: 0; z-index: 50;
  }
  .search-bar {
    flex: 1; max-width: 340px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 10px;
    display: flex; align-items: center; gap: 8px;
    padding: 8px 14px;
  }
  .search-bar input { border: none; background: none; outline: none; font-family: 'Nunito', sans-serif; font-size: 13px; width: 100%; }
  .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 14px; }
  .topbar-icon { font-size: 20px; color: var(--text-muted); cursor: pointer; }
  .user-chip {
    display: flex; align-items: center; gap: 8px;
    background: var(--bg); border-radius: 40px;
    padding: 5px 14px 5px 5px;
    cursor: pointer;
  }
  .user-avatar {
    width: 32px; height: 32px; border-radius: 50%;
    background: var(--yellow);
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
  }
  .user-name { font-size: 13px; font-weight: 700; }
  .user-role { font-size: 11px; color: var(--text-muted); }

  /* PAGES */
  .page { display: none; padding: 32px; }
  .page.active { display: block; }

  /* DASHBOARD */
  .page-title { font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 700; }
  .page-subtitle { font-size: 13px; color: var(--text-muted); margin-top: 2px; }
  .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-top: 24px; }
  .stat-card {
    background: var(--card); border-radius: var(--radius); padding: 20px 22px;
    display: flex; align-items: center; justify-content: space-between;
    box-shadow: var(--shadow);
  }
  .stat-label { font-size: 12px; color: var(--text-muted); font-weight: 600; }
  .stat-value { font-size: 26px; font-weight: 800; margin-top: 4px; }
  .stat-icon {
    width: 46px; height: 46px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
  }
  .stat-icon.yellow { background: var(--yellow-light); }
  .stat-icon.green  { background: var(--green-light); }
  .stat-icon.blue   { background: var(--blue-light); }
  .stat-icon.red    { background: var(--red-light); }

  /* CHART */
  .chart-card {
    background: var(--card); border-radius: var(--radius);
    padding: 24px; margin-top: 24px;
    box-shadow: var(--shadow);
  }
  .chart-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
  .chart-title { font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; }
  .select-mini {
    background: var(--bg); border: 1px solid var(--border);
    border-radius: 8px; padding: 5px 12px;
    font-family: 'Nunito', sans-serif; font-size: 13px; color: var(--text);
    cursor: pointer; outline: none;
  }
  .chart-area { position: relative; height: 200px; }
  svg.chart-svg { width: 100%; height: 100%; }

  /* SALES TABLE */
  .table-card {
    background: var(--card); border-radius: var(--radius);
    padding: 24px; margin-top: 24px;
    box-shadow: var(--shadow);
  }
  .table-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
  table { width: 100%; border-collapse: collapse; }
  th { font-size: 12px; color: var(--text-muted); font-weight: 700; text-align: left; padding: 8px 12px; background: var(--bg); }
  td { font-size: 13px; padding: 11px 12px; border-bottom: 1px solid var(--border); }
  tr:last-child td { border-bottom: none; }
  .badge {
    display: inline-block; padding: 4px 14px;
    border-radius: 20px; font-size: 12px; font-weight: 700;
  }
  .badge-green { background: var(--green); color: #fff; }
  .badge-yellow { background: var(--yellow); color: #333; }
  .badge-red { background: var(--red); color: #fff; }

  /* PRODUTOS */
  .prod-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-top: 24px; max-width: 420px; }
  .prod-stat-card {
    background: var(--card); border-radius: var(--radius);
    padding: 20px 22px; display: flex; align-items: center;
    justify-content: space-between; box-shadow: var(--shadow);
  }
  .prod-hero {
    position: absolute; right: 40px; top: 80px;
    width: 120px; height: 120px; border-radius: 50%;
    background: var(--yellow); overflow: hidden;
    display: flex; align-items: center; justify-content: center;
  }
  .prod-hero img { width: 100%; height: 100%; object-fit: cover; }
  .section-title { font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; margin-top: 28px; }
  .add-link { color: var(--yellow); font-size: 13px; font-weight: 700; cursor: pointer; text-decoration: none; margin-top: 4px; display: inline-block; }
  .products-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 16px; }
  .product-card {
    background: var(--card); border-radius: var(--radius);
    padding: 16px; box-shadow: var(--shadow); position: relative;
  }
  .product-img-wrap {
    background: var(--bg); border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    height: 160px; overflow: hidden; position: relative;
  }
  .product-img-wrap img { max-height: 140px; object-fit: contain; }
  .prod-nav-btn {
    position: absolute; top: 50%; transform: translateY(-50%);
    width: 28px; height: 28px; border-radius: 50%;
    background: rgba(255,255,255,0.9); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 14px; color: var(--text-muted);
    z-index: 2;
  }
  .prod-nav-btn.left { left: 6px; }
  .prod-nav-btn.right { right: 6px; }
  .product-name { font-size: 14px; font-weight: 700; margin-top: 12px; }
  .product-price { color: var(--yellow-hover); font-weight: 800; font-size: 15px; margin-top: 3px; }
  .product-stars { color: var(--yellow); font-size: 13px; margin-top: 2px; }
  .product-stars span { color: var(--text-muted); font-size: 11px; }
  .product-cat { font-size: 11px; color: var(--text-muted); margin-top: 4px; }
  .product-cat b { font-weight: 700; color: var(--text-muted); }
  .product-actions { display: flex; gap: 8px; margin-top: 10px; }
  .prod-btn { border: none; background: none; cursor: pointer; font-size: 18px; padding: 4px; border-radius: 8px; transition: background .15s; }
  .prod-btn:hover { background: var(--bg); }
  .pagination { display: flex; align-items: center; justify-content: space-between; margin-top: 24px; }
  .pag-btn {
    background: var(--yellow); color: #333; font-weight: 700;
    border: none; border-radius: 10px; padding: 8px 22px;
    cursor: pointer; font-family: 'Nunito', sans-serif; font-size: 13px;
    transition: background .15s;
  }
  .pag-btn:hover { background: var(--yellow-hover); }
  .pag-nums { display: flex; gap: 8px; }
  .pag-num {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700; cursor: pointer;
    background: var(--yellow); color: #333;
    border: none;
  }
  .admin-product-create {
    display: grid;
    grid-template-columns: minmax(280px, 440px) minmax(280px, 340px);
    align-items: start;
    justify-content: space-between;
    gap: clamp(36px, 7vw, 96px);
    margin-top: 58px;
  }
  .admin-product-form { display: flex; flex-direction: column; gap: 24px; }
  .admin-field { position: relative; display: block; }
  .admin-field span {
    position: absolute; top: -10px; left: 10px; z-index: 2;
    max-width: calc(100% - 22px);
    padding: 3px 12px; border-radius: 5px;
    background: #dfe8f1; color: #4f5b6c;
    font-size: 11px; font-weight: 800; line-height: 1;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
  }
  .admin-field input,
  .admin-field textarea {
    width: 100%; min-height: 44px;
    border: 0; border-radius: 9px;
    padding: 13px 14px 9px;
    background: #edf3f9; color: var(--text);
    box-shadow: 0 7px 14px rgba(34, 42, 54, 0.14);
    font-family: 'Nunito', sans-serif; font-size: 14px;
    outline: none; transition: background .16s, box-shadow .16s;
  }
  .admin-field textarea { resize: vertical; }
  .admin-field input:focus,
  .admin-field textarea:focus {
    background: #fff;
    box-shadow: 0 0 0 3px rgba(245, 197, 24, 0.28), 0 7px 14px rgba(34, 42, 54, 0.12);
  }
  .admin-field-file input { color: transparent; cursor: pointer; }
  .admin-field-file input::file-selector-button {
    border: 0; border-radius: 7px; padding: 7px 12px; margin-right: 10px;
    color: #fff; background: var(--green);
    font-family: 'Nunito', sans-serif; font-weight: 800; cursor: pointer;
  }
  .admin-product-actions {
    display: flex; align-items: center; justify-content: space-between;
    gap: 18px; margin-top: 4px;
  }
  .admin-save-btn {
    min-width: 142px; border: 0; border-radius: 10px;
    padding: 12px 20px; color: #fff; background: var(--green);
    font-family: 'Nunito', sans-serif; font-size: 13px; font-weight: 800;
    cursor: pointer; transition: transform .16s, background .16s;
  }
  .admin-save-btn:hover { background: #3f9442; transform: translateY(-1px); }
  .admin-back-link {
    color: var(--yellow-hover); font-size: 12px; font-weight: 800;
    text-decoration: underline; text-underline-offset: 2px;
  }
  .admin-product-preview {
    overflow: hidden; border-radius: 12px;
    background: #fff; box-shadow: 0 18px 38px rgba(39, 49, 64, 0.07);
  }
  .admin-preview-image {
    display: grid; grid-template-columns: 36px 1fr 36px; align-items: center;
    min-height: 250px; padding: 22px 12px 18px; background: #fff;
  }
  .admin-preview-image img {
    width: min(100%, 190px); height: 190px;
    justify-self: center; object-fit: contain;
  }
  .admin-preview-image button {
    width: 30px; height: 30px; border: 0; border-radius: 50%;
    color: #7c8795; background: #eef4fa;
    font-size: 24px; line-height: 1; cursor: pointer;
  }
  .admin-preview-info { padding: 22px 24px 26px; background: #fbfbfc; }
  .admin-preview-info h3 {
    font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 1.25;
    font-weight: 800; color: var(--text);
  }
  .admin-preview-info strong {
    display: block; margin-top: 7px;
    color: #65aec7; font-size: 14px; font-weight: 800;
  }
  .admin-preview-stars { margin-top: 8px; color: #f6a525; font-size: 13px; }
  .admin-preview-stars span { color: var(--text-muted); font-size: 11px; }
  .admin-preview-info small {
    display: block; margin-top: 12px;
    color: var(--text-muted); font-size: 10px; font-weight: 800;
  }
  .admin-preview-info p { color: var(--text); font-size: 12px; font-weight: 800; }
  .admin-products-header {
    display: flex; justify-content: space-between; align-items: end;
    gap: 18px; margin-top: 34px;
  }
  .empty-products {
    margin-top: 16px; padding: 18px 0;
    color: var(--text-muted); font-size: 13px; font-weight: 700;
  }
  @media (max-width: 980px) {
    .admin-product-create { grid-template-columns: 1fr; }
    .admin-product-preview { max-width: 360px; }
    .products-grid { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 640px) {
    .prod-stats, .products-grid { grid-template-columns: 1fr; }
    .admin-product-actions { align-items: flex-start; flex-direction: column; }
  }

  /* CHECKOUT PAGE (public nav) */
  .checkout-page { display: none; flex-direction: column; min-height: 100vh; background: #fff; }
  .checkout-page.active { display: flex; }
  .pub-nav {
    background: #fff; border-bottom: 1px solid var(--border);
    padding: 14px 40px; display: flex; align-items: center; gap: 32px;
  }
  .pub-nav-links { display: flex; gap: 24px; }
  .pub-nav-link { font-size: 14px; font-weight: 600; color: var(--text); text-decoration: none; cursor: pointer; }
  .pub-nav-link:hover { color: var(--yellow-hover); }
  .pub-search {
    margin-left: auto; background: var(--bg);
    border: 1px solid var(--border); border-radius: 10px;
    display: flex; align-items: center; gap: 8px; padding: 7px 14px;
  }
  .pub-search input { border: none; background: none; outline: none; font-size: 13px; }
  .checkout-body { flex: 1; padding: 40px 60px; display: flex; gap: 60px; position: relative; }
  .checkout-left { flex: 1; }
  .checkout-page-title { font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 700; }
  .checkout-page-sub { font-size: 13px; color: var(--text-muted); margin-top: 2px; }
  .order-items { margin-top: 28px; display: flex; flex-direction: column; gap: 16px; }
  .order-item { display: flex; align-items: center; gap: 16px; }
  .order-item-img {
    width: 64px; height: 64px; border-radius: 12px;
    background: var(--bg); display: flex; align-items: center; justify-content: center;
    overflow: hidden; flex-shrink: 0;
  }
  .order-item-img img { max-height: 54px; object-fit: contain; }
  .order-item-name { font-size: 13px; font-weight: 700; }
  .order-item-desc { font-size: 12px; color: var(--text-muted); }
  .order-item-price { font-size: 13px; font-weight: 700; color: var(--yellow-hover); }
  .checkout-right { width: 280px; }
  .order-summary { background: var(--bg); border-radius: var(--radius); padding: 24px; }
  .summary-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
  .summary-label { font-size: 14px; color: var(--text); }
  .summary-value { font-size: 14px; font-weight: 700; }
  .summary-free { color: var(--green); font-size: 13px; font-weight: 700; }
  .summary-total .summary-label { font-size: 15px; font-weight: 800; }
  .summary-total .summary-value { font-size: 16px; color: var(--yellow-hover); }
  .payment-section { margin-top: 20px; }
  .payment-option {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 0; cursor: pointer; font-size: 14px; font-weight: 600;
  }
  .radio-circle {
    width: 20px; height: 20px; border-radius: 50%;
    border: 2px solid var(--border); background: #fff;
    display: flex; align-items: center; justify-content: center;
    transition: border-color .15s;
    flex-shrink: 0;
  }
  .radio-circle.selected { border-color: var(--yellow); }
  .radio-dot { width: 10px; height: 10px; border-radius: 50%; background: var(--yellow); }
  .btn-checkout {
    width: 100%; margin-top: 20px;
    background: var(--yellow); border: none;
    border-radius: 12px; padding: 14px;
    font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 700;
    cursor: pointer; transition: background .15s;
    color: #222;
  }
  .btn-checkout:hover { background: var(--yellow-hover); }
  .checkout-cat-img {
    position: absolute; right: 40px; bottom: 80px;
    width: 180px; pointer-events: none;
  }
  .checkout-footer {
    background: #222; color: #fff; padding: 28px 60px;
    display: flex; align-items: flex-start; gap: 40px;
    flex-wrap: wrap;
  }
  .footer-logo { display: flex; align-items: center; gap: 10px; }
  .footer-logo-icon {
    width: 40px; height: 40px; background: var(--yellow);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 18px;
  }
  .footer-tagline { font-size: 11px; color: #aaa; margin-top: 6px; }
  .footer-social { display: flex; gap: 10px; margin-top: 8px; }
  .footer-social-icon {
    width: 28px; height: 28px; border-radius: 8px;
    background: rgba(255,255,255,0.1);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; cursor: pointer;
  }
  .footer-col h5 { font-size: 13px; font-weight: 700; margin-bottom: 8px; }
  .footer-col p { font-size: 12px; color: #aaa; line-height: 1.8; }
  .footer-payments { margin-left: auto; display: flex; align-items: center; gap: 10px; margin-top: 8px; }
  .footer-pay-badge {
    background: rgba(255,255,255,0.1); border-radius: 6px;
    padding: 4px 10px; font-size: 11px; font-weight: 700; color: #fff;
  }
  .footer-bottom { text-align: center; font-size: 11px; color: #aaa; margin-top: 8px; padding-top: 8px; border-top: 1px solid #333; }
  .paw-deco {
    position: absolute; right: 60px; top: 20px;
    font-size: 36px; opacity: 0.1; pointer-events: none;
  }

  /* CHECKOUT BONE DECO */
  .bone-deco {
    position: absolute; left: 20px; bottom: 60px;
    font-size: 40px; opacity: 0.15; pointer-events: none; transform: rotate(-20deg);
  }
</style>
</head>
<body>

<!-- SIDEBAR (for admin pages) -->
<div class="sidebar" id="sidebar">
  <div class="logo-area">
   
        <img src="{{ asset('assets/img/logo.svg') }}" alt="logo">
  </div>
  <a class="nav-link active" id="nav-dashboard" onclick="showPage('dashboard')">
    <svg width="17" height="17" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="2" fill="currentColor"/><rect x="14" y="3" width="7" height="7" rx="2" fill="currentColor"/><rect x="3" y="14" width="7" height="7" rx="2" fill="currentColor"/><rect x="14" y="14" width="7" height="7" rx="2" fill="currentColor"/></svg>
    Dashboard
  </a>
  <a class="nav-link" id="nav-conta" onclick="showPage('conta')">
    <svg width="17" height="17" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2"/><path d="M4 20c0-4 3.582-7 8-7s8 3 8 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    Minha conta
  </a>
  <a class="nav-link" id="nav-produtos" onclick="showPage('produtos')">
    <svg width="17" height="17" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="8" height="8" rx="2" stroke="currentColor" stroke-width="2"/><rect x="13" y="3" width="8" height="8" rx="2" stroke="currentColor" stroke-width="2"/><rect x="3" y="13" width="8" height="8" rx="2" stroke="currentColor" stroke-width="2"/><rect x="13" y="13" width="8" height="8" rx="2" stroke="currentColor" stroke-width="2"/></svg>
    Produtos cadastrados
  </a>
  <a class="nav-link" id="nav-notif" onclick="showPage('notif')">
    <svg width="17" height="17" fill="none" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a1 1 0 10-2 0v1.083A6 6 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    Notificação
  </a>
  <a class="nav-link" id="nav-senha" onclick="showPage('senha')">
    <svg width="17" height="17" fill="none" viewBox="0 0 24 24"><rect x="5" y="11" width="14" height="10" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 11V7a4 4 0 018 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    Alterar senha
  </a>
  <a class="nav-link" id="nav-fale" onclick="showPage('fale')">
    <svg width="17" height="17" fill="none" viewBox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    Fale conosco
  </a>
  <a class="nav-link nav-sair" id="nav-checkout" onclick="showPage('checkout')">
    <svg width="17" height="17" fill="none" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    Ver Checkout
  </a>
</div>

<!-- ADMIN MAIN -->
<div class="main" id="admin-main">
  <!-- TOPBAR -->
  <div class="topbar">
    <div class="search-bar">
      <svg width="15" height="15" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="#aaa" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="#aaa" stroke-width="2" stroke-linecap="round"/></svg>
      <input placeholder="Pesquisar..." />
    </div>
    <div class="topbar-right">
      <span class="topbar-icon">
        <a href="">
            <img src="{{ asset('assets/icon/notificação.svg') }}" alt="notificacao">
        </a>
      </span>
      <div class="user-chip">
        <div class="user-avatar">🐾</div>
        <div>
          <div class="user-name">{{ auth()->user()->name }}!</div>
          <div class="user-role">Adm</div>
        </div>
      </div>
    </div>
  </div>

  <!-- DASHBOARD PAGE -->
  <div class="page active" id="page-dashboard">
    <div class="page-title">Olá<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
    </body>
    </html>, Adm! 👋‹</div>
    <div class="page-subtitle">Aqui você tem os insights gerais do seu Pet Shop!</div>
    <div class="stats-row">
      <div class="stat-card">
        <div>
          <div class="stat-label">Total de clientes</div>
          <div class="stat-value">{{ $usersCount }}</div>
        </div>
        <div class="stat-icon blue">👤</div>
      </div>
      <div class="stat-card">
        <div>
          <div class="stat-label">Total de pedidos</div>
          <div class="stat-value">10293</div>
        </div>
        <div class="stat-icon yellow">📦</div>
      </div>
      <div class="stat-card">
        <div>
          <div class="stat-label">Vendas totais</div>
          <div class="stat-value">$89,000</div>
        </div>
        <div class="stat-icon green">📈</div>
      </div>
      <div class="stat-card">
        <div>
          <div class="stat-label">Pedidos pendentes</div>
          <div class="stat-value">2040</div>
        </div>
        <div class="stat-icon red">🕐</div>
      </div>
    </div>

    <!-- CHART -->
    <div class="chart-card">
      <div class="chart-header">
        <span class="chart-title">Detalhe de vendas</span>
        <select class="select-mini"><option>Outubro</option><option>Setembro</option><option>Agosto</option></select>
      </div>
      <div class="chart-area">
        <svg class="chart-svg" viewBox="0 0 900 200" preserveAspectRatio="none" id="sales-chart">
          <defs>
            <linearGradient id="chartGrad" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#F5C518" stop-opacity="0.5"/>
              <stop offset="100%" stop-color="#F5C518" stop-opacity="0.05"/>
            </linearGradient>
          </defs>
          <!-- Area fill -->
          <path id="chart-area-fill" fill="url(#chartGrad)"/>
          <!-- Line -->
          <path id="chart-line" fill="none" stroke="#F5C518" stroke-width="2.5" stroke-linejoin="round"/>
          <!-- Dots -->
          <g id="chart-dots"></g>
          <!-- Tooltip -->
          <g id="chart-tooltip" style="display:none">
            <rect id="tt-bg" rx="6" fill="#F5C518"/>
            <text id="tt-text" fill="#333" font-size="11" font-family="Nunito" font-weight="800"/>
          </g>
        </svg>
      </div>
    </div>

    <!-- SALES TABLE -->
    <div class="table-card">
      <div class="table-header">
        <span class="chart-title">Últimas vendas</span>
        <select class="select-mini"><option>Outubro</option><option>Setembro</option></select>
      </div>
      <table>
        <thead>
          <tr>
            <th>Produto</th>
            <th>Local de entrega</th>
            <th>Data - Hora</th>
            <th>Pedido</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div style="width:36px;height:36px;background:var(--bg);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:20px">🐾</div><span>Ração Fórmula</span></div></td>
            <td>Rua Amcaps I, N890</td>
            <td>11.09.2026 – 09:22</td>
            <td>423</td>
            <td>R$149,90</td>
            <td><span class="badge badge-green">Entregue</span></td>
          </tr>
          <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div style="width:36px;height:36px;background:var(--bg);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:20px">🐕</div><span>Coleira Premium</span></div></td>
            <td>Av. Paulista, 1578</td>
            <td>11.09.2026 – 09:22</td>
            <td>422</td>
            <td>R$89,90</td>
            <td><span class="badge badge-yellow">Em trânsito</span></td>
          </tr>
          <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div style="width:36px;height:36px;background:var(--bg);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:20px">🐱</div><span>Areia SanitÃ¡ria</span></div></td>
            <td>Rua das Flores, 220</td>
            <td>11.09.2026 – 09:22</td>   
            <td>421</td>
            <td>R$34,90</td>
            <td><span class="badge badge-green">Entregue</span></td>
          </tr>
          <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div style="width:36px;height:36px;background:var(--bg);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:20px">🦴</div><span>Petiscos Golden</span></div></td>
            <td>Rua XV de Nov., 90</td>
            <td>11.09.2026 – 09:22</td>
            <td>420</td>
            <td>R$24,90</td>
            <td><span class="badge badge-red">Pendente</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

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
  <!-- Placeholder pages -->
  <div class="page" id="page-conta">
    <div class="page-title">Minha conta</div>
    <div class="page-subtitle">Gerencie suas informações pessoais.</div>
    <div style="margin-top:32px;background:var(--card);border-radius:var(--radius);padding:32px;box-shadow:var(--shadow);max-width:480px">
      <div style="font-size:14px;color:var(--text-muted)">Nome: <b style="color:var(--text)">Anny</b></div>
      <div style="font-size:14px;color:var(--text-muted);margin-top:12px">E-mail: <b style="color:var(--text)">anny@encantopet.com.br</b></div>
      <div style="font-size:14px;color:var(--text-muted);margin-top:12px">Função: <b style="color:var(--text)">Administrador</b></div>
    </div>
  </div>
  <div class="page" id="page-notif">
    <div class="page-title">Notificações</div>
    <div class="page-subtitle">Fique por dentro de tudo que acontece.</div>
    <div style="margin-top:32px;background:var(--card);border-radius:var(--radius);padding:24px;box-shadow:var(--shadow)">
      <div style="display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid var(--border)"><span style="font-size:20px">📦</span><div><div style="font-weight:700;font-size:13px">Novo pedido recebido #423</div><div style="font-size:12px;color:var(--text-muted)">há 2 minutos</div></div></div>
      <div style="display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid var(--border)"><span style="font-size:20px">💬</span><div><div style="font-weight:700;font-size:13px">Nova mensagem de cliente</div><div style="font-size:12px;color:var(--text-muted)">há 1 hora</div></div></div>
      <div style="display:flex;align-items:center;gap:12px;padding:12px 0"><span style="font-size:20px">⚠️</span><div><div style="font-weight:700;font-size:13px">Estoque baixo: Areia Sanitária</div><div style="font-size:12px;color:var(--text-muted)">há 3 horas</div></div></div>
    </div>
  </div>
  <div class="page" id="page-senha">
    <div class="page-title">Alterar senha</div>
    <div class="page-subtitle">Por segurança, altere sua senha regularmente.</div>
    <div style="margin-top:32px;background:var(--card);border-radius:var(--radius);padding:32px;box-shadow:var(--shadow);max-width:400px;display:flex;flex-direction:column;gap:16px">
      <div><label style="font-size:13px;font-weight:700;display:block;margin-bottom:6px">Senha atual</label><input type="password" style="width:100%;border:1px solid var(--border);border-radius:10px;padding:10px 14px;font-family:Nunito,sans-serif;font-size:14px;outline:none" placeholder="••••••••"/></div>
      <div><label style="font-size:13px;font-weight:700;display:block;margin-bottom:6px">Nova senha</label><input type="password" style="width:100%;border:1px solid var(--border);border-radius:10px;padding:10px 14px;font-family:Nunito,sans-serif;font-size:14px;outline:none" placeholder="••••••••"/></div>
      <div><label style="font-size:13px;font-weight:700;display:block;margin-bottom:6px">Confirmar nova senha</label><input type="password" style="width:100%;border:1px solid var(--border);border-radius:10px;padding:10px 14px;font-family:Nunito,sans-serif;font-size:14px;outline:none" placeholder="••••••••"/></div>
      <button style="background:var(--yellow);border:none;border-radius:10px;padding:12px;font-family:Poppins,sans-serif;font-weight:700;font-size:14px;cursor:pointer">Salvar senha</button>
    </div>
  </div>
  <div class="page" id="page-fale">
    <div class="page-title">Fale conosco</div>
    <div class="page-subtitle">Entre em contato com nossa equipe de suporte.</div>
    <div style="margin-top:32px;background:var(--card);border-radius:var(--radius);padding:32px;box-shadow:var(--shadow);max-width:480px;display:flex;flex-direction:column;gap:16px">
      <div><label style="font-size:13px;font-weight:700;display:block;margin-bottom:6px">Assunto</label><input type="text" style="width:100%;border:1px solid var(--border);border-radius:10px;padding:10px 14px;font-family:Nunito,sans-serif;font-size:14px;outline:none" placeholder="Como podemos ajudar?"/></div>
      <div><label style="font-size:13px;font-weight:700;display:block;margin-bottom:6px">Mensagem</label><textarea rows="5" style="width:100%;border:1px solid var(--border);border-radius:10px;padding:10px 14px;font-family:Nunito,sans-serif;font-size:14px;outline:none;resize:vertical" placeholder="Descreva sua dÃºvida ou problema..."></textarea></div>
      <button style="background:var(--yellow);border:none;border-radius:10px;padding:12px;font-family:Poppins,sans-serif;font-weight:700;font-size:14px;cursor:pointer">Enviar mensagem</button>
    </div>
  </div>
</div>

<!-- CHECKOUT PAGE (full page, separate) -->
<div class="checkout-page" id="page-checkout">
  <nav class="pub-nav">
    <div class="logo-area" style="padding:0;border:none;margin:0">
      <div class="logo-icon" style="width:38px;height:38px;font-size:18px">ðŸ¾</div>
      <div class="logo-text" style="font-size:13px">ENCANTO <span>PET</span></div>
    </div>
    <div class="pub-nav-links">
      <a class="pub-nav-link">Produtos</a>
      <a class="pub-nav-link">Cachorros</a>
      <a class="pub-nav-link">Gatos</a>
      <a class="pub-nav-link">PromoÃ§Ãµes</a>
      <a class="pub-nav-link">Adote aqui!</a>
      <a class="pub-nav-link">Nosso contato</a>
    </div>
    <div class="pub-search">
      <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="#aaa" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="#aaa" stroke-width="2" stroke-linecap="round"/></svg>
      <input placeholder="Pesquisar produto..." />
    </div>
    <div style="display:flex;gap:12px;margin-left:16px">
      <span style="font-size:18px;cursor:pointer">ðŸ””</span>
      <span style="font-size:18px;cursor:pointer">ðŸ‘¤</span>
      <span style="font-size:18px;cursor:pointer">âš™ï¸</span>
    </div>
  </nav>

  <div class="checkout-body">
    <span class="bone-deco">ðŸ¦´</span>
    <div class="checkout-left">
      <div class="checkout-page-title">Seu pet autorizou esse pagamento :)</div>
      <div class="checkout-page-sub">Selecione o mÃ©todo de pagamento</div>
      <div class="order-items">
        <div class="order-item">
          <div class="order-item-img"><span style="font-size:36px">ðŸ›ï¸</span></div>
          <div style="flex:1">
            <div class="order-item-name">Golden Mini Bits Porte Pequeno</div>
            <div class="order-item-desc">Frango com arroz â€“ 10,1kg</div>
            <div class="order-item-price">R$ 150,00</div>
          </div>
        </div>
        <div class="order-item">
          <div class="order-item-img"><span style="font-size:36px">ðŸ›ï¸</span></div>
          <div style="flex:1">
            <div class="order-item-name">Life Super Premium CÃ£es Adultos</div>
            <div class="order-item-desc">Frango e LinhaÃ§a â€“ 1,0kg</div>
            <div class="order-item-price">R$ 150,00</div>
          </div>
        </div>
        <div class="order-item">
          <div class="order-item-img"><span style="font-size:36px">ðŸ›ï¸</span></div>
          <div style="flex:1">
            <div class="order-item-name">Golden Mini Bits Porte Pequeno</div>
            <div class="order-item-desc">Frango com arroz â€“ 10,1kg</div>
            <div class="order-item-price">R$ 150,00</div>
          </div>
        </div>
        <div class="order-item">
          <div class="order-item-img"><span style="font-size:36px">ðŸ›ï¸</span></div>
          <div style="flex:1">
            <div class="order-item-name">Life Super Premium CÃ£es Adultos</div>
            <div class="order-item-desc">Frango e LinhaÃ§a â€“ 1,0kg</div>
            <div class="order-item-price">R$ 150,00</div>
          </div>
        </div>
      </div>
    </div>

    <div class="checkout-right">
      <div class="order-summary">
        <div class="summary-row">
          <span class="summary-label">Subtotal:</span>
          <span class="summary-value">$1750</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Taxas</span>
          <span class="summary-free">Frete GrÃ¡tis</span>
        </div>
        <hr style="border:none;border-top:1px solid var(--border);margin-bottom:12px">
        <div class="summary-row summary-total">
          <span class="summary-label">Total:</span>
          <span class="summary-value">$1750</span>
        </div>
      </div>

      <div class="payment-section">
        <div class="payment-option" onclick="selectPayment(this)">
          <div class="radio-circle selected"><div class="radio-dot"></div></div>
          CartÃ£o De CrÃ©dito
        </div>
        <div class="payment-option" onclick="selectPayment(this)">
          <div class="radio-circle"></div>
          CartÃ£o De DÃ©bito
        </div>
        <div class="payment-option" onclick="selectPayment(this)">
          <div class="radio-circle"></div>
          Pix
        </div>
      </div>

      <button class="btn-checkout" onclick="alert('Pagamento finalizado! ðŸ¾')">Finalizar pagamento!</button>
    </div>

    <!-- Cat decoration -->
    <div style="position:absolute;right:0;bottom:0;width:200px;pointer-events:none;font-size:120px;line-height:1;opacity:0.9">ðŸ±</div>
    <div style="position:absolute;right:20px;top:10px;font-size:28px;opacity:0.1">ðŸ¾ ðŸ¾</div>
  </div>

  <!-- Back button -->
  <div style="padding:10px 60px;background:#fff">
    <a onclick="showPage('dashboard')" style="color:var(--yellow-hover);font-weight:700;cursor:pointer;font-size:13px">â† Voltar ao admin</a>
  </div>

  <footer class="checkout-footer">
    <div>
      <div class="footer-logo">
        <div class="footer-logo-icon">ðŸ¾</div>
        <div class="logo-text">ENCANTO <span style="color:var(--yellow)">PET</span></div>
      </div>
      <div class="footer-tagline">Obrigado pela visita. Seu pet provavelmente<br>jÃ¡ estÃ¡ escolhendo a prÃ³xima compra.</div>
      <div class="footer-social">
        <div class="footer-social-icon">ðŸ“¸</div>
        <div class="footer-social-icon">ðŸ¦</div>
        <div class="footer-social-icon">ðŸ’¬</div>
      </div>
    </div>
    <div class="footer-col">
      <h5>Adote Aqui ðŸ¾</h5>
      <p>Vu.Sellie<br>Giwa Bester<br>Oliwia Szal</p>
    </div>
    <div class="footer-col">
      <h5>Contatos ðŸ“ž</h5>
      <p>+55 0 9026-9625<br>0 487-041</p>
    </div>
    <div class="footer-col">
      <h5>EndereÃ§o ðŸ“</h5>
      <p>Rua de Fapoterro, 256 â€“ Baixa dos<br>Apartamentos Compusdas â€“ Ed. Brito</p>
    </div>
    <div style="margin-left:auto;display:flex;flex-direction:column;justify-content:flex-end">
      <div class="footer-payments">
        <div class="footer-pay-badge">VISA</div>
        <div class="footer-pay-badge">MC</div>
        <div class="footer-pay-badge">PayPal</div>
      </div>
      <div class="footer-bottom">Â© Copyright Encanto Pet 2026</div>
    </div>
  </footer>
</div>

<script>
// --- NAV ---
function showPage(page) {
  // Admin pages
  const adminPages = ['dashboard','conta','produtos','notif','senha','fale'];
  const allAdminPages = document.querySelectorAll('.main .page');
  const sidebar = document.getElementById('sidebar');
  const adminMain = document.getElementById('admin-main');
  const checkoutPage = document.getElementById('page-checkout');

  if (page === 'checkout') {
    adminMain.style.display = 'none';
    sidebar.style.display = 'none';
    checkoutPage.classList.add('active');
    return;
  }

  adminMain.style.display = 'block';
  sidebar.style.display = 'flex';
  checkoutPage.classList.remove('active');

  allAdminPages.forEach(p => p.classList.remove('active'));
  const target = document.getElementById('page-' + page);
  if (target) target.classList.add('active');

  document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
  const navEl = document.getElementById('nav-' + page);
  if (navEl) navEl.classList.add('active');
}

const initialSection = new URLSearchParams(window.location.search).get('section');
if (initialSection === 'produtos') {
  showPage('produtos');
}

// --- CHART ---
(function buildChart() {
  const data = [22, 28, 25, 32, 38, 35, 30, 42, 78, 62, 55, 60, 50, 48, 53, 58, 52, 45, 48, 55, 50, 47, 52, 56, 60, 55, 58, 62, 57, 53];
  const W = 900, H = 200;
  const pad = { t: 20, b: 20, l: 10, r: 10 };
  const w = W - pad.l - pad.r;
  const h = H - pad.t - pad.b;
  const min = Math.min(...data), max = Math.max(...data);
  const xs = data.map((_, i) => pad.l + (i / (data.length - 1)) * w);
  const ys = data.map(v => pad.t + h - ((v - min) / (max - min)) * h);

  let linePath = `M ${xs[0]} ${ys[0]}`;
  for (let i = 1; i < data.length; i++) linePath += ` L ${xs[i]} ${ys[i]}`;

  let areaPath = `M ${xs[0]} ${H} L ${xs[0]} ${ys[0]}`;
  for (let i = 1; i < data.length; i++) areaPath += ` L ${xs[i]} ${ys[i]}`;
  areaPath += ` L ${xs[xs.length-1]} ${H} Z`;

  document.getElementById('chart-line').setAttribute('d', linePath);
  document.getElementById('chart-area-fill').setAttribute('d', areaPath);

  const dotsG = document.getElementById('chart-dots');
  data.forEach((v, i) => {
    const c = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    c.setAttribute('cx', xs[i]);
    c.setAttribute('cy', ys[i]);
    c.setAttribute('r', '4');
    c.setAttribute('fill', '#F5C518');
    c.setAttribute('stroke', '#fff');
    c.setAttribute('stroke-width', '2');
    c.style.cursor = 'pointer';
    c.addEventListener('mouseenter', () => showTooltip(xs[i], ys[i], v));
    c.addEventListener('mouseleave', hideTooltip);
    dotsG.appendChild(c);
  });

  const svg = document.querySelector('.chart-svg');
  svg.addEventListener('mouseleave', hideTooltip);
})();

function showTooltip(x, y, val) {
  const tt = document.getElementById('chart-tooltip');
  const bg = document.getElementById('tt-bg');
  const text = document.getElementById('tt-text');
  const label = '$' + (val * 500).toLocaleString();
  tt.style.display = '';
  text.textContent = label;
  const tw = label.length * 7 + 16;
  bg.setAttribute('x', x - tw/2);
  bg.setAttribute('y', y - 28);
  bg.setAttribute('width', tw);
  bg.setAttribute('height', 20);
  text.setAttribute('x', x - tw/2 + 8);
  text.setAttribute('y', y - 14);
}
function hideTooltip() {
  document.getElementById('chart-tooltip').style.display = 'none';
}

// --- PRODUCT CREATE PREVIEW ---
(function setupAdminProductPreview() {
  const nameInput = document.getElementById('adminProductName');
  const priceInput = document.getElementById('adminProductPrice');
  const categoryInput = document.getElementById('adminProductCategory');
  const imageInput = document.getElementById('adminProductImage');
  const previewName = document.getElementById('adminPreviewName');
  const previewPrice = document.getElementById('adminPreviewPrice');
  const previewCategory = document.getElementById('adminPreviewCategory');
  const previewImage = document.getElementById('adminPreviewImage');

  if (!nameInput || !priceInput || !categoryInput || !imageInput) return;

  function formatPrice(value) {
    const numericValue = Number(value);

    if (!value || Number.isNaN(numericValue)) {
      return 'R$149,00';
    }

    return numericValue.toLocaleString('pt-BR', {
      style: 'currency',
      currency: 'BRL'
    });
  }

  function updatePreview() {
    previewName.textContent = nameInput.value || 'Ração Fórmula Salmão - 10kg';
    previewPrice.textContent = formatPrice(priceInput.value);
    previewCategory.textContent = categoryInput.value || 'Ração de Cachorro';
  }

  [nameInput, priceInput, categoryInput].forEach((field) => {
    field.addEventListener('input', updatePreview);
  });

  imageInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(event) {
      previewImage.src = event.target.result;
    };
    reader.readAsDataURL(file);
  });
})();

// --- PAYMENT SELECTION ---
function selectPayment(el) {
  document.querySelectorAll('.payment-option .radio-circle').forEach(r => {
    r.classList.remove('selected');
    r.innerHTML = '';
  });
  const circle = el.querySelector('.radio-circle');
  circle.classList.add('selected');
  circle.innerHTML = '<div class="radio-dot"></div>';
}
</script>
</body>
</html>

