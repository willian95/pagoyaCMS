@extends("layouts.main")
@section("content")

    <div class="d-flex flex-column-fluid" id="dev-list">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Prospectos
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable" style="">
                        <table class="table">
                            <thead>
                                <tr >
                                    <th class="datatable-cell datatable-cell-sort" style="width: 170px;">
                                        <span>Nombre</span>
                                    </th>

                                    <th class="datatable-cell datatable-cell-sort" style="width: 170px;">
                                        <span>Teléfono</span>
                                    </th>

                                    <th class="datatable-cell datatable-cell-sort" style="width: 170px;">
                                        <span>Email</span>
                                    </th>

                                    <th class="datatable-cell datatable-cell-sort" style="width: 170px;">
                                        <span>Cargo</span>
                                    </th>

                                    <th class="datatable-cell datatable-cell-sort" style="width: 170px;">
                                        <span>Fecha registro</span>
                                    </th>

                                    <th class="datatable-cell datatable-cell-sort" style="width: 170px;">
                                        <span>Texto</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users">
                                    <td class="datatable-cell">
                                        @{{ user.name }}
                                    </td>

                                    <td class="datatable-cell">
                                        @{{ user.phone }}
                                    </td>

                                    <td class="datatable-cell">
                                        @{{ user.email }}
                                    </td>

                                    <td class="datatable-cell">
                                        @{{ user.cargo }}
                                    </td>

                                    <td class="datatable-cell">
                                        @{{ user.created_at.substring(0, 10) }}
                                    </td>

                                    <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".textModal" @click="showText(user)">
                                        Ver texto
                                    </button>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    <!--end: Datatable-->

                    <div class="row w-100">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="kt_datatable_info" role="status" aria-live="polite">Mostrando página @{{ currentPage }} de @{{ totalPages }}</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_full_numbers" id="kt_datatable_paginate">
                                <ul class="pagination">
                                    
                                    <li class="paginate_button page-item active" v-for="(link, index) in links">
                                        <a style="cursor: pointer" aria-controls="kt_datatable" tabindex="0" :class="link.active == false ? linkClass : activeLinkClass":key="index" @click="fetch(link.url)" v-html="link.label.replace('Previous', 'Anterior').replace('Next', 'Siguiente')"></a>
                                    </li>
                                    
                                    
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->

        <!-- Modal -->
        <div class="modal fade textModal" id="textModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Texto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@{{ clientText }}</p>
                </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')

    @include('prospects.script')

@endpush