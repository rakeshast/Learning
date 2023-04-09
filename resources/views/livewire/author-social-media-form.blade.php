<div>
    <form method="post" wire:submit.prevent="updateBlogSocialMedia()">
        <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
            <label class="form-label">Facebook</label>
            <input name="facebook" type="text" class="form-control" placeholder="Facebook page Url" wire:model="facebook_url">
            <span class="text-danger">@error('facebook_url'){{ $message }}@enderror</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
            <label class="form-label">Youtube</label>
            <input name="youtube" type="text" class="form-control" placeholder="Youtube Url" wire:model="youtube_url">
            <span class="text-danger">@error('youtube_url'){{ $message }}@enderror</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
            <label class="form-label">Instagram</label>
            <input name="instagram" type="text" class="form-control" placeholder="Instagram Url" wire:model="instagram_url">
            <span class="text-danger">@error('instagram_url'){{ $message }}@enderror</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
            <label class="form-label">LinkedIn</label>
            <input name="linkedin" type="text" class="form-control" placeholder="LinkedIn Url" wire:model="linkedin_url">
            <span class="text-danger">@error('linkedin_url'){{ $message }}@enderror</span>
            </div>
        </div>
        
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
