const shopMenuButtons = document.querySelectorAll('[data-shop-toggle]');
const shopMenuPanel = document.querySelector('[data-shop-panel]');
const shopMenuCloseButton = document.querySelector('[data-shop-close]');
const mobileMenuButton = document.querySelector('[data-mobile-menu-toggle]');
const mobileMenu = document.querySelector('[data-mobile-menu]');

function setShopMenuState(isOpen) {
    if (!shopMenuPanel) {
        return;
    }

    shopMenuPanel.hidden = !isOpen;
    document.body.classList.toggle('navigation-open', isOpen);

    shopMenuButtons.forEach((button) => {
        button.setAttribute('aria-expanded', String(isOpen));
        button.classList.toggle('is-open', isOpen);
    });

    if (isOpen) {
        setMobileMenuState(false);
    }
}

function setMobileMenuState(isOpen) {
    if (!mobileMenu || !mobileMenuButton) {
        return;
    }

    mobileMenu.hidden = !isOpen;
    mobileMenuButton.setAttribute('aria-expanded', String(isOpen));
    mobileMenuButton.classList.toggle('is-open', isOpen);

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

window.matchMedia('(min-width: 1024px)').addEventListener('change', (event) => {
    if (event.matches) {
        setMobileMenuState(false);
    }
});
