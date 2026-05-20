import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
document.documentElement.classList.add('js');

const supportedLocales = ['en', 'fr', 'ar'];
const localeSyncKey = 'gare-routiere-locale-sync';
const localeStorageKeys = ['app_locale', 'locale'];

function readStoredLocale() {
    for (const key of localeStorageKeys) {
        try {
            const value = localStorage.getItem(key);
            if (value && supportedLocales.includes(value)) {
                return value;
            }
        } catch (_) {
            return null;
        }
    }

    return null;
}

function writeStoredLocale(locale) {
    try {
        localStorage.setItem('app_locale', locale);
        localStorage.setItem('locale', locale);
    } catch (_) {
        /* ignore */
    }
}

document.addEventListener('alpine:init', () => {
    Alpine.data('siteHeader', (config = {}) => ({
        mobileMenuOpen: false,
        languageOpen: false,
        isHome: Boolean(config.isHome),
        scrolled: !Boolean(config.isHome),
        currentLocale: config.currentLocale ?? document.documentElement.lang ?? 'en',
        locales: config.locales ?? [],
        switchUrlTemplate: config.switchUrlTemplate ?? '/lang/__LOCALE__',

        init() {
            this.syncLocaleFromStorage();
            this.updateScrollState();

            window.addEventListener('scroll', () => this.updateScrollState(), { passive: true });

            this.$watch('mobileMenuOpen', (open) => {
                document.body.classList.toggle('overflow-hidden', open);
            });
        },

        getSwitchUrl(locale) {
            const baseUrl = this.switchUrlTemplate.replace('__LOCALE__', locale);

            return `${baseUrl}?redirect=${encodeURIComponent(window.location.href)}`;
        },

        localeLabel() {
            const activeLocale = this.locales.find((locale) => locale.code === this.currentLocale);

            return activeLocale?.short ?? this.currentLocale.toUpperCase();
        },

        localeFlag() {
            const activeLocale = this.locales.find((locale) => locale.code === this.currentLocale);

            return activeLocale?.flag ?? '';
        },

        switchLocale(locale) {
            if (! supportedLocales.includes(locale)) {
                return;
            }

            writeStoredLocale(locale);
            sessionStorage.setItem(localeSyncKey, `${locale}:${window.location.pathname}${window.location.search}`);
            window.location.assign(this.getSwitchUrl(locale));
        },

        syncLocaleFromStorage() {
            const storedLocale = readStoredLocale();

            if (! storedLocale || ! supportedLocales.includes(storedLocale)) {
                writeStoredLocale(this.currentLocale);
                return;
            }

            if (storedLocale === this.currentLocale) {
                sessionStorage.removeItem(localeSyncKey);
                writeStoredLocale(this.currentLocale);
                return;
            }

            const syncSignature = `${storedLocale}:${window.location.pathname}${window.location.search}`;

            if (sessionStorage.getItem(localeSyncKey) === syncSignature) {
                return;
            }

            sessionStorage.setItem(localeSyncKey, syncSignature);
            window.location.replace(this.getSwitchUrl(storedLocale));
        },

        updateScrollState() {
            this.scrolled = ! this.isHome || window.scrollY > 24;
        },
    }));
});

document.addEventListener('DOMContentLoaded', () => {
    const revealElements = document.querySelectorAll('[data-reveal]');

    if (! revealElements.length) {
        return;
    }

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        revealElements.forEach((element) => {
            element.classList.add('is-visible');
        });

        return;
    }

    const observer = new IntersectionObserver((entries, currentObserver) => {
        entries.forEach((entry) => {
            if (! entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-visible');
            currentObserver.unobserve(entry.target);
        });
    }, {
        threshold: 0.18,
        rootMargin: '0px 0px -10% 0px',
    });

    revealElements.forEach((element, index) => {
        if (! element.dataset.delay) {
            element.style.transitionDelay = `${Math.min(index * 70, 280)}ms`;
        } else {
            element.style.transitionDelay = element.dataset.delay;
        }

        observer.observe(element);
    });
});

Alpine.start();
