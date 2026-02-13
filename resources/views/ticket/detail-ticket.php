<?php
use Bpjs\Framework\Helpers\Session;
?>
<div class="container">
    <h1>SPK WITH SYSTEM ID : <?= $ticket->uuid.'-'.$ticket->type_ticket?></h1>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-require" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                            role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-hammer"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.414 10l-7.383 7.418a2.091 2.091 0 0 0 0 2.967a2.11 2.11 0 0 0 2.976 0l7.407 -7.385" /><path d="M18.121 15.293l2.586 -2.586a1 1 0 0 0 0 -1.414l-7.586 -7.586a1 1 0 0 0 -1.414 0l-2.586 2.586a1 1 0 0 0 0 1.414l7.586 7.586a1 1 0 0 0 1.414 0" /></svg>
                            Request Repair</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-actual" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                            role="tab" tabindex="-1"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3.5 5.5l1.5 1.5l2.5 -2.5" /><path d="M3.5 11.5l1.5 1.5l2.5 -2.5" /><path d="M3.5 17.5l1.5 1.5l2.5 -2.5" /><path d="M11 6l9 0" /><path d="M11 12l9 0" /><path d="M11 18l9 0" /></svg>
                            Actual Repair</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-require" role="tabpanel">
                        <h4>Request Repair</h4>
                        <form class="card" id="formreqrepair" action="" method="POST" enctype="multipart/form-data">
                            <?= csrf()?>
                            <div class="card-header">
                                <h3 class="card-title">Add Request Repair</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Detail Item</label>
                                    <div>
                                        <input type="hidden" name="hash" id="hash" value="<?= $id?>">
                                        <input type="text" name="detail_item" id="detail_item" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Repair Requirement</label>
                                    <div>
                                        <textarea name="repair_req" id="repair_req" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Date Repair</label>
                                    <div>
                                        <input type="date" name="date_repair" id="date_repair" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Repair By</label>
                                    <div>
                                        <input type="text" readonly name="repair_by" id="repair_by"
                                            value="<?= Session::user()->name ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end d-flex justify-content-between">
                                <a href="<?= route('tickets')?>" class="btn btn-white ">Back</a>
                                <button type="submit" class="btn btn-primary" id="submitRequest">Submit</button>
                                <button class="btn btn-primary" style="display: none;" id="loadingreq" disabled>
                                    <div class="spinner-border me-2" role="status"></div>
                                    <strong>Loading...</strong>
                                </button>
                            </div>
                        </form>
                        <hr>
                        <h3>Request</h3>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">List Repair</h3>
                                <ul class="steps steps-vertical" id="listreq">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-actual" role="tabpanel">
                        <h4>Actual Repair</h4>
                        <form class="card" id="formactrepair" action="" method="POST" enctype="multipart/form-data">
                            <?= csrf()?>
                            <div class="card-header">
                                <h3 class="card-title">Add Actual Repair</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Actual Repair</label>
                                    <div>
                                        <input type="hidden" name="hashact" id="hashact" value="<?= $id?>">
                                        <input type="text" name="act_repair" id="act_repair"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Date Actual</label>
                                    <div>
                                        <input type="date" name="date_act" id="date_act"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Actual By</label>
                                    <div>
                                        <input type="text" readonly name="act_by" id="act_by"
                                            value="<?= Session::user()->name ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end d-flex justify-content-between">
                                <a href="<?= route('tickets')?>" class="btn btn-white">Back</a>
                                <button type="submit" class="btn btn-primary" id="submitActual">Submit</button>
                                <button class="btn btn-primary" style="display: none;" id="loadingact" disabled>
                                    <div class="spinner-border me-2" role="status"></div>
                                    <strong>Loading...</strong>
                                </button>
                            </div>
                        </form>
                        <hr>
                        <h3>Actual</h3>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">List Repair</h3>
                                <ul class="steps steps-vertical" id="listact">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modalEditReq" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formeditdetailreq" action="" enctype="multipart/form-data" method="post">
                    <?= csrf()?>
                    <div class="modal-header">
                        <h5 class="modal-title">Update Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Detail Item</label>
                                    <input type="hidden" name="hash" id="uhash">
                                    <input type="text" name="detail_item" id="udetail_item" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Repair Requirement</label>
                                    <textarea name="repair_req" id="urepair_req" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Date Repair</label>
                                    <input type="date" name="date_repair" id="udate_repair" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Repair By</label>
                                    <input type="text" readonly name="repair_by" id="urepair_by"
                                            value="<?= Session::user()->name ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="editdetailreq" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Update Detail Req
                        </button>
                        <button class="btn btn-primary ms-auto" style="display: none;" id="loadingeditreq" disabled>
                            <div class="spinner-border me-2" role="status"></div>
                            <strong>Loading...</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div class="modal modal-blur fade" id="modalEditAct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formeditdetailact" action="" enctype="multipart/form-data" method="post">
                    <?= csrf()?>
                    <div class="modal-header">
                        <h5 class="modal-title">Update Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Actual Repair</label>
                                     <input type="hidden" name="hashact" id="uhashact">
                                    <input type="text" name="act_repair" id="uact_repair" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Date Actual</label>
                                    <input type="date" name="date_act" id="udate_act"
                                            class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Act By</label>
                                    <input type="text" readonly name="act_by" id="uact_by"
                                            value="<?= Session::user()->name ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="editdetailact" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Update Detail Req
                        </button>
                        <button class="btn btn-primary ms-auto" style="display: none;" id="loadingeditact" disabled>
                            <div class="spinner-border me-2" role="status"></div>
                            <strong>Loading...</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    var urlReqRepair = '<?= route('detail.ticket.req')?>'
    var urlActRepair = '<?= route('detail.ticket.act')?>'
    var getReqRepair = '<?= url('get/detail')?>'
    var getActRepair = '<?= url('get/detailact')?>'
    var urlUpdateReq = '<?= route('detail.request.update')?>'
    var urlDeleteReq = '<?= url('detail/request')?>'
    var urlUpdateAct = '<?= route('detail.actual.update')?>'
    var urlDeleteAct = '<?= url('detail/actual')?>'
    var hash = '<?= $id?>'
    var csrfToken = '<?= csrfHeader()?>'
</script>
<script src="<?= asset_v('js/detailticket.js')?>"></script>