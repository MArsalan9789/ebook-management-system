// SweetAlert Update
function confirmUpdate(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this user?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if(result.isConfirmed){
            document.getElementById('updateUserForm' + id).submit();
        }
    });
}



// SweetAlert Delete
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/userdelete/' + id;
        }
    });
}
const ctx = document.getElementById('usersChart');

if (ctx) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun'],
            datasets: [{
                label: 'Users',
                data: Object.values(usersPerMonth),
                borderWidth: 3,
                fill: false,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}


// Chart.js CDN pehle Blade me ya layout me load karna
// <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

// Users & Orders Charts
document.addEventListener('DOMContentLoaded', function() {

    // Data from Blade
    const usersPerMonth = window.usersPerMonth || [];
    const ordersData = window.ordersData || [];

    // Labels for last 6 months
    const monthLabels = [];
    for (let i = 5; i >= 0; i--) {
        const d = new Date();
        d.setMonth(d.getMonth() - i);
        monthLabels.push(d.toLocaleString('default', { month: 'short' }));
    }

    // USERS Chart
    const usersCanvas = document.getElementById('usersChart');
    if (usersCanvas) {
        const ctxUsers = usersCanvas.getContext('2d');
        new Chart(ctxUsers, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Users Growth',
                    data: usersPerMonth,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: true, position: 'top' } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    }

    // ORDERS Chart
    const ordersCanvas = document.getElementById('ordersChart');
    if (ordersCanvas) {
        const ctxOrders = ordersCanvas.getContext('2d');
        new Chart(ctxOrders, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Orders (Last 6 Months)',
                    data: ordersData,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: true, position: 'top' } },
                scales: { y: { beginAtZero: true } }
            }
        });
    }

});

function confirmEdit(url) {
    Swal.fire({
        title: 'Edit Competition?',
        text: "Kya aap competition edit karna chahte ho?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Edit',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

function confirmDeleteForm(button) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Competition permanently delete ho jayegi!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // submit the form
            button.closest('form').submit();
        }
    });
}


function confirmSubmissions(url) {
    Swal.fire({
        title: 'View Submissions?',
        text: "Is competition ki submissions dekhi jayengi",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#0dcaf0',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'View',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

// UPDATE CONFIRM
document.addEventListener('DOMContentLoaded', function () {
    const updateBtn = document.getElementById('updateBtn');
    if (updateBtn) {
        updateBtn.addEventListener('click', function(e) {
            e.preventDefault(); // form submit roko

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to update this competition?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Update',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // submit form manually
                    updateBtn.closest('form').submit();
                }
            });
        });
    }
});
function confirmWinner(url) {
    Swal.fire({
        title: 'Select Winner?',
        text: 'Is submission ko winner mark kar diya jayega',
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Select',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {

    /* =========================
       DELETE ORDER
    ========================== */
    document.querySelectorAll('.js-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            let form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This order will be permanently deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    /* =========================
       CANCEL ORDER
    ========================== */
    document.querySelectorAll('.js-cancel').forEach(btn => {
        btn.addEventListener('click', function () {
            let form = this.closest('form');

            Swal.fire({
                title: 'Cancel Order?',
                text: 'This order will be marked as cancelled.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    /* =========================
       EDIT ORDER
    ========================== */
    document.querySelectorAll('.js-edit').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            let url = this.dataset.url;

            Swal.fire({
                title: 'Edit Order?',
                text: 'You are about to edit this order.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Continue',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });

});
document.addEventListener('DOMContentLoaded', function () {
    const updateBtn = document.getElementById('updateOrderBtn');
    if (updateBtn) {
        updateBtn.addEventListener('click', function(e) {
            e.preventDefault(); // form submit roko

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to update this order?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Update',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateOrderForm').submit();
                }
            });
        });
    }
});


document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("sidebarToggle");

    toggleBtn.addEventListener("click", function(e) {
        sidebar.classList.toggle("active");
        document.body.classList.toggle("sidebar-open");
    });

    // Close sidebar on clicking outside (mobile only)
    document.addEventListener("click", function(e) {
        if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
            sidebar.classList.remove("active");
            document.body.classList.remove("sidebar-open");
        }
    });
});
