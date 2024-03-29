@csrf
<div class="form-group">
    <label for="inputType">{{ __('Movement Type') }}</label>
    <select name="type" id="inputType" class="form-control">
        <option disabled selected> -- select an option -- </option>
        <option {{is_selected(old('type', $movement->type), 'expense' )}} value="expense">Expense</option>
        <option {{is_selected(old('type', $movement->type), 'revenue' )}} value="revenue">Revenue</option>
    </select>
</div>

<div class="form-group">
    <label for="inputCategory">{{ __('Movement Category') }}</label>
    <select name="movement_category_id" id="inputCategory" class="form-control">
        <option disabled selected> -- select an option -- </option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '1' ) }} value="1">food</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '2' ) }} value="2">clothes</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '3' ) }} value="3">services</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '4' ) }} value="4">electricity</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '5' ) }} value="5">phone</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '6' ) }} value="6">fuel</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '7' ) }} value="7">mortgage payment</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '8' ) }} value="8">salary</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '9' ) }} value="9">bonus</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '10') }} value="10">royalties</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '11') }} value="11">interests</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '12') }} value="12">gifts</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '13') }} value="13">dividends</option>
        <option {{ is_selected(old('movement_category_id', $movement->movement_category_id), '14') }} value="14">product sales</option>
    </select>
</div>

<div class="form-group">
        <label for="date">{{ __('Date')}}</label>
        <input
            type="date" class="form-control"
            name="date" id="date"
            value="{{old('date', $movement->date) }}"
        />
</div>

<div class="form-group">
    <label for="inputValue">{{ __('Value') }}</label>
    <input
        type="text" class="form-control"
        name="value" id="inputValue"
        placeholder="Value" value="{{old('value', $movement->value) }}"/>
</div>

<div class="form-group">
    <label for="inputDescription">{{ __('Description') }}</label>
    <input
        type="text" class="form-control" 
        name="description" id="inputDescription" 
        placeholder="Description" value="{{old('description', $movement->description) }}"/> 
</div>

<div class="form-group">
    <label for="inputFile">{{ __('Document') }}</label>
        <input 
            type="file" class="form-control"
            name="document_file" id="inputFile"/>        
</div>

<div class="form-group">
        <label for="description">{{ __('Document Description') }}</label>        
        <input id="description" type="text" class="form-control{{ $errors->has('document_description') ? ' is-invalid' : '' }}" name="document_description" value="{{ old('document_description') }}" autofocus>
        @if ($errors->has('document_description'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('document_description') }}</strong>
            </span> 
        @endif        
</div>
