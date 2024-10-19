@extends('layouts.admin')
@section('page-title')
    {{__('Manage Leads')}}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dragula.min.css') }}" id="main-style-link">
@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/dragula.min.js') }}"></script>
    <script>
        !function (a) {
            "use strict";
            var t = function () {
                this.$body = a("body")
            };
            t.prototype.init = function () {
                a('[data-plugin="dragula"]').each(function () {
                    var t = a(this).data("containers"), n = [];
                    if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                    var r = a(this).data("handleclass");
                    r ? dragula(n, {
                        moves: function (a, t, n) {
                            return n.classList.contains(r)
                        }
                    }) : dragula(n).on('drop', function (el, target, source, sibling) {

                        var order = [];
                        $("#" + target.id + " > div").each(function () {
                            order[$(this).index()] = $(this).attr('data-id');
                        });

                        var id = $(el).attr('data-id');

                        var old_status = $("#" + source.id).data('status');
                        var new_status = $("#" + target.id).data('status');
                        var stage_id = $(target).attr('data-id');

                        $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                        $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);
                        $.ajax({
                            url: '{{route('leads.order')}}',
                            type: 'POST',
                            data: {
                                lead_id: id,
                                stage_id: stage_id,
                                order: order,
                                new_status: new_status,
                                old_status: old_status,
                                "_token": $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                            },
                            error: function (data) {
                                data = data.responseJSON;
                                show_toastr('error', data.error, 'error')
                            }
                        });
                    });
                })
            }, a.Dragula = new t, a.Dragula.Constructor = t
        }(window.jQuery), function (a) {
            "use strict";

            a.Dragula.init()

        }(window.jQuery);


    </script>
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Lead')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">

        {{ Form::close() }}


        <a href="{{ route('leads.list') }}" data-size="lg" data-bs-toggle="tooltip" title="{{__('List View')}}"
           class="btn btn-sm btn-primary">
            <i class="ti ti-list"></i>
        </a>
        <a href="#" data-size="lg" data-url="{{ route('leads.create') }}" data-ajax-popup="true"
           data-bs-toggle="tooltip" title="{{__('Create New Lead')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">

            @php
                foreach ($lead_stages as $lead_stage){

                    $json[] = 'task-list-'.$lead_stage->id;
                }
            @endphp
            <div class="row kanban-wrapper horizontal-scroll-cards" data-containers='{!! json_encode($json) !!}'
                 data-plugin="dragula">
                @foreach($lead_stages as $lead_stage)
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    <span class="btn btn-sm btn-primary btn-icon count">
                                        {{count($leads)}}
                                    </span>
                                </div>
                                <h4 class="mb-0">{{$lead_stage->name}}</h4>
                            </div>
                            <div class="card-body kanban-box" id="task-list-{{$lead_stage->id}}"
                                 data-id="{{$lead_stage->id}}">
                                @foreach($leads as $lead)
                                    @if ($lead->status == $lead_stage->name)
                                        <div class="card p-b-25" data-id="{{$lead->id}}">
                                            <div class="card-header border-0 pb-0 position-relative">
                                                <h5 class="p-2">
                                                    <a class="primary"
                                                       href="@can('view lead'){{route('leads.show',$lead->id)}}@endcan">{{$lead->name}} </a><br>
                                                </h5>
                                                <h5 class="p-2">
                                                    <a
                                                        href="@can('view lead'){{route('leads.show',$lead->id)}}@endcan">{{$lead->phone}} </a><br>
                                                </h5>
                                                <div class="card-header-right">
                                                    @if(Auth::user()->type != 'client')
                                                        <div class="btn-group card-option">
                                                            <button type="button" class="btn dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                            @can('edit lead')
                                                                <a href="#!" data-size="md"
                                                                   data-url="{{ URL::to('leads/'.$lead->id.'/view') }}"
                                                                   data-ajax-popup="true" class="dropdown-item"
                                                                   data-bs-original-title="{{__('View')}}">
                                                                    <i class="ti ti-bookmark"></i>
                                                                    <span>{{__('View')}}</span>
                                                                </a>

                                                                <a href="#!" data-size="lg"
                                                                   data-url="{{ URL::to('leads/'.$lead->id.'/edit') }}"
                                                                   data-ajax-popup="true" class="dropdown-item"
                                                                   data-bs-original-title="{{__('Edit Lead')}}">
                                                                    <i class="ti ti-pencil"></i>
                                                                    <span>{{__('Edit')}}</span>
                                                                </a>
                                                            @endcan
                                                            @can('delete lead')
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['leads.destroy', $lead->id],'id'=>'delete-form-'.$lead->id]) !!}
                                                                <a href="#!" class="dropdown-item bs-pass-para">
                                                                    <i class="ti ti-archive"></i>
                                                                    <span> {{__('Delete')}} </span>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            @endcan
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
