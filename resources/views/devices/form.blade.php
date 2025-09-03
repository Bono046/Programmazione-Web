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
        <input type="text" name="serial" id="serial" class="form-control" value="{{ old('serial', $device->serial ?? '') }}">
    </div>

    <div class="mb-3 col-md-6">
        <label for="iccid" class="form-label">ICCID</label>
        <input type="text" name="iccid" id="iccid" class="form-control" value="{{ old('iccid', $device->iccid ?? '') }}">
    </div>

    <div class="row">
        <div class="mb-3 d-flex align-items-end" style="gap: 1rem;">
            <div class="col-md-6" style="flex:1;">
                <label for="device_model_id" class="form-label">Modello</label>
                <select class="form-select" name="device_model_id" id="device_model_id" required>
                    <option value="">-- Seleziona Modello --</option>
                    @foreach($deviceModels as $model)
                        <option value="{{ $model->id }}" {{ old('device_model_id', $device->device_model_id ?? '') == $model->id ? 'selected' : '' }}>
                            {{ $model->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <div id="category-checkbox-container" style="display:none; white-space:nowrap; align-items:end;">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" name="device_model_category_flag" id="device_model_category_flag" style="margin-right:0.5rem;">
                        <label class="form-check-label mb-0" for="device_model_category_flag">
                            <span id="category-label" style="font-weight:500;"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="device_current_category" value="{{ $isEdit ? ($device->category ?? '') : '' }}">

    <button type="submit" class="btn btn-success">
        <i class="bi bi-save"></i> {{ $isEdit ? 'Aggiorna' : 'Salva' }}
    </button>
    <a href="{{ route('devices.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Annulla
    </a>
</form>




<script>
$(function () {
    const $modelSelect       = $("#device_model_id");
    const $checkboxContainer = $("#category-checkbox-container");
    const $categoryLabel     = $("#category-label");
    const $categoryCheckbox  = $("#device_model_category_flag");
    const currentCategory    = $("#device_current_category").val();

    function resetCategory() {
        $checkboxContainer.hide();
        $categoryLabel.text("");
        $categoryCheckbox.prop("checked", false);
    }

    function updateCategory(modelId) {
        if (!modelId) {
            resetCategory();
            return;
        }

        $.ajax({
            url: "/device-models/" + modelId + "/category", type: "GET", dataType: "json",
            success: function (response) {
                if (response && response.category) {
                    $categoryLabel.text(response.category);
                    $checkboxContainer.show();
                    $categoryCheckbox.prop("checked", response.category === currentCategory);
                } else {
                    resetCategory();
                }
            },
            error: function () {
                resetCategory();
            }
        });
    }

    $modelSelect.on("change", function () {
        updateCategory($(this).val());
    });

    if ($modelSelect.val()) {
        updateCategory($modelSelect.val());
    } else {
        resetCategory();
    }
});
</script>
@endsection

