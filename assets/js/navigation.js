const shopMenuButtons = document.querySelectorAll('[data-shop-toggle]');
const shopMenuPanel = document.querySelector('[data-shop-panel]');
const shopMenuCloseButton = document.querySelector('[data-shop-close]');
const mobileMenuButton = document.querySelector('[data-mobile-menu-toggle]');
const mobileMenu = document.querySelector('[data-mobile-menu]');
const desktopMediaQuery = window.matchMedia('(min-width: 67.5rem)');

function setShopMenuDisplay(isOpen) {
    if (!shopMenuPanel) {
        return;
    }

    shopMenuPanel.classList.toggle('hidden', !isOpen);
    shopMenuPanel.classList.toggle('block', isOpen && !desktopMediaQuery.matches);
    shopMenuPanel.classList.toggle('grid', isOpen && desktopMediaQuery.matches);
}

function setShopMenuState(isOpen) {
    if (!shopMenuPanel) {
        return;
    }

    setShopMenuDisplay(isOpen);
    document.body.classList.toggle('overflow-hidden', isOpen);

    shopMenuButtons.forEach((button) => {
        button.setAttribute('aria-expanded', String(isOpen));
    });

    if (isOpen) {
        setMobileMenuState(false);
    }
}

function setMobileMenuState(isOpen) {
    if (!mobileMenu || !mobileMenuButton) {
        return;
    }

    mobileMenu.classList.toggle('hidden', !isOpen);
    mobileMenuButton.setAttribute('aria-expanded', String(isOpen));

    if (isOpen) {
        setShopMenuState(false);
    }
}

shopMenuButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const isOpen = button.getAttribute('aria-expanded') === 'true';
        setShopMenuState(!isOpen);
    });
});

shopMenuCloseButton?.addEventListener('click', () => {
    setShopMenuState(false);
});

mobileMenuButton?.addEventListener('click', () => {
    const isOpen = mobileMenuButton.getAttribute('aria-expanded') === 'true';
    setMobileMenuState(!isOpen);
});

document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') {
        return;
    }

    setShopMenuState(false);
    setMobileMenuState(false);
});

desktopMediaQuery.addEventListener('change', () => {
    const isShopMenuOpen = Array.from(shopMenuButtons).some(
        (button) => button.getAttribute('aria-expanded') === 'true'
    );

    if (isShopMenuOpen) {
        setShopMenuDisplay(true);
    }

    if (desktopMediaQuery.matches) {
        setMobileMenuState(false);
    }
});
