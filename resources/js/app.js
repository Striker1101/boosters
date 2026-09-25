import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

/**
 * Copy text to the clipboard, with a fallback for browsers or contexts where
 * the async Clipboard API is unavailable or denied (for example a page served
 * over plain HTTP on a non-localhost host).
 *
 * Returns true when the text made it to the clipboard, false otherwise, so the
 * caller can show the user what actually happened instead of failing silently.
 */
window.copyText = async function (text) {
    const value = String(text ?? '');

    if (!value) {
        return false;
    }

    if (navigator.clipboard && window.isSecureContext) {
        try {
            await navigator.clipboard.writeText(value);
            return true;
        } catch (error) {
            // Fall through to the legacy path below.
        }
    }

    try {
        const scratch = document.createElement('textarea');
        scratch.value = value;
        scratch.setAttribute('readonly', '');
        scratch.style.position = 'fixed';
        scratch.style.top = '-1000px';
        scratch.style.opacity = '0';
        document.body.appendChild(scratch);
        scratch.select();
        scratch.setSelectionRange(0, value.length);
        const copied = document.execCommand('copy');
        document.body.removeChild(scratch);

        return copied;
    } catch (error) {
        return false;
    }
};

/**
 * The behaviour behind <x-copy-button>.
 *
 * The source element is named by a data attribute on the button itself, so the
 * lookup never depends on Alpine's $refs scope (which only sees elements inside
 * the same component subtree).
 */
Alpine.data('copyButton', () => ({
    state: 'idle',
    timer: null,

    resolveText(el) {
        const selector = el?.dataset?.copyTarget;
        const source = selector ? document.querySelector(selector) : null;

        if (!source) {
            return '';
        }

        // Textareas and inputs expose .value; code spans expose .textContent.
        return (source.value ?? source.textContent ?? '').trim();
    },

    async copy(el) {
        const ok = await window.copyText(this.resolveText(el));

        this.state = ok ? 'done' : 'failed';

        clearTimeout(this.timer);
        this.timer = setTimeout(() => {
            this.state = 'idle';
        }, 1800);
    },
}));

Alpine.start();
