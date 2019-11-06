{{-- @inject('unit', 'App\Unit') --}}
@if (Request::get('action') == 'create')
    {!! Form::open(['route' => 'products.store']) !!}
    {!! FormField::text('name', ['label' => __('product.name'), 'required' => true]) !!}
    {!! FormField::price('barcode', ['label' => __('product.barcode')]) !!}
    <div class="row">
        <div class="col-md-6">{!! FormField::price('pcs_price', ['label' => __('product.pcs_price')]) !!}</div>
        <div class="col-md-6">{!! FormField::price('dozen_price', ['label' => __('product.dozen_price')]) !!}</div>
        <div class="col-md-6">{!! FormField::price('pack_price', ['label' => __('product.pack_price')]) !!}</div>
        <div class="col-md-6">{!! FormField::price('box_price', ['label' => __('product.box_price')]) !!}</div>
    </div>
    {{-- {!! FormField::select('unit_id', $unit->pluck('name','id'), ['label' => __('product.unit'), 'required' => true]) !!} --}}
    {!! Form::submit(__('product.create'), ['class' => 'btn btn-success']) !!}
    {{ link_to_route('products.index', __('app.cancel'), [], ['class' => 'btn btn-default']) }}
    {!! Form::close() !!}
@endif
@if (Request::get('action') == 'edit' && $editableProduct)
    {!! Form::model($editableProduct, ['route' => ['products.update', $editableProduct->id],'method' => 'patch']) !!}
    {!! FormField::text('name', ['label' => __('product.name'), 'required' => true]) !!}
    <div class="row">
        <div class="col-md-6">{!! FormField::price('pcs_price', ['label' => __('product.pcs_price'), 'required' => true]) !!}</div>
        <div class="col-md-6">{!! FormField::price('dozen_price', ['label' => __('product.dozen_price'), 'required' => true]) !!}</div>
        <div class="col-md-6">{!! FormField::price('pack_price', ['label' => __('product.pack_price'), 'required' => true]) !!}</div>
        <div class="col-md-6">{!! FormField::price('box_price', ['label' => __('product.box_price'), 'required' => true]) !!}</div>
    </div>
    {{-- {!! FormField::select('unit_id', $unit->pluck('name','id'), ['label' => __('product.unit'), 'required' => true]) !!} --}}
    @if (request('q'))
        {{ Form::hidden('q', request('q')) }}
    @endif
    @if (request('page'))
        {{ Form::hidden('page', request('page')) }}
    @endif
    {!! Form::submit(__('product.update'), ['class' => 'btn btn-success']) !!}
    {{ link_to_route('products.index', __('app.cancel'), Request::only('q'), ['class' => 'btn btn-default']) }}
    {!! Form::close() !!}
@endif
@if (Request::get('action') == 'delete' && $editableProduct)
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">{{ __('product.delete') }}</h3></div>
        <div class="panel-body">
            <table class="table table-condensed">
                <tbody>
                    <tr><th>{{ __('product.name') }}</th><td>{{ $editableProduct->name }}</td></tr>
                    <tr><th>{{ __('product.barcode') }}</th><td>{{ $editableProduct->barcode }}</td></tr>
                    <tr><th>{{ __('product.pcs_price') }}</th><td>{{ format_rp($editableProduct->pcs_price) }}</td></tr>
                    <tr><th>{{ __('product.dozen_price') }}</th><td>{{ format_rp($editableProduct->dozen_price) }}</td></tr>
                    <tr><th>{{ __('product.pack_price') }}</th><td>{{ format_rp($editableProduct->pack_price) }}</td></tr>
                    <tr><th>{{ __('product.box_price') }}</th><td>{{ format_rp($editableProduct->box_price) }}</td></tr>
                </tbody>
            </table>
            <hr>
            {{ __('product.delete_confirm') }}
        </div>
        <div class="panel-footer">
            {!! FormField::delete(['route'=>['products.destroy',$editableProduct->id]], __('app.delete_confirm_button'), [
                'class'=>'btn btn-danger'
            ], [
                'product_id'=>$editableProduct->id,
                'page' => request('page'),
                'q' => request('q'),
            ]) !!}
            {{ link_to_route('products.index', __('app.cancel'), Request::only('q'), ['class' => 'btn btn-default']) }}
        </div>
    </div>
@endif