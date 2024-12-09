<div class="modal fade" id="resetPassword{{ $us->id }}" aria-hidden="true" aria-labelledby="..." tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <lord-icon
                    src="/tdrtiskw.json"
                    trigger="loop"
                    colors="primary:#f7b84b,secondary:#405189"
                    style="width:130px;height:130px">
                </lord-icon>
                <div class="mt-4 pt-4">
                    <h4>Yakin mereset password user ini?</h4>
                    <!-- Toogle to second dialog -->
                    <a href="{{ route('user.reset-password', $us->id) }}" type="button"><span class="badge bg-warning" style="font-size:14px">Reset</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
