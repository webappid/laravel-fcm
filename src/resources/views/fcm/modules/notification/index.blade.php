@extends('coreui::layouts.app')

@section('page_title','Notification List')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Notification List
                    </div>
                    <div class="card-body p-4">
                        <x-coreui-smart-alert />
                        <div class="row">
                            <div class="col-md-8">
                                <form class="form-horizontal">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-coreui-input-text :props="$search" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-coreui-button :props="$searchButton" />
                                            <x-coreui-button :props="$addButton" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <x-coreui-table :props="$datas" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
