<section>
    <header style="margin-bottom: 20px;">
        <h2 style="font-size: 24px; font-weight: 800; color: white; margin: 0 0 8px;">
            Delete Account
        </h2>

        <p style="margin: 0; font-size: 14px; color: var(--muted);">
            Once deleted, your account cannot be recovered.
        </p>
    </header>

    <!-- DELETE BUTTON -->
    <button onclick="document.getElementById('deleteModal').style.display='block'"
        style="padding: 14px 22px; border-radius: 14px; font-weight: 700; background: #ff5f5f; color: white; border: none; cursor: pointer;">
        Delete Account
    </button>

    <!-- MODAL -->
    <div id="deleteModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
        <div style="background:#1e293b; padding:24px; border-radius:16px; width:400px;">

            <h2 style="color:white; margin-bottom:10px;">
                Confirm Deletion
            </h2>

            <p style="color: var(--muted); font-size:14px; margin-bottom:20px;">
                Enter your password to permanently delete your account.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <input type="password" name="password" placeholder="Password"
                    style="width:100%; padding:12px; border-radius:10px; margin-bottom:15px;">

                @error('password', 'userDeletion')
                    <p style="color:#ffb4b4; font-size:13px;">{{ $message }}</p>
                @enderror

                <div style="display:flex; justify-content:flex-end; gap:10px;">
                    <button type="button"
                        onclick="document.getElementById('deleteModal').style.display='none'"
                        style="padding:10px 16px; border-radius:10px; background:#ccc; border:none;">
                        Cancel
                    </button>

                    <button type="submit"
                        style="padding:10px 16px; border-radius:10px; background:#ff5f5f; color:white; border:none;">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
