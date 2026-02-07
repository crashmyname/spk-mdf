<?php 
use Bpjs\Framework\Helpers\Session;
?>    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card-header">
                    <h4 class="card-title"><?= $title?></h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-ticket">
                        Add Ticket
                    </button>
                    <!-- <button class="btn btn-indigo" data-bs-toggle="modal" data-bs-target="#modal-import">
                        Import Ticket
                    </button> -->
                    <div id="ticketContainer" class="w-full overflow-x-auto sm:overflow-visible mt-3">
                        <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden border border-gray-200 rounded-lg">
                            <table id="ticketTable" class="min-w-full border-collapse text-sm sm:text-base">
                            <thead></thead>
                            <tbody></tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-ticket" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formaddticket" action="" enctype="multipart/form-data" method="post">
                    <?= csrf()?>
                    <div class="modal-header">
                        <h5 class="modal-title">New Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">No Order</label>
                                    <input type="text" class="form-control" name="no_order" id="no_order" placeholder="Your No Order">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Date Create</label>
                                    <input type="date" class="form-control" name="date_create" id="date_create">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">NIK</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="<?= Session::user()->user_id?>"><?= Session::user()->username?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?= Session::user()->name?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Material</label>
                                    <select name="material" id="material" class="form-control">
                                        <option hidden disabled selected value="">Pilih</option>
                                        <?php foreach($material as $mt): ?>
                                            <option value="<?= $mt->mold_number?>"><?= $mt->mold_number.'-'.$mt->model_name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Action</label>
                                    <div class="input-group input-group-flat">
                                        <select name="action" id="action" class="form-control">
                                            <option value="" hidden disabled selected>Pilih</option>
                                            <option value="maintenance">Maintenance</option>
                                            <option value="repair">Repair</option>
                                            <option value="modification">Modification</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Type Ticket</label>
                                    <select name="type_ticket" id="type_ticket" class="form-control">
                                        <option hidden disabled selected value="">Pilih</option>
                                        <option value="MOLD REGULER">MOLD REGULER</option>
                                        <option value="NEW MOLD">NEW MOLD</option>
                                        <option value="CUCI EF">CUCI EF</option>
                                        <option value="TANPA CUCI EF">TANPA CUCI EF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Lot shot</label>
                                    <div class="input-group input-group-flat">
                                        <input type="number" name="lot_shot" id="lot_shot" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Total Shot</label>
                                    <input type="number" name="total_shot" id="total_shot" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Sketch Item</label>
                                    <div class="input-group input-group-flat">
                                        <input type="file" name="file_sketch" id="file_sketch" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="addticket" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new ticket
                        </button>
                        <button class="btn btn-primary ms-auto" style="display: none;" id="loading" disabled>
                            <div class="spinner-border me-2" role="status"></div>
                            <strong>Loading...</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formeditticket" action="" enctype="multipart/form-data" method="post">
                    <?= method('PUT')?>
                    <div class="modal-header">
                        <h5 class="modal-title">Update Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Mold Number</label>
                            <input type="text" class="form-control" name="mold_number" id="umold_number" placeholder="Your Mold Number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lamp Name</label>
                            <input type="text" class="form-control" name="lamp_name" id="ulamp_name"
                                placeholder="Your Lamp name">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Model Name</label>
                                    <input type="text" class="form-control" name="model_name" id="umodel_name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="type_material" class="form-control" id="utype_material">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="editticket" class="btn btn-yellow ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Update Ticket
                        </button>
                        <button class="btn btn-yellow ms-auto" style="display: none;" id="loadingedit" disabled>
                            <div class="spinner-border me-2" role="status"></div>
                            <strong>Loading...</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#material').select2({
            placeholder: 'Pilih Material',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modal-ticket')
        });
    </script>
    <script src="<?= asset_v('js/table-plus.js')?>"></script>
    <script>
        var csrfToken = '<?= csrfHeader()?>'
        var urlMaterial = '<?= route('ticket.getmaterial')?>'
        var createTicket = '<?= route('tickets.create')?>'
        var getTicket = '<?= route('tickets.getdata')?>'
        var editTicket = '<?= url('ticket')?>'
        var deleteTicket = '<?= url('ticket')?>'
        var urlDetail = '<?= url('ticket/detail')?>'
        // var urlImport = '<?= url('admin/import/ticket')?>'
    </script>
    <script src="<?= asset_v('js/ticket.js')?>"></script>