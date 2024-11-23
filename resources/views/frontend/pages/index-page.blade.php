@extends('frontend.layout.app')

@section('content')
    
    

   <!-- Include Components -->
   @include('frontend.components.home.site-title')

<div class="filter-section py-4">
    <div class="container">
        <form method="GET" action="{{ url('/') }}" class="filter-form row g-3">
            
            <!-- Category Selection -->
            <div class="col-md-4">
                <label for="category" class="form-label">Select Category</label>
                <select name="category" id="category" class="form-control">
                    <option selected disabled>Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date Selection -->
            <div class="col-md-4">
                <label for="date" class="form-label">Select Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
            </div>

            <!-- Submit Button -->
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <style>
    /* Custom styles for better appearance */
    .form-label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border: 2px solid #007bff; /* Change border color */
        border-radius: 0.5rem; /* Rounded corners */
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #0056b3; /* Darker blue on focus */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Focus shadow */
    }

    .custom-btn {
        background-color: #6c757d; /* Gray background */
        color: white; /* White text */
        border: none; /* No border */
        padding: 0.75rem 1.5rem; /* Padding */
        font-size: 1rem; /* Font size */
        border-radius: 0.5rem; /* Rounded corners */
        transition: background-color 0.3s, transform 0.2s; /* Transition effects */
    }

    .custom-btn:hover {
        background-color: #5a6268; /* Darker gray on hover */
        transform: translateY(-2px); /* Slight lift effect */
    }

    .custom-btn:active {
        transform: translateY(0); /* Reset lift effect on click */
        background-color: #4e555b; /* Even darker gray on active */
    }
</style>
            
        </form>
    </div>
</div>

    @include('frontend.components.home.feature')
    @include('frontend.components.home.recent')
    @include('frontend.components.home.footer')
@endsection
