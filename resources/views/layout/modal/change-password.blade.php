<div id="changePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="changePasswordTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordTitle">Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.change-password') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="passwordLama">Password Lama</label>
                        <input type="password" class="form-control" id="passwordLama" name="password_lama" placeholder="Masukkan password lama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="passwordBaru">Password Baru</label>
                        <input type="password" class="form-control" id="passwordBaru" name="password_baru" placeholder="Masukkan password baru" required>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
