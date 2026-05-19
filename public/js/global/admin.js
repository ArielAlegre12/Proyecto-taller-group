const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(
    toolltipTriggerEl => new bootstrap.Tooltip(toolltipTriggerEl)
);