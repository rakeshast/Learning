<div>
    <div class="row mt-3">
        <div class="col-md-6 mb-2" >
            <div class="card">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs">
                    <h4>Categories</h4>
                    <li class="nav-item ms-auto">
                      <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#categories-modal">Add Category</a>
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
                          <tbody id="sortable_category">
                            @forelse ($categories as $category)
                                <tr data-index="{{$category->id}}" data-ordering="{{$category->ordering}}">
                                    <td>{{ $category->category_name }}</td>
                                    <td class="text-muted">{{ $category->subcategories->count() }}</td>
                                    <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-primary" wire:click.prevent="editCategory({{$category->id}})">Edit</a> &nbsp;
                                        <a href="#" wire:click.prevent="deleteCategory({{$category->id}})" class="btn btn-sm btn-danger">Delete</a>
                                    </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"><span class="text-danger">No Categories Found.</span></td>
                                </tr>
                            @endforelse
                            
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
                      <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#subcategories-modal">Add SubCategory</a>
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
                          <tbody id="sortable_subcategory">
                            @forelse ($subcategories as $subcategory)
                              <tr data-index="{{$subcategory->id}}" data-ordering="{{$subcategory->ordering}}">
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td class="text-muted">{{ $subcategory->parent_category != 0 ? $subcategory->parentcategory->category_name : ' - ' }}</td>
                                <td>{{ $subcategory->posts->count() }}</td>
                                <td>
                                  <div class="btn-group">
                                      <a href="#" class="btn btn-sm btn-primary" wire:click.prevent="editSubCategory({{$subcategory->id}})">Edit</a> &nbsp;
                                      <a href="#" wire:click.prevent="deleteSubCategory({{$subcategory->id}})" class="btn btn-sm btn-danger">Delete</a>
                                  </div>
                                </td>
                              </tr>
                            @empty
                            <tr>
                              <td colspan="4"><span class="text-danger">No SubCategory found.</span></td>
                            </tr>
                            @endforelse
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{--CATEGORY MODAL --}}
    
    <div class="modal modal-blur fade" id="categories-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyword="false" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="" @if ($updateCategoryMode)
            wire:submit.prevent='updateCategory()'
        @else
            wire:submit.prevent='addCategory()'
        @endif  method="post" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $updateCategoryMode ? 'Update Category' : 'Add Category' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if ($updateCategoryMode)
                <input type="hidden" name="selected_category_id" wire:model="selected_category_id">
            @endif
            <div class="mb-3">
              <label class="form-label">Category</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Enter category name" wire:model="category_name">
              <span class="text-danger">@error('category_name')
                  {{ $message }}
              @enderror</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal" id="MyModal">Close</button>
            <button type="submit" class="btn btn-primary">{{ $updateCategoryMode ? 'Update' : 'Save' }}</button>
          </div>
        </form>
      </div>
    </div>
    
    {{--SUBCATEGORY MODAL --}}
    
    <div class="modal modal-blur fade" id="subcategories-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyword="false" wire:ignore.self>
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="" @if ($updateSubCategoryMode)
            wire:submit.prevent='updateSubCategory()'
        @else
            wire:submit.prevent='addSubCategory()'
        @endif  method="post" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $updateSubCategoryMode ? 'Update SubCategory' : 'Add SubCategory' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if ($updateSubCategoryMode)
                <input type="hidden" wire:model="selected_subcategory_id">
            @endif
            <div class="mb-3">
                <div class="form-label">Parent Category</div>
                <select class="form-select" wire:model="parent_category">
                    
                    <option value="0">--Uncategorized--</option>
                    
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach 
                </select>
                <span class="text-danger">@error('parent_category')
                  {{ $message }}
                @enderror</span>
            </div>
            <div class="mb-3">
              <label class="form-label">SubCategory</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Enter subcategory name" wire:model="subcategory_name">
              <span class="text-danger">@error('subcategory_name')
                  {{ $message }}
              @enderror</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" >{{ $updateSubCategoryMode ? 'Update' : 'Save' }}</button>
          </div>
        </form>
      </div>
    </div>

</div>
