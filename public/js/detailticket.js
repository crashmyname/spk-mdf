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