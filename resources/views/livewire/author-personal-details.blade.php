<div>
    <form method="post" wire:submit.prevent="updateDetails()">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="example-text-input" placeholder="Name" wire:model="name">
                </div>
                <span class="text-danger"> @error('name'){{ $message }}@enderror </span>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="example-text-input" placeholder="Username" wire:model="username">
                </div>
                <span class="text-danger"> @error('username'){{ $message }}@enderror </span>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="example-text-input" placeholder="Email" disabled wire:model="email">
                </div>
                <span class="text-danger"> @error('email'){{ $message }}@enderror </span>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Biography</label>
            <textarea class="form-control" name="biography" rows="6" placeholder="Biography.." wire:model="biography"></textarea>
        </div>
        <span class="text-danger"> @error('biography'){{ $message }}@enderror </span>
        <button class="btn btn-primary" type="submit">Save Changes</button>
    </form>
</div>
