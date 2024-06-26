@extends('components.layout')
@section('layout')
    <!-- Titlebar
    ================================================== -->
    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>My Properties</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="/properties">Home</a></li>
                            <li>My Properties</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>

    <!-- Content
    ================================================== -->
    <div class="container">
        <div class="row">


            <!-- Widget -->
            @include("components.manageAcc")


            <div class="col-md-8">
                <table class="manage-table responsive-table">

                    <tr>
                        <th><i class="fa fa-file-text"></i> Property</th>
                        <th class="expire-date"><i class="fa fa-calendar"></i> Expiration Date</th>
                        <th></th>
                    </tr>

                    <!-- Item #1 -->
                    @foreach($properties as $property)
                        <tr>
                            <td class="title-container">
                                <img src="{{ asset('storage/' . $property->images[0]->path) }}" alt="">
                                <div class="title">
                                    <h4><a href="/properties/{{$property->id}}">{{ $property->title }}</a></h4>
                                    <span>{{ $property->address->address }}</span>
                                    <span class="table-property-price">For {{ App\Models\Property::STATUSES[$property->status] }} / ${{ $property->price }}</span>
                                </div>
                            </td>
                            <td class="expire-date">{{ $property->created_at->addMonth()->format('Y-m-d H:i:s') }}</td>
                            <td class="action">
                                <a href="{{ route('properties.edit', $property->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="post" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete" style="border: none; background: none; padding: 0;" onclick="return confirm('Are you sure you want to delete this property?')">
                                        <i class="fa fa-remove"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <a href="{{ route('properties.create') }}" class="margin-top-40 button">Submit New Property</a>
            </div>

        </div>
    </div>
@endsection
