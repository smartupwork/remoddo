<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BrandConfirmationStatus;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Http\Requests\Security\Main\RegistrationRequest;
use App\Models\Attribute;
use App\Models\Lender;
use App\Models\Page;
use App\Models\Product;
use App\Models\Role;
use App\Models\SupportAgent;
use App\Models\SupportAgentInfo;
use App\Models\User;
use App\Service\Admin\Datatable\ProductDatatable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.sections.support-agents.index');
        }

        return SupportAgent::dataTable(SupportAgent::query());
    }

    public function create()
    {
        return view('admin.sections.support-agents.create');
    }

    public function store(RegistrationRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'time_zone' => get_local_time(),
            ]);

            $user->info()->create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'avatar' => 'headphones-support-chat.svg'
            ]);

            SupportAgentInfo::create([
                'support_agent_id' => $user->id,
                'status_job' => true,
            ]);


            $role = Role::whereIn('name', [UserType::SUPPORTAGENT])->first();
            $user->roles()->attach($role->id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
        return $this->jsonSuccess('Support created successfully', [
            'redirect' => route('admin.supports.index')
        ]);
    }

    public function edit(SupportAgent $support)
    {
        return view('admin.sections.support-agents.edit',compact('support'));
    }

    public function update(SupportAgent $support, RegistrationRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $support->update([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'time_zone' => get_local_time(),
            ]);

            $support->info()->update([
                'name' => $data['name'],
                'surname' => $data['surname'],
            ]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
        return $this->jsonSuccess('Support updated successfully', [
            'redirect' => route('admin.supports.index')
        ]);
    }


    public function destroy(SupportAgent $support)
    {
        $support->delete();
        return $this->jsonSuccess('Support Agent deleted successfully', [
            'url' => route('admin.supports.index')
        ]);

    }


}
