<div>


  <div class="page-header d-print-none mb-3">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Authors
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="d-flex">
            <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…" wire:model="search">
            <a href="#" class="btn btn-primary" data-bs-target="#add_author_modal" data-bs-toggle="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
              </svg>
              Add Author
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Cart Row --}}

  <div class="row row-cards">

    @forelse ($authors as $author)

    <div class="col-md-6 col-lg-3">
      <div class="card">
        <div class="card-body p-4 text-center">
          <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{ $author->picture }})"></span>
          <h3 class="m-0 mb-1"><a href="#">{{ $author->name }}</a></h3>
          <div class="text-muted">{{ $author->username }}</div>
          <div class="mt-3">
            <span class="badge bg-purple-lt">{{ $author->authorType->name }}</span>
          </div>
        </div>
        <div class="d-flex">
          <a href="#" wire:click.prevent="editAuthor({{ $author }})" class="card-btn">Edit</a>
          <a href="#" class="card-btn" wire:click.prevent="deleteAuthor({{ $author }})">Delete</a>
        </div>
      </div>
    </div>

    @empty

    <span class="text-danger">No Author Found</span>

    @endforelse

  </div>

  <div class="row mt-4">
    {{ $authors->links('livewire::simple-bootstrap') }}
  </div>


  {{-- MODALS --}}
  <div class="modal modal-blur fade" id="add_author_modal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Author</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" wire:submit.prevent='addAuthor()' method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter Author Name" wire:model='name'>
              <span class="text-danger">@error('name') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" name="email" placeholder="Enter Author Email" wire:model='email'>
              <span class="text-danger">@error('email') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" placeholder="Enter Author Username" wire:model='username'>
              <span class="text-danger">@error('username') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
              <label class="form-label">Author Type</label>
              <div>
                <select class="form-select" wire:model="author_type">
                  <option value="">---No selected---</option>
                  @foreach (\App\Models\Type::all() as $type)
                  <option value="{{$type->id}}">{{ $type->name }}</option>
                  @endforeach
                </select>
              </div>
              <span class="text-danger">@error('author_type') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
              <div class="form-label">Is direct publisher?</div>
              <div>
                <label class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" wire:model="direct_publisher" value="0">
                  <span class="form-check-label">No</span>
                </label>
                <label class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" wire:model="direct_publisher" value="1">
                  <span class="form-check-label">Yes</span>
                </label>
              </div>
              <span class="text-danger">@error('direct_publisher') {{ $message }} @enderror</span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>


  {{-- Edit Update MODALS --}}
  <div class="modal modal-blur fade" id="edit_author_modal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Author</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" wire:submit.prevent='updateAuthor()' method="post">
            <input type="hidden" class="form-control" wire:model="selected_author_id">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter Author Name" wire:model='name'>
              <span class="text-danger">@error('name') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" name="email" placeholder="Enter Author Email" wire:model='email'>
              <span class="text-danger">@error('email') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" placeholder="Enter Author Username" wire:model='username'>
              <span class="text-danger">@error('username') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
              <label class="form-label">Author Type</label>
              <div>
                <select class="form-select" wire:model="author_type">
                  @foreach (\App\Models\Type::all() as $type)
                  <option value="{{$type->id}}">{{ $type->name }}</option>
                  @endforeach
                </select>
              </div>
              <span class="text-danger">@error('author_type') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
              <div class="form-label">Is direct publisher?</div>
              <div>
                <label class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" wire:model="direct_publisher" value="0">
                  <span class="form-check-label">No</span>
                </label>
                <label class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" wire:model="direct_publisher" value="1">
                  <span class="form-check-label">Yes</span>
                </label>
              </div>
              <span class="text-danger">@error('direct_publisher') {{ $message }} @enderror</span>
            </div>

            <div class="mb-3">
              <div class="form-label">Blocked</div>
              <label class="form-check form-switch">
                <input class="form-check-input" type="checkbox" checked="" wire:model="blocked">
                <span class="form-check-label">Option 1</span>
              </label>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>


</div>


