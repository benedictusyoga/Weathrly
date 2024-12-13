@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex flex-row justify-content-between align-items-end">
        <h1 class="display-5 mt-2 pt-1 mb-4 text-white fw-bold">Manage Customers</h1>
    </div>
    <form action="{{ route('manageuser') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search users by id, name, or username" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-sm" style="min-width:800px;">
            <thead class="table-dark" style="font-size:15px;">
                <tr>
                    <th scope="col">
                        <a href="{{ route('manageuser', ['sort' => 'id', 'direction' => ($sortColumn === 'id' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}" class="{{ $sortColumn === 'id' ? 'text-white' : '' }}">
                            @if($sortColumn === 'id')
                            @if($sortDirection === 'asc')
                            <i class="fas fa-sort-up"></i>
                            @else
                            <i class="fas fa-sort-down"></i>
                            @endif
                            @else
                            <i class="fas fa-sort"></i>
                            @endif
                            ID
                        </a>
                    </th>
                    <th scope="col">
                        <a href="{{ route('manageuser', ['sort' => 'username', 'direction' => ($sortColumn === 'username' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}" class="{{ $sortColumn === 'username' ? 'text-white' : '' }}">
                            @if($sortColumn === 'username')
                            @if($sortDirection === 'asc')
                            <i class="fas fa-sort-up"></i>
                            @else
                            <i class="fas fa-sort-down"></i>
                            @endif
                            @else
                            <i class="fas fa-sort"></i>
                            @endif
                            Username
                        </a>
                    </th>
                    <th scope="col">
                        <a href="{{ route('manageuser', ['sort' => 'name', 'direction' => ($sortColumn === 'name' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}" class="{{ $sortColumn === 'name' ? 'text-white' : '' }}">
                            @if($sortColumn === 'name')
                            @if($sortDirection === 'asc')
                            <i class="fas fa-sort-up"></i>
                            @else
                            <i class="fas fa-sort-down"></i>
                            @endif
                            @else
                            <i class="fas fa-sort"></i>
                            @endif
                            Name
                        </a>
                    </th>
                    <th scope="col">
                        <a href="{{ route('manageuser', ['sort' => 'age', 'direction' => ($sortColumn === 'age' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}" class="{{ $sortColumn === 'age' ? 'text-white' : '' }}">
                            @if($sortColumn === 'age')
                            @if($sortDirection === 'asc')
                            <i class="fas fa-sort-up"></i>
                            @else
                            <i class="fas fa-sort-down"></i>
                            @endif
                            @else
                            <i class="fas fa-sort"></i>
                            @endif
                            Age
                        </a>
                    </th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody style="font-size:15px;">
                @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->age }}</td>
                    <td>
                        <form action="{{ route('delete', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-1 flex-column gap-3">
        <!-- Showing Results Information -->
        <div class="px-4 py-2 bg-white text-dark rounded-pill">
            <p class="mb-0">Showing <strong>{{ $users->firstItem() }}</strong> to <strong>{{ $users->lastItem() }}</strong> of <strong>{{ $users->total() }}</strong> results</p>
        </div>

        <!-- Bootstrap Pagination Links -->
        <div>
            {{ $users->appends(['sort' => $sortColumn, 'direction' => $sortDirection])->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
<style>
    .table th a {
        color: #6c757d;
        /* Change text color for sort links */
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .table th a:hover {
        color: #007bff;
        /* Hover effect on sort links */
    }

    .table th a .fas {
        margin-left: 5px;
        /* Space between text and icon */
    }
</style>
@endsection