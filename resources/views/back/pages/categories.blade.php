@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : "Categories")
@section('content')

<div class="page-header d-print-none"> 
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Dashboard & Subcategories
            </h2>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6 mb-2" >
        <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <h4>Categories</h4>
                <li class="nav-item ms-auto">
                  <a href="#" class="btn btn-sm btn-primary">Add Category</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                      <thead>
                        <tr>
                          <th>Category Name</th>
                          <th>No. of Subcategories</th>
                          <th class="w-1">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>any name</td>
                          <td class="text-muted">4</td>
                          <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-2" >
        <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <h4>SubCategories</h4>
                <li class="nav-item ms-auto">
                  <a href="#" class="btn btn-sm btn-primary">Add SubCategory</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                      <thead>
                        <tr>
                          <th>SubCategory Name</th>
                          <th>Parent Category</th>
                          <th>No. of Posts</th>
                          <th class="w-1">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Any name</td>
                          <td class="text-muted">any category</td>
                          <td>4</td>
                          <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
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

{{-- MODAL --}}

<div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
        </div>
      </div>
    </div>

</div>



@endsection

