@extends('coreui::layouts.app')

@section('page_title','Fcm Project Edit')

@section('content')
    <div class="container">
        <div class="row justify-content-lg-start">
            <div class="col-md-12">
                @if (session('code')!=null)
                    <x-coreui-smart-alert/>
                @endif
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <strong>Update</strong> Fcm Project
                    </div>
                    <form class="form-horizontal"
                          action="{{ route('lazy.admin.fcm-project.update', array_merge(["id" => $fcmProject->id], request()->query->all())) }}"
                          method="post"
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
                            <x-button-submit-group
                                backurl="{{ route('lazy.admin.fcm-project.index', request()->query->all()) }}"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
