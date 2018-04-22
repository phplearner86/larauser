<p class="side-list-label">My account</p>

<ul class="list-group side-list">
    <li class="list-group-item side-list-group-item">
        <a href="{{ route('users.accounts.edit') }}" class="ml-6">
            Edit account
        </a>
    </li>

    <li class="list-group-item side-list-group-item">
        <form action="{{ route('users.accounts.destroy') }}" method="POST">
            @csrf
            @method("DELETE")

            <button type="submit" class="btn-delete-account" onclick="return confirm('Are you sure you want to delete your account?')">
                Delete account
            </button>
        </form>
    </li>
</ul>

<p class="side-list-label">My profile</p>
<ul class="list-group side-list">
    <li class="list-group-item side-list-group-item">
        <a href="#" class="ml-6">
            Update profile
        </a>
    </li>

    <li class="list-group-item side-list-group-item">
        <a href="#" class="ml-6">
            Change avatar
        </a>
    </li>
</ul>
