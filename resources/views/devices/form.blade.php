@extends('layouts.master')

@section('content')
<h2>{{ $isEdit ? 'Modifica Device' : 'Aggiungi un nuovo Device' }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $errore)
                <li>{{ $errore }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ $isEdit ? route('devices.update', $device) : route('devices.store') }}" method="POST">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

     <div class="mb-3 col-md-6">
        <label for="imei" class="form-label">IMEI</label>
        <input type="text" name="imei" id="imei" class="form-control" value="{{ old('imei', $device->imei ?? '') }}" required>
    </div>

    <div class="mb-3 col-md-6">
        <label for="serial" class="form-label">Serial</label>
        <input type="text" name="serial" id="serial" class="form-control" value="{{ old('serial', $device->serial ?? '') }}" >
    </div>

    <div class="mb-3 col-md-6">
        <label for="iccid" class="form-label">ICCID</label>
        <input type="text" name="iccid" id="iccid" class="form-control" value="{{ old('iccid', $device->iccid ?? '') }}">
    </div>

    <div class="row">
        <div class="mb-3 d-flex align-items-end" style="gap: 1rem;">
            <div class="col-md-6", style="flex:1;">
                <label for="device_model_id" class="form-label ">Modello</label>
                <select class="form-select" name="device_model_id" id="device_model_id" required>
                    <option value="">-- Seleziona Modello --</option>
                    @foreach($deviceModels as $model)
                        <option value="{{ $model->id }}" data-category="{{ $model->category }}" {{ old('device_model_id', $device->device_model_id ?? '') == $model->id ? 'selected' : '' }}>
                            {{ $model->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <div id="category-checkbox-container" style="display:none; white-space:nowrap; align-items: end;">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" name="device_model_category_flag" id="device_model_category_flag" style="margin-right: 0.5rem;">
                        <label class="form-check-label mb-0" for="device_model_category_flag">
                            <span id="category-label" style="font-weight: 500;"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">{{ $isEdit ? 'Aggiorna' : 'Salva' }}</button>
    <a href="{{ route('devices.index') }}" class="btn btn-secondary">Annulla</a>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modelSelected = document.getElementById('device_model_id');
    const checkboxContainer = document.getElementById('category-checkbox-container');
    const categoryFlag = document.getElementById('device_model_category_flag');
    const categoryLabel = document.getElementById('category-label');
    const modelCategories = @json($modelCategories);
    const isEdit = @json($isEdit);
    const deviceCategory = @json($device->category ?? null);

    function handleModelChange() {
        const modelId = modelSelected.value;
        if (modelId && modelCategories[modelId]) {
            checkboxContainer.style.display = '';
            categoryLabel.textContent = modelCategories[modelId];
            // Se edit e la categoria del device coincide con quella del modello, flagga
            if (isEdit && deviceCategory === modelCategories[modelId]) {
                categoryFlag.checked = true;
            } else {
                categoryFlag.checked = false;
            }
        } else {
            checkboxContainer.style.display = 'none';
            categoryLabel.textContent = '';
            categoryFlag.checked = false;
        }
    }

    modelSelected.addEventListener('change', handleModelChange);
    handleModelChange();

    document.querySelector('form').addEventListener('submit', function(e) {
        const modelId = modelSelected.value;
        if (modelId && modelCategories[modelId] && categoryFlag.checked) {
            let hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'device_model_category';
            hidden.value = modelCategories[modelId];
            this.appendChild(hidden);
        }
    });
});
</script>

@endsection
