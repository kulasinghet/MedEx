const report_types = ['pharmacy', 'supplier', 'delivery', 'lab'];

// adding simplebar to the report list
new SimpleBar(document.querySelector('.report-list .list-content'));

// manipulating report items
document.querySelectorAll('.report-itm:not(.report-actions)').forEach((itm) => {
    const inner_itm = itm.querySelector('.report-inner');
    let is_active = false;

    inner_itm.addEventListener('click', (e) => {
        e.preventDefault();

        if (e.target.tagName === 'A') {
            // getting a response from the server
            handleInquiryIsAccepted(itm.getAttribute('data-id')).then(r => {
                window.location.reload();
            });
        } else if (e.currentTarget === inner_itm && !is_active) {
            // open the report item
            itm.classList.add('opened');
            is_active = true;
            logger('Active report item: ' + itm.getAttribute('data-id'));
        }

        if (e.currentTarget === inner_itm) {
            setTimeout(() => isSeen(), 1000);
        }
    });

    itm.addEventListener('mouseleave', (e) => {
        e.stopPropagation();

        if (e.currentTarget === itm && is_active) {
            setTimeout(() => {
                // close the report item
                itm.classList.remove('opened');
                is_active = false;
                logger('Closed report item: ' + itm.getAttribute('data-id'));
            }, 1000);

            // set is_active to false
            is_active = false;
        }
    });

    function isSeen() {
        let user_type = '';

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
            fetch('/employee/inquiries?et=' + itm.getAttribute('data-id') + '&a=seen')
                .then(r => r.json())
                .then(response => {
                    if (response.success) {
                        // Access additional attributes
                        const username = response.username;
                        const inquiryId = response.inquiry_id;
                        const toast = createToast('Inquiry is seen', 'Report seen by ' + username + ' for inquiry ID ' + inquiryId + '.', 'success');
                        toast.showToast();

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
    }
});

async function handleInquiryIsAccepted(inquiryID) {
    try {
        // buzzing model
        swal({
            title: 'Loading',
            text: 'Please wait...',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
            content: {
                element: "img",
                attributes: {
                    // add loading gitf from internet
                    src: "https://i.gifer.com/ZZ5H.gif",
                    style: "width:25px; margin-bottom:20px;"
                },
            }
        })

        const response = await fetch(`/employee/inquiries?et=${inquiryID}&a=accept`);
        const data = await response.json();
        swal.close();
        // buzzing model

        return !! (await data).success;

    } catch (e) {
        console.log(e);
    }
}
