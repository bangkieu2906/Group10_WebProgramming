@extends('welcome')
@section('content')



<main class="main-content  mt-0 centered-form">
    <section>
    <div class="card-header pb-0 text-left bg-transparent">
        <br>
        <br>
      <h3 class="font-weight-bolder text-info text-gradient">Information</h3>

    </div>
    @foreach($user as $key => $value)
    <div class="card-body">
      <form action="{{ URL::to('/update-user',$value->id) }}" method="post">
        {{ csrf_field() }}
        
        <div class="mb-3">
            <label for="first_name">Name <span>*</span></label>
            <input name="name" type="text" class="form-control" id="name" value="{{ $value->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email_address">Email Address <span>*</span></label>
            <input readonly name="email" type="email" class="form-control" id="email_address" value="{{ $value->email }}">
        </div>
        <div class="mb-3">
            <label for="phone_number">Phone Number <span>*</span></label>
            <input name="phone" type="number" class="form-control" id="phone_number" min="0" value="{{ $value->phone }}">
        </div>
        <div class="mb-3">
            <label for="street_address">Address <span>*</span></label>
            <input name="address" type="text" class="form-control mb-3" id="address" value="{{ $value->address }}">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-success w-100 mt-4 mb-0">Save</button>
        </div>
         
      </form>
    </div>
    @endforeach
    </section>
  </main>
<style>
    .centered-form {
    margin: auto;
    width: 50%;
}
</style>

@endsection