<style>
    :root { --yellow:#f6b60b; --green:#65b84a; --red:#ef6b6b; --blue:#7cc7d8; --bg:#f5f6fb; --card:#fff; --text:#272936; --muted:#8a92a3; --line:#edf0f6; --shadow:0 16px 35px rgba(32,45,70,.07); --sidebar:178px; }
    * { box-sizing:border-box; }
    body { margin:0; min-height:100vh; display:flex; color:var(--text); background:var(--bg); font-family:Nunito,sans-serif; }
    a { color:inherit; text-decoration:none; }
    button,input,textarea,select { font:inherit; }
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
    .content { padding:34px clamp(18px,3vw,38px) 46px; }
    .hero-head { display:flex; justify-content:space-between; gap:24px; margin-bottom:26px; }
    .page-title { margin:0; font-size:28px; line-height:1; font-weight:900; }
    .page-subtitle { margin:9px 0 0; color:var(--muted); font-size:12px; font-weight:800; }
    .dog-badge { width:132px; height:132px; border-radius:44% 56% 54% 46%; display:grid; place-items:end center; overflow:hidden; background:var(--yellow); }
    .dog-badge img { width:108px; height:108px; object-fit:contain; }
    .panel { max-width:960px; border-radius:12px; padding:24px; background:#fff; box-shadow:var(--shadow); }
    .panel.wide { max-width:100%; }
    .notice { max-width:960px; margin-bottom:18px; border-radius:10px; padding:12px 16px; color:#2f6c22; background:#dff3d8; font-weight:900; }
    .form-grid { display:grid; gap:18px; }
    .field-row { display:grid; gap:7px; }
    .field-row label { color:#596270; font-size:12px; font-weight:900; }
    .field-row input,.field-row textarea,.field-row select { width:100%; min-height:42px; border:0; border-radius:8px; padding:12px 14px; color:var(--text); background:#eef4fa; box-shadow:0 7px 13px rgba(42,58,78,.12); outline:0; font-size:13px; font-weight:800; }
    .field-row textarea { min-height:150px; resize:vertical; }
    .field-row input:focus,.field-row textarea:focus,.field-row select:focus { background:#fff; box-shadow:0 0 0 3px rgba(246,182,11,.22),0 7px 13px rgba(42,58,78,.14); }
    .error { color:#c73737; font-size:12px; font-weight:900; }
    .actions { display:flex; flex-wrap:wrap; gap:12px; align-items:center; margin-top:6px; }
    .btn { min-height:36px; border:1px solid var(--line); border-radius:8px; display:inline-flex; align-items:center; justify-content:center; gap:7px; padding:8px 13px; color:#303341; background:#fff; font-size:12px; font-weight:900; cursor:pointer; }
    .btn-primary { border-color:var(--yellow); background:var(--yellow); }
    .btn-blue { border-color:#d5edf2; color:#4c9dad; background:#eef8fa; }
    .btn-danger { border-color:#ffd4d8; color:#c73737; background:#fff1f2; }
    .table-wrap { overflow-x:auto; }
    table { width:100%; min-width:780px; border-collapse:separate; border-spacing:0 9px; }
    th { height:36px; padding:0 16px; color:#65707d; background:#eaf3f4; font-size:12px; font-weight:900; text-align:left; }
    th:first-child { border-radius:9px 0 0 9px; }
    th:last-child { border-radius:0 9px 9px 0; }
    td { padding:12px 16px; color:#596270; background:#fff; border-bottom:1px solid #f0f2f6; font-size:12px; font-weight:800; vertical-align:middle; }
    tr.is-new td { background:#fffaf0; }
    .badge { display:inline-flex; align-items:center; min-height:24px; border-radius:999px; padding:4px 12px; font-size:11px; font-weight:900; white-space:nowrap; }
    .badge-new { color:#5c4300; background:#fff0bd; }
    .badge-read { color:#1e6575; background:#e6f4f7; }
    .badge-answered { color:#fff; background:var(--green); }
    .badge-archived { color:#fff; background:var(--red); }
    .filters { display:flex; flex-wrap:wrap; gap:12px; margin-bottom:18px; }
    .filters input,.filters select { min-height:36px; border:0; border-radius:8px; padding:0 12px; background:#eef4fa; font-size:12px; font-weight:800; }
    .message-body { white-space:pre-line; color:#434957; font-weight:800; line-height:1.65; }
    .meta-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:14px; margin-bottom:22px; }
    .meta-card { border-radius:10px; padding:14px; background:#f8fbfd; }
    .meta-card small { display:block; color:var(--muted); font-size:10px; font-weight:900; }
    .meta-card strong { display:block; margin-top:3px; font-size:13px; font-weight:900; overflow-wrap:anywhere; }
    .pagination-links { margin-top:22px; display:flex; justify-content:center; }
    @media (max-width:760px) { body { display:block; } .sidebar { position:static; width:100%; display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:8px 18px; } .logo-area { grid-column:1/-1; margin-bottom:8px; } .logout-form { margin-top:0; } .main { width:100%; margin-left:0; } .topbar { height:auto; padding:14px 18px; flex-wrap:wrap; } .search-bar { width:100%; } .hero-head { flex-direction:column; } .meta-grid { grid-template-columns:1fr; } .panel { padding:16px; } }
</style>
