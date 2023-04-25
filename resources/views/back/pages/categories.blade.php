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

        window.addEventListener('deleteCategory', function(event){
            swal.fire({
                title:event.detail.title,
                html:event.detail.html,
                showCancelButton:true,
                showCloseButton:true,
                cancelButtonText:'Cancel',
                confirmButtonText:"Yes, Delete",
                cancelButtonColor:"#d33",
                confirmButtonColor:"#3085d6",
                width:300,
                allowOutsideClick:false
            }).then(function(result){
                if (result.value) {
                    window.livewire.emit('deleteCategoryAction', event.detail.id);
                }
            });
        });

        window.addEventListener('deleteSubCategory', function(event){
            swal.fire({
                title:event.detail.title,
                html:event.detail.html,
                showCancelButton:true,
                showCloseButton:true,
                cancelButtonText:"Cancel",
                confirmButtonText:"Yes, Delete",
                cancelButtonColor:"#d33",
                confirmButtonColor:"#3085d6",
                width:300,
                allowOutsideClick:false
            }).then(function(result){
                if (result.value) {
                    window.livewire.emit('deleteSubCategoryAction', event.detail.id);
                }
            });
        });
        $('table tbody#sortable_category').sortable({
            update:function(event, ui){
                $(this).children().each(function(index){
                    if ($(this).attr("data-ordering") != (index+1)) {
                        $(this).attr('data-ordering', (index+1)).addClass("updated");
                    }
                });
                var positions = [];
                $(".updated").each(function(){
                    positions.push([$(this).attr("data-index"), $(this).attr('data-ordering')]);
                    $(this).removeClass("updated");
                });
                // alert(positions);
                window.livewire.emit('updatedCategoryOrdering', positions);
            }
        });
        $('table tbody#sortable_subcategory').sortable({
            update:function(event, ui){
                $(this).children().each(function(index){
                    if ($(this).attr("data-ordering") != (index+1)) {
                        $(this).attr('data-ordering', (index+1)).addClass("updated");
                    }
                });
                var positions = [];
                $(".updated").each(function(){
                    positions.push([$(this).attr("data-index"), $(this).attr('data-ordering')]);
                    $(this).removeClass("updated");
                });
                // alert(positions);
                window.livewire.emit('updatedSubCategoryOrdering', positions);
            }
        });
    </script>
@endpush