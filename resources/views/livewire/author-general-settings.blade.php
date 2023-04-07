<div>
    <form action="post" wire:submit.prevent="updateGeneralSettings()">
        <div class="row">
            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label" for="">Blog Name</label>
                    <input type="text" class="form-control" placeholder="Enter Blog Name" wire:model="blog_name">
                    <span class="text-danger">@error('blog_name')
                        {{ $message }}
                    @enderror</span>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="">Blog Email</label>
                    <input type="email" class="form-control" placeholder="Enter Blog Email" wire:model="blog_email">
                    <span class="text-danger">@error('blog_email')
                        {{ $message }}
                    @enderror</span>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="">Blog Description</label>
                    <textarea cols="3" rows="3" class="form-control" placeholder="Enter Blog Description" wire:model="blog_description"></textarea>
                    <span class="text-danger">@error('blog_description')
                        {{ $message }}
                    @enderror</span>
                </div>                
                <div class="mb-3">
                    <button class="btn btn-primary">Save Changes</button>
                </div>

            </div>
        </div>
    </form>
</div>
