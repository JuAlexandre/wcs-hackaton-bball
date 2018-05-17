export default class NavBar {
    refreshSidebarActiveLocation() {
        const location = window.location.pathname;
        const tab = document.querySelector(`[data-group="routes"] a[href='${location}']`);
        if (tab === null) return false;
        tab.classList.add('is-active');
        return this;
    }
    
    enableNavbarBurgers() {
        const burgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        if (burgers.length === 0) return false;
        for (let burger of burgers) {
            burger.addEventListener('click', () => {
                const target = document.getElementById(burger.dataset.target);
                burger.classList.toggle('is-active');
                target.classList.toggle('is-active');
            })
        }
        return this;
    }
}