let list = null
$(document).ready(function(){
    flatpickr("#date_repair", {
        dateFormat: "Y-m-d",
        locale: "id", 
        allowInput: true,
        defaultDate: new Date()
    });
    flatpickr("#date_act", {
        dateFormat: "Y-m-d",
        locale: "id", 
        allowInput: true,
        defaultDate: new Date()
    });
    crud()
    getDetail()
    getAct()
})

function crud(){
    $('#submitRequest').on('click', function(e){
        e.preventDefault()
        const btnAdd = $('#submitRequest')
        const btnLoading = $('#loadingreq')
        btnAdd.hide()
        btnLoading.show()
        var formData = new FormData($('#formreqrepair')[0])
        $.ajax({
            url: urlReqRepair,
            type: 'POST',
            data: formData,
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
                    }).then((result)=>{
                        getDetail()
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
    $('#submitActual').on('click', function(e){
        e.preventDefault()
        const btnAdd = $('#submitActual')
        const btnLoading = $('#loadingact')
        btnAdd.hide()
        btnLoading.show()
        var formData = new FormData($('#formactrepair')[0])
        $.ajax({
            url: urlActRepair,
            type: 'POST',
            data: formData,
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
                    }).then((result)=>{
                        getDetail()
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
    $(document).on('click', '.btnUpdateReq',function(e){
        e.preventDefault()
        $('#modalEditReq').modal('show')
        let data = $(this).data('item')
        $('#uhash').val(data.hash)
        $('#udetail_item').val(data.detail_item)
        $('#urepair_req').val(data.repair_req)
        $('#udate_repair').val(data.date_repair)
    })
    $(document).on('click', '.btnUpdateAct',function(e){
        e.preventDefault()
        $('#modalEditAct').modal('show')
        let data = $(this).data('item')
        $('#uhashact').val(data.hashAct)
        $('#uact_repair').val(data.act_repair)
        $('#udate_act').val(data.date_act)
    })
    $('#editdetailreq').on('click', function(e){
        e.preventDefault()
        const btnAdd = $('#editdetailreq')
        const btnLoading = $('#loadingeditreq')
        btnAdd.hide()
        btnLoading.show()
        var formData = new FormData($('#formeditdetailreq')[0])
        $.ajax({
            url: urlUpdateReq,
            data: formData,
            type: 'POST',
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
                    }).then((result)=>{
                        getDetail()
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
    $(document).on('click','.deletedetailreq', function(e){
        e.preventDefault()
        const ticket = $(this).data('item');
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
                        url: urlDeleteReq +'/'+ ticket,
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
                                }).then((result)=>{
                                    getDetail()
                                });
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
    $('#editdetailact').on('click', function(e){
        e.preventDefault()
        const btnAdd = $('#editdetailact')
        const btnLoading = $('#loadingeditact')
        btnAdd.hide()
        btnLoading.show()
        var formData = new FormData($('#formeditdetailact')[0])
        $.ajax({
            url: urlUpdateAct,
            data: formData,
            type: 'POST',
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
                    }).then((result)=>{
                        getAct()
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
    $(document).on('click','.deletedetailact', function(e){
        e.preventDefault()
        const ticket = $(this).data('item');
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
                        url: urlDeleteAct +'/'+ ticket,
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
                                }).then((result)=>{
                                    getAct()
                                });
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

function getDetail()
{
    $.ajax({
        url : getReqRepair + '/' + hash,
        type: 'GET',
        dataType: 'json',
        success: function(response){
            $('#listreq').empty();
            if(response.status == 200){
                response.data.forEach((item) => {
                    const list = `
                    <li class="step-item ${item.length == 1 ? 'active' : ''}">
                        <div class="h4 m-0">${item.detail_item}</div>
                        <div class="text-secondary">${item.repair_req}</div>
                        <div class="text-dark">${item.repair_by}</div>
                        <div class="text-primary ml-auto">${item.date_repair}</div>
                        <button class="btn btn-sm btn-teal btnUpdateReq" data-item='${JSON.stringify(item)}'>Update</button>
                        <button class="btn btn-sm btn-danger deletedetailreq" data-item='${item.hash}'>Delete</button>
                    </li>
                    `
                    $('#listreq').append(list)
                })
            } else {
                $('#listreq').append(`
                <li class="step-item">
                    <div class="h4 m-0">Not Found</div>
                    <div class="text-secondary">Data not found</div>
                </li>
                `)
            }
        }, error: function(err,res,message){
            $('#listreq').append(`
                <li class="step-item">
                    <div class="h4 m-0">Not Found</div>
                    <div class="text-secondary">Data not found</div>
                </li>
                `)
        }
    })
}

function getAct()
{
    $.ajax({
        url : getActRepair + '/' + hash,
        type: 'GET',
        dataType: 'json',
        success: function(response){
            $('#listact').empty();
            if(response.status == 200){
                response.data.forEach((item) => {
                    const list = `
                    <li class="step-item ${item.length == 1 ? 'active' : ''}">
                        <div class="h4 m-0">${item.act_repair}</div>
                        <div class="text-secondary">${item.total_hours_act}</div>
                        <div class="text-dark">${item.act_by}</div>
                        <div class="text-primary ml-auto">${item.date_act}</div>
                        <button class="btn btn-sm btn-teal btnUpdateAct" data-item='${JSON.stringify(item)}'>Update</button>
                        <button class="btn btn-sm btn-danger deletedetailact" data-item='${item.hashAct}'>Delete</button>
                    </li>
                    `
                    $('#listact').append(list)
                })
            } else {
                $('#listact').append(`
                <li class="step-item">
                    <div class="h4 m-0">Not Found</div>
                    <div class="text-secondary">Data not found</div>
                </li>
                `)
            }
        }, error: function(err,res,message){
            $('#listact').append(`
                <li class="step-item">
                    <div class="h4 m-0">Not Found</div>
                    <div class="text-secondary">Data not found</div>
                </li>
                `)
        }
    })
}