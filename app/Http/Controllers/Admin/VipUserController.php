<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\UserVip;
use App\Models\VipLevel;
use App\Models\VipSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VipUserController extends Controller
{
    /**
     * Display a listing of the VIP users.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexListLevel()
    {
        $viplevels = VipLevel::all();
        return view('pages.admin.vip_users.indexListLevel', compact('viplevels'));
    }

    public function index()
    {
        $uservips = UserVip::with('user', 'vipLevel')->get();
        return view('pages.admin.vip_users.index', compact('uservips'));
    }

    /**
     * Show the form for creating a new VIP user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $vipLevels = VipLevel::all();
        return view('pages.admin.vip_users.create', compact('users', 'vipLevels'));
    }

    /**
     * Store a newly created VIP subscription in the database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,user_id',
            'vip_level_id' => 'required|exists:viplevels,vip_level_id',
            'start_date' => 'required|date|after_or_equal:' . now()->format('Y-m-d H:i:s'),
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,pending,expired',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $vipLevel = VipLevel::find($request->vip_level_id);
            if (!$vipLevel) {
                return redirect()->back()->with('error', 'VIP level not found.')->withInput();
            }
            UserVip::create([
                'user_id' => $request->user_id,
                'vip_level_id' => $request->vip_level_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'credits_remaining' => $vipLevel->credit_card_num,
            ]);

            return redirect()->route('admin.vip_users.create')->with('success', 'VIP subscription created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create VIP subscription. Please try again.' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $uservip = UserVip::with('user', 'vipLevel')->findOrFail($id);
        $users = User::all();
        $vipLevels = VipLevel::all();

        return view('pages.admin.vip_users.edit', compact('uservip', 'users', 'vipLevels'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,user_id',
            'vip_level_id' => 'required|exists:viplevels,vip_level_id',
            'start_date' => 'required|date|after_or_equal:' . now()->format('Y-m-d H:i:s'),
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,pending,expired',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $uservip = UserVip::findOrFail($id);
            $vipLevel = VipLevel::find($request->vip_level_id);

            if (!$vipLevel) {
                return redirect()->back()->with('error', 'VIP level not found.')->withInput();
            }

            $uservip->update([
                'user_id' => $request->user_id,
                'vip_level_id' => $request->vip_level_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'credits_remaining' => $vipLevel->credit_card_num, // Cập nhật lại credits từ VipLevel
                'status' => $request->status,
            ]);

            return redirect()->route('admin.vip_users.index')->with('success', 'VIP subscription updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update VIP subscription. Please try again.')->withInput();
        }
    }

    /**
     * Remove the specified VIP user from the database.
     */
    public function destroy($id)
    {
        try {
            $uservip = UserVip::findOrFail($id);
            $uservip->delete();

            return redirect()->route('admin.vip_users.index')->with('success', 'VIP subscription deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete VIP subscription. Please try again.');
        }
    }
}
