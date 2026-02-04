        document.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-bs-target="#modalEdit"]');
            if (!btn) return;

            const user = JSON.parse(btn.dataset.user);

            document.getElementById('uusername').value = user.username ?? '';
            document.getElementById('uname').value = user.name ?? '';
            document.getElementById('uemail').value = user.email ?? '';
            document.getElementById('usection').value = user.section ?? '';
            document.getElementById('urole').value = user.role ?? '';
            console.log(user.role)
        });
        const table = new TablePlus({
            url : getUser,
            columns : {
                action : {
                    label : 'Action',
                    render: (row) => {
                        return `
                        <button
                            class="btn btn-sm btn-yellow"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEdit"
                            data-user='${JSON.stringify(row)}'>
                            Edit
                        </button>
                        <button type="submit" class="btn btn-sm btn-danger deleteuser" data-user="${row.username}">Delete</button>
                        `;
                    },
                    exportText: (row) => {
                        return 'Edit / Hapus'
                    }
                },
                username : 'NIK',
                name : 'Name',
                section : 'Section',
                email : 'Email',
                role : 'Role',
            },
            perPage: 10,
            perPageOptions: [10,20,50,100],
            rowIdentifier: 'username',
            // customActions: [
            //     {
            //         label: '✓ Tandai Dibaca',
            //         className: 'bg-green-600 text-white px-3 py-1 rounded text-sm',
            //         onClick: (selectedIds) => {
            //             console.log('Selected IDs:', selectedIds);
            //         }
            //     },
            //     {
            //         label: 'Update',
            //         className: 'bg-red-600 text-white px-3 py-1 rounded text-sm',
            //         onClick: (selectedIds) => {
            //             console.log('Update IDs:',selectedIds)
            //         }
            //     }
            // ],
            // onRowSelect: (selectedIds) => {
            //     console.log('Total dipilih:', selectedIds.length);
            // },
            savePreferences: true
        })
        table.render('#userTable')
$(document).ready(function(){
    crud()
    $('#username').on('change', function(e){
        e.preventDefault()
        $.ajax({
            url : urlEmp,
            type: 'POST',
            data : {
                nik : $(this).val()
            },
            headers : {
                'X-CSRF-TOKEN' : csrfToken
            },
            success: function(response){
                if(response.status === 200) {
                    $('#name').val(response.data.nama)
                    $('#section').val(response.data.kode_section)
                    $('#email').val(response.data.work_email)
                }
            }
        })
    })
})

function crud()
{
    $('#adduser').on('click', function(e){
        e.preventDefault()
        var form = new FormData($('#formadduser')[0])
        const btnAdd = $('#adduser')
        const btnLoading = $('#loading')
        btnAdd.hide()
        btnLoading.show()
        $.ajax({
            url : createUser,
            type: 'POST',
            data : form,
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status === 200){
                    btnAdd.show()
                    btnLoading.hide()
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then((result) => {
                        table.refresh()
                    })
                } else {
                    btnAdd.show()
                    btnLoading.hide()
                    var errmes = ''
                    if(response.status === 422 && typeof response.message === 'object'){
                        for(var field in response.message){
                            if(response.message.hasOwnProperty(field)){
                                response.message[field].forEach(function(message){
                                    errmes += message + '\n'
                                })
                            }
                        }
                    } else {
                        errmes = 'An unexcpected error occured.'
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errmes.trim()
                    })
                }
            }, error: function(err,res,message){
                btnAdd.show()
                btnLoading.hide()
                var errmes = ''
                if(err.responseJSON.status === 422 && typeof err.responseJSON.message === 'object'){
                    for(var field in err.responseJSON.message){
                        if(err.responseJSON.message.hasOwnProperty(field)){
                            err.responseJSON.message[field].forEach(function(message){
                                errmes += message + '\n'
                            })
                        }
                    }
                } else {
                    errmes = err.responseJSON.message
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errmes.trim()
                })
            }
        })
    })
    $('#edituser').on('click', function(e){
        e.preventDefault()
        var form = new FormData($('#formedituser')[0])
        const btnAdd = $('#edituser')
        const btnLoading = $('#loadingedit')
        btnAdd.hide()
        btnLoading.show()
        $.ajax({
            url : editUser +'/'+ $('#uusername').val(),
            type: 'POST',
            data : form,
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status === 200){
                    btnAdd.show()
                    btnLoading.hide()
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then((result) => {
                        table.refresh()
                    })
                } else {
                    btnAdd.show()
                    btnLoading.hide()
                    var errmes = ''
                    if(response.status === 422 && typeof response.message === 'object'){
                        for(var field in response.message){
                            if(response.message.hasOwnProperty(field)){
                                response.message[field].forEach(function(message){
                                    errmes += message + '\n'
                                })
                            }
                        }
                    } else {
                        errmes = 'An unexcpected error occured.'
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errmes.trim()
                    })
                }
            }, error: function(err,res,message){
                btnAdd.show()
                btnLoading.hide()
                var errmes = ''
                if(err.responseJSON.status === 422 && typeof err.responseJSON.message === 'object'){
                    for(var field in err.responseJSON.message){
                        if(err.responseJSON.message.hasOwnProperty(field)){
                            err.responseJSON.message[field].forEach(function(message){
                                errmes += message + '\n'
                            })
                        }
                    }
                } else {
                    errmes = err.responseJSON.message
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errmes.trim()
                })
            }
        })
    })
    $(document).on('click','.deleteuser', function(e){
        e.preventDefault()
        const username = $(this).data('user');
            Swal.fire({
                title: 'Delete',
                icon: 'warning',
                text: 'Yakin ingin dihapus?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: deleteUser +'/'+ username,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            if (response.status === 200) {
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    text: response.message,
                                    timer: 1500,
                                    timerProgressBar: true,
                                });
                                table.refresh();
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    icon: 'error',
                                    text: 'Data Error',
                                    timer: 1500,
                                    timerProgressBar: true,
                                });
                            }
                        }, error: function(err,res,message){
                            var errmes = ''
                            if(err.responseJSON.status === 422 && typeof err.responseJSON.message === 'object'){
                                for(var field in err.responseJSON.message){
                                    if(err.responseJSON.message.hasOwnProperty(field)){
                                        err.responseJSON.message[field].forEach(function(message){
                                            errmes += message + '\n'
                                        })
                                    }
                                }
                            } else {
                                errmes = err.responseJSON.message
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errmes.trim()
                            })
                        }
                    })
                }
            })
    })
}