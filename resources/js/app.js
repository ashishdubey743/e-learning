import './bootstrap';
/* There is no built-in way to add a sidebar collapse button in the navbar in Marry UI. This will move the scrollbar
from the sidebar to the navbar.  */
document.addEventListener('livewire:navigated', () => {
    // Get the sidebar toggle element
    const element = document.getElementById('sidebarToggleElement');
    element.classList.add('lg:block');

    // Get the sidebar container element
    const target = document.getElementById('sidebarToggleContainer');

    // Move the element by appending it to the target
    if (element && target) {
        target.appendChild(element);
    }
});
