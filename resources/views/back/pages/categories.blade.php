@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : "Categories")
@section('content')

<div class="page-header d-print-none"> 
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Categories & Subcategories
            </h2>
        </div>
    </div>
</div>
@livewire('categories')

@endsection

@push('scripts')
    <script>
        
        window.addEventListener('hideCategoriesModal', function(e){
            $('#categories-modal').modal('hide');
        });
        window.addEventListener('showCategoriesModal', function(e){
            $('#categories-modal').modal('show');
        });
        window.addEventListener('hideSubCategoriesModal', function(e){
            $('#subcategories-modal').modal('hide');
        });
        window.addEventListener('showSubCategoriesModal', function(e){
            $('#subcategories-modal').modal('show');
        });

        $("#categories-modal, #subcategories-modal").on("hidden.bs.modal", function() {
            // $(this).find('form').trigger('reset');
            Livewire.emit('resetDefault');
        });

    </script>
@endpush