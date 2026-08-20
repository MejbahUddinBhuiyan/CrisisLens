<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
public function index(): View
{
    $users = User::query()
        ->with('roles')
        ->when(request('search'), function ($query, $search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        })
        ->when(request('role'), function ($query, $role) {
            $query->whereHas('roles', function ($roleQuery) use ($role) {
                $roleQuery->where('name', $role);
            });
        })
        ->when(request('verification') === 'verified', function ($query) {
            $query->whereNotNull('email_verified_at');
        })
        ->when(request('verification') === 'unverified', function ($query) {
            $query->whereNull('email_verified_at');
        })
        ->when(request('date'), function ($query, $date) {
            $query->whereDate('created_at', $date);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $roles = Role::query()
        ->orderBy('name')
        ->get();

    return view('admin.users.index', compact('users', 'roles'));
}

    public function create(): View
    {
        $roles = Role::query()
            ->whereIn('name', [
                'Citizen',
                'Emergency Responder',
                'Authority Administrator',
                'Super Administrator',
            ])
            ->orderBy('name')
            ->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        $user->syncRoles([$validated['role']]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'role' => $validated['role'],
            ])
            ->log('admin_created_user');

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        $roles = Role::query()
            ->whereIn('name', [
                'Citizen',
                'Emergency Responder',
                'Authority Administrator',
                'Super Administrator',
            ])
            ->orderBy('name')
            ->get();

        $user->load('roles');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(StoreUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);
        $user->syncRoles([$validated['role']]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties([
                'role' => $validated['role'],
            ])
            ->log('admin_updated_user');

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }
}