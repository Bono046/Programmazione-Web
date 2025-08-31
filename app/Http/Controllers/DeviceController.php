<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\DeviceModel;



class DeviceController extends Controller
{
  
    // Mostra tutti i dispositivi
    public function index()
    {
        $devices = Device::all();
        return view('devices.index', ['devices' => $devices]);
       // return view('devices.index', compact('devices'));
    }

    // Mostra il form per creare un nuovo dispositivo
    public function create()
    {
        $deviceModels = DeviceModel::all();
        $modelCategories = $deviceModels->pluck('category', 'id');
        $device = null;
        $isEdit = false;
        return view('devices.form', compact('device', 'deviceModels', 'modelCategories', 'isEdit'));
    }

    // Salva un nuovo dispositivo
    public function store(Request $request)
    {
        $request->validate([
            'imei' => 'required|unique:devices',
            'serial' => 'nullable',
            'iccid' => 'nullable',
            'device_model_id' => 'nullable|exists:device_models,id',
        ]);

        $data = $request->only(['imei', 'serial', 'iccid', 'device_model_id']);
        $data['category'] = null;
        if ($request->input('device_model_id')) {
            $deviceModel = DeviceModel::find($request->input('device_model_id'));
            if ($deviceModel && $deviceModel->category && $request->has('device_model_category_flag')) {
                $data['category'] = $deviceModel->category;
            }
        }
        Device::create($data);
        return redirect()->route('devices.index')->with('success', 'Device creato con successo!');
    }

    // Mostra i dettagli di un singolo dispositivo
    public function show(Device $device)
    {
        return view('devices.show', compact('device'));
    }

    // Mostra il form per modificare un dispositivo
    public function edit(Device $device)
    {
        $deviceModels = DeviceModel::all();
        $modelCategories = $deviceModels->pluck('category', 'id');
        $isEdit = true;
        return view('devices.form', compact('device', 'deviceModels', 'modelCategories', 'isEdit'));
    }

    // Aggiorna un dispositivo
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'imei' => 'required|unique:devices,serial,' . $device->id,
            'serial' => 'nullable',
            'iccid' => 'nullable',
            'device_model_id' => 'nullable|exists:device_models,id',
        ]);

        $data = $request->only(['imei', 'serial', 'iccid', 'device_model_id']);
        $data['category'] = null;
        if ($request->input('device_model_id')) {
            $deviceModel = DeviceModel::find($request->input('device_model_id'));
            if ($deviceModel && $deviceModel->category && $request->has('device_model_category_flag')) {
                $data['category'] = $deviceModel->category;
            }
        }
        $device->update($data);
        return redirect()->route('devices.index')->with('success', 'Device aggiornato con successo!');
    }

    // Elimina un dispositivo
    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')->with('success', 'Device eliminato!');
    }


    
}
