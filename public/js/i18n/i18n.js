(function () {
    'use strict';

    var STORAGE_KEY  = 'encantoPetLang';
    var DEFAULT_LANG = 'pt_BR';

    function getLang() {
        return localStorage.getItem(STORAGE_KEY) || DEFAULT_LANG;
    }

    function t(key, params) {
        var lang  = getLang();
        var dicts = window.i18nTranslations || {};
        var text  = (dicts[lang] && dicts[lang][key])
                 || (dicts[DEFAULT_LANG] && dicts[DEFAULT_LANG][key])
                 || key;
        if (params) {
            Object.keys(params).forEach(function (k) {
                text = text.split('{' + k + '}').join(String(params[k]));
            });
        }
        return text;
    }

    function paramsFromEl(el) {
        var p = {};
        if (el.dataset.i18nName  !== undefined) p.name  = el.dataset.i18nName;
        if (el.dataset.i18nN     !== undefined) p.n     = el.dataset.i18nN;
        if (el.dataset.i18nPrice !== undefined) p.price = el.dataset.i18nPrice;
        return p;
    }

    function applyTranslations() {
        var lang = getLang();

        // Atualiza o atributo lang do HTML
        document.documentElement.lang = lang === 'pt_BR' ? 'pt-BR' : 'en';

        // Conteúdo de texto / HTML
        document.querySelectorAll('[data-i18n]').forEach(function (el) {
            var translated = t(el.dataset.i18n, paramsFromEl(el));
            if (translated.indexOf('<') !== -1) {
                el.innerHTML = translated;
            } else {
                el.textContent = translated;
            }
        });

        // Placeholders
        document.querySelectorAll('[data-i18n-placeholder]').forEach(function (el) {
            el.placeholder = t(el.dataset.i18nPlaceholder);
        });

        // Aria-labels
        document.querySelectorAll('[data-i18n-aria]').forEach(function (el) {
            el.setAttribute('aria-label', t(el.dataset.i18nAria));
        });

        // Atualiza estado ativo no seletor de idioma
        document.querySelectorAll('.lang-option').forEach(function (btn) {
            btn.classList.toggle('active', btn.dataset.lang === lang);
        });
    }

    // ─── API pública ────────────────────────────────────────────────────────────

    window.setLanguage = function (lang) {
        localStorage.setItem(STORAGE_KEY, lang);
        applyTranslations();
        closeLangMenu();
    };

    window.toggleLangMenu = function (e) {
        e.preventDefault();
        e.stopPropagation();
        document.querySelectorAll('.lang-menu').forEach(function (m) {
            m.classList.toggle('open');
        });
    };

    window.closeLangMenu = function () {
        document.querySelectorAll('.lang-menu').forEach(function (m) {
            m.classList.remove('open');
        });
    };

    window.i18n = { t: t, getLang: getLang };

    // ─── Inicialização ───────────────────────────────────────────────────────────

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', applyTranslations);
    } else {
        applyTranslations();
    }

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.lang-switcher')) {
            closeLangMenu();
        }
    });
})();
