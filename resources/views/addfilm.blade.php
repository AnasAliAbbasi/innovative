@extends('front_layout')

@section('content')
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <div class="max-w-7xl mx-auto p-6 lg:p-8">

        <h1 class="text-center mb-5">Add Film</h1>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Movie</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>

                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" required></textarea>

                                @error('description')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="release_date">Release Date</label>
                                <input type="date" name="release_date" id="release_date" class="form-control" required>
                                @error('release_date')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <input type="number" name="rating" id="rating" class="form-control" step="0.1" min="0" max="10" required>
                                @error('rating')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ticket_price">Ticket Price</label>
                                <input type="number" name="ticket_price" id="ticket_price" class="form-control" step="0.01" min="0" required>
                                @error('ticket_price')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country" class="form-control" required>
                                @error('country')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control-file" required>
                                @error('image')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" style="color:black" class="btn btn-danger mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>







        <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                <div class="flex items-center gap-4">
                    <a href="https://github.com/sponsors/taylorotwell" class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="-mt-px mr-1 w-5 h-5 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        Sponsor
                    </a>
                </div>
            </div>

            <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>


    </div>
</div>




@endsection
