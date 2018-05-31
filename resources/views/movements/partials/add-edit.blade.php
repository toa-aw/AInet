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
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '1' )}} value="1">food</option>
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '2' )}} value="2">clothes</option>
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '3' )}} value="3">services</option>
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '4' )}} value="4">electricity</option>
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '5' )}} value="5">phone</option>
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '6' )}} value="6">fuel</option>
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '7' )}} value="7">insurance</option>
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '8' )}} value="8">entertainment</option>
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '9' )}} value="9">culture</option>
        <option {{is_selected(old('movement_category_id', $movement->movement_category_id), '10' )}} value="10">trips</option>
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
