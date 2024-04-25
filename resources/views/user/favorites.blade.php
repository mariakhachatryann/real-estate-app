@extends('components.layout')
@section('layout')
    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Favorite Listings</h2>
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Favorite Listings</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @include('components.manageAcc')
            <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">

            <div class="col-md-8">
                <table class="manage-table bookmarks-table responsive-table">

                    <tr>
                        <th><i class="fa fa-file-text"></i> Favorite Property</th>
                        <th></th>
                    </tr>

                    <!-- Item #1 -->
                    @foreach($favoriteProperties as $fav)
                        <tr>
                            <td class="title-container">
                                <img src="{{ asset('storage/' . $fav->property->images[0]->path) }}" alt="">
                                <div class="title">
                                    <h4><a href="{{ route('properties.show', $fav->property->id) }}">{{ $fav->property->title }}</a></h4>
                                    <span>{{ $fav->property->address->address }}</span>
                                    <span class="table-property-price">${{ number_format($fav->property->price) }}</span>
                                </div>
                            </td>
                            <td class="action">
                                <form action="{{ route('remove', $fav->property_id) }}" method="post" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete" style="border: none; background: none; padding: 0; color: red;" onclick="return confirm('Are you sure you want to remove this property from favorites?')">
                                        <i class="fa fa-remove"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
