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

document.querySelector('g28-selectbox#filter-by-type').addEventListener('change', (e) => {
    let type = e.detail.value;
    if (type === 'All') {
        window.location.href = '/employee/approve';
    } else if (type === 'Laboratory') {
        window.location.href = '/employee/approve?f=lab';
    } else {
        window.location.href = '/employee/approve?f=' + type.toLowerCase();
    }
});