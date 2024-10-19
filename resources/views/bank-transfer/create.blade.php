{{ Form::open(array('url' => 'bank-transfer')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-6">
            {{ Form::label('sender_id', __('Sender'),['class'=>'form-label']) }}
            {{ Form::select('sender_id', $creditAccounts, null, ['class' => 'form-control select', 'required' => 'required']) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('receiver_id', __('Receiver'),['class'=>'form-label']) }}
            {{ Form::select('receiver_id', $debitAccounts, null, ['class' => 'form-control select', 'required' => 'required']) }}
        </div>
{{--        <div class="form-group  col-md-6">--}}
{{--            {{ Form::label('rate', __('Rate (Enter 4 decimal points)'),['class'=>'form-label']) }}--}}
{{--            {{ Form::text('rate', 1, array('class' => 'form-control','required'=>'required')) }}--}}
{{--        </div>--}}
        <div class="form-group  col-md-6">
            {{ Form::label('debit_amount', __('Debit Amount'),['class'=>'form-label']) }}
            {{ Form::text('debit_amount', '', array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('credit_amount', __('Credit Amount'),['class'=>'form-label']) }}
            {{ Form::text('credit_amount', '', array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('date', __('Date'),['class'=>'form-label']) }}
            {{Form::date('date',null,array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('reference', __('Reference'),['class'=>'form-label']) }}
            {{ Form::text('reference', '', array('class' => 'form-control')) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {{ Form::textarea('description', '', array('class' => 'form-control','rows'=>3)) }}
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}
