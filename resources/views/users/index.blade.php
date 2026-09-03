@extends('layouts.app')

@section('title', 'Liste des utilisateurs')

@section('content')

<style>
    .table-container{
        background:#fff;
        padding:30px;
        border-radius:12px;
        box-shadow:0 5px 20px rgba(0,0,0,.1);
    }

    .header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    }

    .header h1{
        margin:0;
        color:#343a40;
    }

    .btn-add{
        background:#198754;
        color:#fff;
        text-decoration:none;
        padding:10px 18px;
        border-radius:7px;
        font-weight:bold;
    }

    .btn-add:hover{
        background:#157347;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    th{
        background:#343a40;
        color:white;
        padding:12px;
        text-align:left;
    }

    td{
        padding:12px;
        border-bottom:1px solid #ddd;
    }

    tr:hover{
        background:#f8f9fa;
    }

    .btn-edit{
        background:#0d6efd;
        color:white;
        text-decoration:none;
        padding:6px 12px;
        border-radius:5px;
        margin-right:5px;
    }

    .btn-delete{
        background:#dc3545;
        color:white;
        border:none;
        padding:6px 12px;
        border-radius:5px;
        cursor:pointer;
    }

    .alert{
        background:#d1e7dd;
        color:#0f5132;
        padding:12px;
        border-radius:6px;
        margin-bottom:20px;
    }
</style>

<div class="table-container">

    <div class="header">
        <h1>Liste des utilisateurs</h1>

        <a href="{{ route('users.create') }}" class="btn-add">
            + Nouvel utilisateur
        </a>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th width="170">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>

                        <a href="{{ route('users.edit',$user->id) }}" class="btn-edit">
                            Modifier
                        </a>

                        <form action="{{ route('users.destroy',$user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button class="btn-delete" onclick="return confirm('Supprimer cet utilisateur ?')">
                                Supprimer
                            </button>

                        </form>

                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="4" style="text-align:center;">
                        Aucun utilisateur enregistré.
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>

</div>

@endsection