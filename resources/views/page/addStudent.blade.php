@extends('layout.index')

@section('content')

<div class="container">

  <form action="{{route('store')}}" method="POST">
      @csrf
      <div id="feedback-form">
        <a href="{{route('home')}}">Cancel</a>
          <h2 class="header">Add Student</h2>
            @if($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
            @endif
              <label for="student_type">Student Type</label><br>
                <select name="student_type" id="student_type">
                    <option name="local_student" value="local_student" {{ old('student_type') == "local_student" ? "selected":'' }}>Local Student</option>
                    <option name="foreign_student" value="foreign_student" {{ old('student_type') == "foreign_student" ? "selected":'' }}>Foreign Student</option>
                </select>
              <div>

              </div>
              <br><label for="id_number">Id_number</label><br>
              <input class="input-form" type="text" name="id_number" id="id_number" placeholder="Id Number" value="{{ old('id_number') }}">
              <div>

              </div>
              <label for="name">Name</label><br>
              <input class="input-form" type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
              <div>

              </div>
              <label for="age">Age</label><br>
              <input class="input-form" type="number" name="age" id="age" placeholder="Age" value="{{ old('age') }}"><br>
              <div>

              </div>
              <label for="gender">Gender</label><br><br>
                <select name="gender" id="gender">
                    <option value="none" {{ old('gender') == "null" ? "selected":'' }}>Gender Reveal</option>
                    <option value="male" {{ old('gender') == "male" ? "selected":'' }}>Male</option>
                    <option value="female" {{ old('gender') == "female" ? "selected":'' }}>Female</option>
                </select><br>
              <div>

              </div>
              <label for="city">City</label><br>
              <input class="input-form" type="text" name="city" id="city" placeholder="City" value="{{ old('city') }}">
              <div>

              </div>
              <label for="mobile_number">Mobile Number</label><br>
              <input class="input-form" type="text" name="mobile_number" id="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number') }}">
              <div>

              </div>
              <label for="grades">Grades</label><br>
              <input class="input-form" type="text" name="grades" id="grades" placeholder="Grades" value="{{ old('grades') }}">
              <div>

              </div>
              <label for="email">Email</label><br>
              <input class="input-form" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
              <div>

              </div>
              <button type="submit" class="btn btn-primary">Add</button>
              </div>


      </div>
  </form>
</div>
@endsection
