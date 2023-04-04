<div>
    <form method="post" wire:submit.prevent="changePassword()">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Current password" wire:model="current_password">
                </div>
                <span class="text-danger"> @error('current_password'){{ $message }}@enderror </span>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" placeholder="New password" wire:model="new_password">
                </div>
                <span class="text-danger"> @error('new_password'){{ $message }}@enderror </span>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Retype New Password</label>
                    <input type="password" class="form-control" name="retype_new_password" placeholder="Retype new password" wire:model="confirm_new_password">
                </div>
                <span class="text-danger"> @error('confirm_new_password'){{ $message }}@enderror </span>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Save Changes</button>
    </form>
</div>
