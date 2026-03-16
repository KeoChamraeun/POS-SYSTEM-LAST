// $('.date-form').daterangepicker({
//     opens: 'left'
// }, function (start, end, label) {
//     $("dateRange " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

// });
// console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

window.addEventListener("alert.message", (event) => {

    const Toast = Swal.mixin({
        toast: true,
        position: "top",
        iconColor: "white",
        customClass: { popup: "colored-toast" },
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    let { type, message, timer } = event.detail[0];
    Toast.fire({
        icon: type,
        title: message,
        timer: timer || 1500,
    });
});


//START OPEN MODAL POPUP
window.addEventListener("modal.openModal", (event) => {
    $("#openModal").modal("show");
});

document.addEventListener('modal.openModal', () => {
    const modal = new bootstrap.Modal(
        document.getElementById('openModal'),
        {
            backdrop: 'static', // Prevent click outside from closing
            keyboard: false     // Prevent Esc key from closing
        }
    );
    modal.show();
});

document.addEventListener('livewire:init', () => {
    Livewire.on('modal.closeModal', () => {
        const el = document.getElementById('openModal');
        bootstrap.Modal.getOrCreateInstance(el).hide();
    });
});


document.addEventListener('modal.openUpdateModal', () => {
    const modal = new bootstrap.Modal(
        document.getElementById('openUpdateModal'),
        {
            backdrop: 'static', // Prevent click outside from closing
            keyboard: false     // Prevent Esc key from closing
        }
    );
    modal.show();
});


document.addEventListener('livewire:init', () => {
    Livewire.on('modal.closeUpdateModal', () => {
        const el = document.getElementById('openUpdateModal');
        if (!el) return;

        const modal = bootstrap.Modal.getOrCreateInstance(el);
        modal.hide();
    });
});

window.addEventListener('modal.openUpdateModal', () => {
    const modalEl = document.getElementById('openUpdateModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
});

window.addEventListener('modal.closeModalUpdate', () => {
    const modalEl = document.getElementById('openUpdateModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.hide();
});

window.addEventListener('modal.openAddressModel', () => { 
    const modal = new bootstrap.Modal(
        document.getElementById('openAddressModel'),
        {
            backdrop: 'static', 
            keyboard: false 
        }
    );
    modal.show();
});

window.addEventListener('modal.closeAddressModel', () => {
    const modalEl = document.getElementById('openAddressModel');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.hide();
});


window.addEventListener('modal.openAddressUpdateModel', () => {
    const modal = new bootstrap.Modal(
        document.getElementById('openAddressUpdateModel'),
        {
            backdrop: 'static', 
            keyboard: false 
        }
    );
    modal.show();
});

window.addEventListener('modal.closeAddressUpdateModel', () => {
    const modalEl = document.getElementById('openAddressUpdateModel');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.hide();
});


document.addEventListener('livewire:init', () => {
    console.log('Livewire initialized');

    Livewire.on('modal.openCompanyModal', () => {
        console.log('Modal open event received');

        const el = document.getElementById('openCompanyModal');
        console.log('Modal element:', el);

        if (!el) return;

        const modal = new bootstrap.Modal(el);
        modal.show();
    });
});





// document.addEventListener('modal.openUpdateModal', () => {
//     const modal = new bootstrap.Modal(
//         document.getElementById('openUpdateModal')
//     );
//     modal.show();
// });

// CLOSED MODAL OPEN FORM
window.addEventListener("modal.closeModal", (event) => {
    $("#openModal").modal("hide");
});

//OPEN MODAL FORM
window.addEventListener("modal.openModalUpdate", (event) => {
    $("#openModalUpdate").modal("show");
});
// CLOSE UPDATE MODAL FORM
window.addEventListener("modal.closeModalUpdate", (event) => {
    $("#openModalUpdate").modal("hide");
});

// OPEN MODAL CHANGING CURRENT PASSWORD
window.addEventListener("modal.openModalChangePassword", (event) => {
    $("#openModalChangePassword").modal("show");
});
// CLOSED MODAL CHANGE PASSWORD
window.addEventListener("modal.closeModalChangePassword", (event) => {
    $("#openModalChangePassword").modal("hide");
});

// OPEN MODAL SetAwardTarget
window.addEventListener('modal.openModalSetAwardTarget', event => {
    $("#openModalSetAwardTarget").modal("show");
});

window.addEventListener('modal.closeModalSetAwardTarget', event => {
    $("#openModalSetAwardTarget").modal("hide");
});

// OPEN MODAL CreateAwardTarget
window.addEventListener('modal.openModalCreateAwardTarget', event => {
    $("#openModalCreateAwardTarget").modal("show");
});
// CLOSED CreateAwardTarget
window.addEventListener('modal.closeModalCreateAwardTarget', event => {
    $("#openModalCreateAwardTarget").modal("hide");
});

// OPEN MODAL SetTarget
window.addEventListener('modal.openModalSetTarget', event => {
    $("#openModalSetTarget").modal("show");
});
// CLOSED SetTarget
window.addEventListener('modal.openModalSetTarget', event => {
    $("#openModalSetTarget").modal("hide");
});

//OPEN APPLY ROLE PERMISSION
window.addEventListener("modal.openModalApplyRole", (event) => {
    $("#openModalApplyRole").modal("show");
});

// ADDRESS MODAL
window.addEventListener("modal.addressModal", (event) => {
    $("#addressModal").modal("show");
});
window.addEventListener('modal.closeAddressModal', event => {
    $("#addressModal").modal("hide");
});
// Guarantor MODAL
window.addEventListener("modal.guarantorModal", (event) => {
    $("#guarantorModal").modal("show");
});
window.addEventListener("modal.closeGuarantorModal", (event) => {
    $("#guarantorModal").modal("hide");
});

// Bank Info
window.addEventListener("modal.bankModal", (event) => {
    $("#bankModal").modal("show");
});

// Update Status of Agency
window.addEventListener("modal.updateStatus", (event) => {
    $("#statusModal").modal("show");
});
// Update Code in Agency List
window.addEventListener("modal.updateCode", (event) => {
    $("#updateCode").modal("show");
});
window.addEventListener("modal.closeUpdateCode", (event) => {
    $("#updateCode").modal("hide");
});

// Show Filter Status
window.addEventListener("modal.modal.ShowFilterStatus", (event) => {
    $("#Status_id").modal("show");
});
window.addEventListener("modal.confirmDelete", (event) => {
    $("#delete").modal("show");
});
window.addEventListener("modal.closeDelete", (event) => {
    $("#delete").modal("hide");
});

////Update Shop MODAL FORM
window.addEventListener('modal.openModalUpdateShop', (event) => {
    $("#openUpdateShop").modal("show");
});

window.addEventListener('modal.closeModalUpdateShop', (event) => {
    $("#openUpdateShop").modal("hide");
});
//
window.addEventListener('modal.openEditProductModal', event => {
    $("#opendProductModal").modal("show");
});

window.addEventListener('modal.CloseEditProductModal', event => {
    $("#opendProductModal").modal("hide");
});

window.addEventListener('modal.openAssignShop', event => {
    $("#openModalAssignShop").modal("show");
});
window.addEventListener('modal.closeAssignShop', event => {
    $("#openModalAssignShop").modal("hide");
});

window.addEventListener('modal.CloseEditProductModal', event => {
    $("#opendProductModal").modal("hide");
});

window.addEventListener('modal.openModalCommission', event => {
    $("#openModalCommission").modal("show");
});

window.addEventListener('modal.openModalAssignBranch', event => {
    $("#openModalAssignBranch").modal("show");
});
window.addEventListener('modal.closeModalAssignBranch', event => {
    $("#openModalAssignBranch").modal("hide");
});

window.addEventListener('modal.openModalAddress', event => {
    $("#openModalAddress").modal('show');
});

window.addEventListener('modal.openModalAssignApp', event => {
    $("#openModalApp").modal("show");
});
window.addEventListener('modal.OpenModalAssignApplication', event => {
    $("#assignModal").modal("show");
});

window.addEventListener('modal.CloseModalAssignApplication', event => {
    $("#assignModal").modal("hide");
});

window.addEventListener('modal.OpenModalRequestApplication', event => {
    $("#requestModal").modal("show");
});

window.addEventListener('modal.CloseModalRequestApplication', event => {
    $("#requestModal").modal("hide");
});

//open duplicate application
window.addEventListener("modal.openDuplicateModal", (event) => {
    $("#openDuplicateModal").modal("show");
});
window.addEventListener("modal.closeDuplicateModal", (event) => {
    $("#openDuplicateModal").modal("hide");
});

window.addEventListener("modal.openBrandModal", (event) => {
    $("#createBrandModal").modal("show");
});
window.addEventListener("modal.closeBrandModal", (event) => {
    $("#createBrandModal").modal("hide");
});

window.addEventListener("modal.openEditModal", (event) => {
    $("#editBrandModal").modal("show");
});
window.addEventListener("modal.closeEditModal", (event) => {
    $("#editBrandModal").modal("hide");
});





