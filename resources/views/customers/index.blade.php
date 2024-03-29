@extends('layouts.layout')
@section('content')
<div class="page-header clearfix">
    <h2 class="pull-left">Customers</h2>
    <a href="/customers/new" class="btn btn-success pull-right">
        Create Customer</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
<?php foreach ($customers as $customer): ?>
    <tr>
        <td>
            <a href="/customers/edit/{{{ $customer->getId() }}}">
                {{{ $customer->getId() }}}</a>
        </td>
        <td>{{{ $customer->getName() }}}</td>
        <td>{{{ $customer->getEmail() }}}</td>
    </tr>
<?php endforeach; ?>
</table>
@stop