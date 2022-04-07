@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">payments</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Saldo en red</p>
                            <h4 class="mb-0">$15.5 M</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1"></div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">send</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">N° Movimientos</p>
                            <h4 class="mb-0">8300</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">group</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">N° Tenderos</p>
                            <h4 class="mb-0">3462</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">send</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Dinero en Op.</p>
                            <h4 class="mb-0">$753.000</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="row mt-4">
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 ">Gestion de usuarios <a href="person-add.html" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">person_add</i></a></h6>

                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Función</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Config.</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">Bloq/Desbloq</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-1 py-1">
                                                <div>
                                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                                    <p class="text-xs text-secondary mb-0">john@corresponsales.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Manager</p>
                                            <p class="text-xs text-secondary mb-0">Organization</p>

                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">online</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-link text-danger text-gradient px-1 mb-0" href="#"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="#"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch ps-3">
                                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                                                <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="flexSwitchCheckDefault"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user2">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Alexa Liras</h6>
                                                    <p class="text-xs text-secondary mb-0">alexa@corresponsales.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Programator</p>
                                            <p class="text-xs text-secondary mb-0">Developer</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">online</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-link text-danger text-gradient px-1 mb-0" href="#"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="#"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch ps-3">
                                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                                                <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="flexSwitchCheckDefault"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                                                    <p class="text-xs text-secondary mb-0">laurent@corresponsales.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Executive</p>
                                            <p class="text-xs text-secondary mb-0">Projects</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">online</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-link text-danger text-gradient px-1 mb-0" href="#"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="#"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch ps-3">
                                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                                                <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="flexSwitchCheckDefault"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user4">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Michael Levi</h6>
                                                    <p class="text-xs text-secondary mb-0">michael@corresponsales.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Programator</p>
                                            <p class="text-xs text-secondary mb-0">Developer</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">online</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-link text-danger text-gradient px-1 mb-0" href="#"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="#"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch ps-3">
                                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                                                <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="flexSwitchCheckDefault"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user5">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Richard Gran</h6>
                                                    <p class="text-xs text-secondary mb-0">richard@corresponsales.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Manager</p>
                                            <p class="text-xs text-secondary mb-0">Executive</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-secondary">offline</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-link text-danger text-gradient px-1 mb-0" href="#"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="#"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch ps-3">
                                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                                                <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user6">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Miriam Eric</h6>
                                                    <p class="text-xs text-secondary mb-0">miriam@corresponsales.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Programator</p>
                                            <p class="text-xs text-secondary mb-0">Developer</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-secondary">offline</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-link text-danger text-gradient px-1 mb-0" href="#"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="#"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch ps-3">
                                                <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                                                <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1"></label>

                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
