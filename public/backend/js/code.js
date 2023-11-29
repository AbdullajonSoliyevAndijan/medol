$(function() {
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Вы уверены?',
            text: "Удалить эти данные?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да, удалить!',
            cancelButtonText: 'Отмена'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Удалено!',
                    'Ваш файл удален.',
                    'success'
                )
            }
        })


    });
});

// Confirm

$(function() {
    $(document).on('click', '#confirm', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure to Confirm?',
            text: "Once Confirm, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Confirm!',
                    'Confirm Changes',
                    'success'
                )
            }
        })


    });
});

// processing

$(function() {
    $(document).on('click', '#processing', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure to Processing?',
            text: "Once Processing, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Processing!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Processing!',
                    'Processing Changes',
                    'success'
                )
            }
        })


    });
});

// picked

$(function() {
    $(document).on('click', '#picked', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure to Picked?',
            text: "Once Picked, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Picked!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Picked!',
                    'Picked Changes',
                    'success'
                )
            }
        })


    });
});

// shipped

$(function() {
    $(document).on('click', '#shipped', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure to Shipped?',
            text: "Once Shipped, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Shipped!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Shipped!',
                    'Shipped Changes',
                    'success'
                )
            }
        })


    });
});

// delivered

$(function() {
    $(document).on('click', '#delivered', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure to Delivered?',
            text: "Once Delivered, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delivered!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Delivered!',
                    'Delivered Changes',
                    'success'
                )
            }
        })


    });
});

// cancel

$(function() {
    $(document).on('click', '#cancel', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure to Cancel?',
            text: "Once Cancel, You will not be able to pending again",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Cancel!',
                    'Cancel Changes',
                    'success'
                )
            }
        })


    });
});
