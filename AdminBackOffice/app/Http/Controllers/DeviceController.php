<?php

namespace App\Http\Controllers;


use App\Device;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('devices');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDevices()
    {
        return DataTables::of(Device::query())
            ->setRowId(function ($device) {
                return $device->ID;
            })
            ->addColumn('MetricsCount', function (Device $device) {
                return $device->metrics->count();
            })
            ->addColumn('Actions', function (Device $device) {
                return '<button type="button" class="btn-edit-user btn btn-primary btn-sm" data-toggle="modal" data-target="#userModal">Edit</button>' .
                    '<button type="button" class="btn-remove-user btn btn-danger btn-sm ml-2" ' . (!$device->user ? 'disabled' : '') . '>Remove</button>';
            })
            ->editColumn('User_ID', function (Device $device) {
                if (!$device->user) return '<span data-user-id></span>';
                return '<span data-user-id="' . $device->user->ID . '">' . $device->user->FirstName . ' ' . $device->user->LastName . '</span>';
            })
            ->rawColumns(['Actions', 'User_ID'])
            ->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function addUser(Request $request)
    {
        try {
            Device::where('ID', $request['device_id'])->update(array('User_ID' => $request['user_id']));
            $user = User::find($request['user_id']);
            return response()->json([
                'success' => __('User successfully updated'),
                'data' => [
                    'user_id' => $user->ID,
                    'user_name' => $user->FirstName . " " . $user->LastName
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('An error occured : ' . $e)]);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function removeUser(Request $request)
    {
        try {
            Device::where('ID', $request['device_id'])->update(array('User_ID' => null));
            return response()->json([
                'success' => __('User successfully removed')
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('An error occured : ' . $e)]);
        }

    }
}
