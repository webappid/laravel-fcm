@extends('coreui::layouts.app')

@section('page_title','Fcm Project Create')

@section('content')
    <div class="container">
        <div class="row justify-content-lg-start">
            <div class="col-md-12">
                <x-coreui-smart-alert/>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <strong>Create New</strong> Fcm Project
                    </div>
                    <form class="form-horizontal"
                          action="{{ route('lazy.admin.fcm-project.store',  request()->query->all()) }}" method="post"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group row">
                                <x-coreui-input-text :props="$inputName"/>
                            </div>
                            <div class="form-group row">
                                <x-coreui-input-text :props="$inputServerKey"/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <x-coreui-button-submit-group :props="$groupButton"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
