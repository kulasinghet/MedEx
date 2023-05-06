const report_types = ['pharmacy', 'supplier', 'delivery', 'lab'];

// adding simplebar to the report list
new SimpleBar(document.querySelector('.report-list .list-content'));

// manipulating report items
document.querySelectorAll('.report-itm:not(.report-actions)').forEach((itm) => {
    const inner_itm = itm.querySelector('.report-inner');
    const action_btn = itm.querySelector('.report-actions .report-btn');
    let is_active = false;

    inner_itm.addEventListener('click', (e) => {
        e.preventDefault();

        if (e.target.tagName === 'A') {
            // getting a response from the server
            fetch('/employee/reports?et=' + itm.getAttribute('data-id') + '&a=accept')
                .then(r => {
                    window.location.href = r.url;
                });
        }

        if (e.currentTarget === inner_itm && !is_active) {
            // open the report item
            toggleOpen(true);
            is_active = true;
            logger('Active report item: ' + itm.getAttribute('data-id'));
        }
    });

    itm.addEventListener('mouseleave', (e) => {
        e.stopPropagation();

        if (e.currentTarget === itm && is_active) {
            let user_type = '';

            setTimeout(() => {
                // close the report item
                toggleOpen(false);
                is_active = false;
                logger('Closed report item: ' + itm.getAttribute('data-id'));
            }, 1000);

            // getting the user type from the report item
            itm.classList.forEach((cls) => {
                if (report_types.includes(cls)) {
                    user_type = cls;
                    logger('The report[' + user_type + '] is seen by the employee');
                }
            });

            // filtering out seen reports
            if (user_type !== '') {
                // getting a response from the server
                fetch('/employee/reports?et=' + itm.getAttribute('data-id') + '&a=seen')
                    .then(r => r.json())
                    .then(response => {
                        if (response.success) {
                            // Access additional attributes
                            const username = response.username;
                            const inquiryId = response.inquiry_id;
                            logger('Report seen by ' + username + ' for inquiry ID ' + inquiryId + '.');

                            // validating the response with the report item
                            if (inquiryId === itm.getAttribute('data-id')) {
                                // removing the user type class from the report item
                                itm.classList.forEach((cls) => {
                                    if (report_types.includes(cls)) {
                                        itm.classList.remove(cls);
                                    }
                                });
                            }
                        }
                    });
            }

            // set is_active to false
            is_active = false;
        }
    });

    function toggleOpen(force = null) {
        if (itm.classList.contains('opened') && force !== true) {
            itm.classList.remove('opened');
        } else {
            if (force !== false) {
                itm.classList.add('opened');
            }
        }
    }
});