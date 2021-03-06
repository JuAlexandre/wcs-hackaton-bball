// Import packages
import babelPolyfill from 'babel-polyfill'
import $ from 'jquery'
import toastr from 'toastr'

// Import ou own JS
import { displayFlashMessages } from './flash-messages'
import NavBar from './navbar'

// Export to window object
window.toastr = toastr;

// When the DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const navBar = new NavBar();
    navBar.refreshSidebarActiveLocation();
    navBar.enableNavbarBurgers();
    displayFlashMessages();
})