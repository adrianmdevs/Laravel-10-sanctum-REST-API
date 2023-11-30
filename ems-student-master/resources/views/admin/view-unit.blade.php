@extends('layouts.master')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{url('/admin/units')}}">Units</a></li>
    <li class="breadcrumb-item active">Unit</li>
@endsection
@section('title')
    {{$unit->name ?? ''}}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg border-bottom pb-1 ">
                    <li class="nav-item">
                        <a href="{{url('/admin/units/view/'.$unit->id)}}" aria-expanded="false"
                           class="nav-link active ">Unit info</a></li>
                    <li class="nav-item"><a href="{{url('admin/units/view/'.$unit->id.'/books')}}"
                                            aria-expanded="true"
                                            class="nav-link">E-Books</a></li>
                    <li class="nav-item"><a href="{{url('admin/units/view/'.$unit->id.'/exams')}}" aria-expanded="true"
                                            class="nav-link">Exams</a></li>
                    <li class="nav-item"><a href="{{url('admin/units/view/'.$unit->id.'/members')}}"
                                            aria-expanded="true"
                                            class="nav-link">Learners</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <form role="form" action="{{url('/admin/units/view/'.$unit->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="form-username">Unit name </label>
                                <input type="text" name="name" value="{{$unit->name ?? ''}}" class=" form-control">
                            </div>
                            <div class="form-group">
                                <label for="form-username">Unit Code</label>
                                <input type="text" name="unit_code" value="{{$unit->unit_code ?? ''}}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="form-username">Unit Cost </label>
                                <input type="number" name="price" value="{{$unit->price ?? ''}}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="form-username">Course <span class="text-danger">*</span></label>
                                <select name="course_id" class="form-control select2">
                                    @foreach($courses as $course)
                                        <option value="{{$course->id ?? ''}}" {{ ( $course->id == $unit->course_id ) ? 'selected' : '' }}>{{$course->name ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="form-username">Description</label>
                                <textarea name="description"
                                          class="form-control">{{$unit->description ?? ''}}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-lg">Update Details
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection