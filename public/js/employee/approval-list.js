document.querySelectorAll('.approval-table tbody tr:not(.empty)').forEach((row) => {
    row.addEventListener('click', (e) => {
        e.stopPropagation();
        if (e.target.tagName === 'TD') {
            let entity = row.getAttribute('data-usr');
            let type = row.getAttribute('data-tp');
            window.location.href = '/employee/approve/' + type + '?et=' + entity;
        }
    });
});