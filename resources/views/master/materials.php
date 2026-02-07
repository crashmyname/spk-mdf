    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card-header">
                    <h4 class="card-title"><?= $title?></h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-material">
                        Add Material
                    </button>
                    <button class="btn btn-indigo" data-bs-toggle="modal" data-bs-target="#modal-import">
                        Import Material
                    </button>
                    <div id="materialContainer" class="w-full overflow-x-auto sm:overflow-visible mt-3">
                        <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden border border-gray-200 rounded-lg">
                            <table id="materialTable" class="min-w-full border-collapse text-sm sm:text-base">
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
    <div class="modal modal-blur fade" id="modal-material" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formaddmaterial" action="" enctype="multipart/form-data" method="post">
                    <?= csrf()?>
                    <div class="modal-header">
                        <h5 class="modal-title">New Material</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Mold Number</label>
                            <input type="text" class="form-control" name="mold_number" id="mold_number" placeholder="Your Mold Number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lamp Name</label>
                            <input type="text" class="form-control" name="lamp_name" id="lamp_name"
                                placeholder="Your Lamp name">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Model Name</label>
                                    <input type="text" class="form-control" name="model_name" id="model_name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" name="type_material" class="form-control" id="type_material">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="addmaterial" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new material
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
                <form id="formeditmaterial" action="" enctype="multipart/form-data" method="post">
                    <?= method('PUT')?>
                    <div class="modal-header">
                        <h5 class="modal-title">Update Material</h5>
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
                        <button type="submit" id="editmaterial" class="btn btn-yellow ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Update Material
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
    <div class="modal modal-blur fade" id="modal-import" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formimportmaterial" action="" enctype="multipart/form-data" method="post">
                    <?= csrf()?>
                    <div class="modal-header">
                        <h5 class="modal-title">Form Import Material</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">File</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                        <a href="<?= asset('import/template-material.xlsx')?>" class="btn btn-sm btn-success">Template</a>
                        <div id="tableresult-wrapper" class="card mt-3" style="display:none">
                            <div class="card-header">
                                <h3 class="card-title">Import Result</h3>
                                <div id="summaryresult" class="ms-auto"></div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Mold Number</th>
                                            <th>Message</th>
                                            <th>Row</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datares"></tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="container container-slim py-2" id="loadingbar" style="display:none">
                        <div class="text-center">
                        <div class="text-secondary mb-1">Waiting....</div>
                            <div class="progress progress-sm">
                                <div class="progress-bar progress-bar-indeterminate"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="importmaterial" class="btn btn-indigo ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Import
                        </button>
                        <button id="loadingimport" disabled class="btn btn-indigo ms-auto" style="display:none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            <div class="spinner-border me-2" role="status"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= asset_v('js/table-plus.js')?>"></script>
    <script>
        var csrfToken = '<?= csrfHeader()?>'
        var createMaterial = '<?= route('materials.create')?>'
        var getMaterial = '<?= route('materials.getdata')?>'
        var editMaterial = '<?= url('material')?>'
        var deleteMaterial = '<?= url('material')?>'
        var urlImport = '<?= route('materials.import')?>'
    </script>
    <script src="<?= asset_v('js/materials.js')?>"></script>