@csrf
<div class="form-group">
    <label for="inputType">Account Type</label>
    <select name="account_type_id" id="inputType" class="form-control">
        <option disabled selected> -- select an option -- </option>
        <option {{is_selected(old('account_type_id', $account->account_type_id), '1' )}} value="1">Bank Account</option>
        <option {{is_selected(old('account_type_id', $account->account_type_id), '2' )}} value="2">Pocket Account</option>
        <option {{is_selected(old('account_type_id', $account->account_type_id), '3' )}} value="3">PayPal Account</option>
        <option {{is_selected(old('account_type_id', $account->account_type_id), '4' )}} value="4">Credit Card</option>
        <option {{is_selected(old('account_type_id', $account->account_type_id), '5' )}} value="5">Metal Card</option>
    </select>
</div>

<div class="form-group">
    <label for="inputCode">Code</label>
    <input
        type="text" class="form-control"
        name="code" id="inputCode"
        placeholder="Code" value="{{old('code', $account->code) }}" />
</div>

<div class="form-group">
    <label for="inputStartBalance">Start Balance</label>
    <input
        type="text" class="form-control"
        name="start_balance" id="inputStartBalance"
        placeholder="Start Balance" value="{{old('start_balance', $account->start_balance) }}"/>
</div>

<div class="form-group">
    <label for="inputFullname">Description</label>
    <input
        type="text" class="form-control" 
        name="description" id="inputDescription" 
        placeholder="Description" value="{{old('description', $account->description) }}"/> 
</div>
