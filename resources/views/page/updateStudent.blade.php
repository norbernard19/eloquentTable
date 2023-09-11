@extends('layout.index')

@section('content')
<div class="container">
    <a href="{{route('home')}}">Cancel</a>
  <form action="{{route('update', [$editStudent['id_number'], $editStudent['student_type']])}}" method="POST">
      @csrf
      @if($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      <div id="feedback-form">
          <h2 class="header">Update Student</h2>
          <div>
            
              <label for="student_type">Student Type</label><br>
                <select name="student_type" id="student_type">
                    <option value="local_student" {{$editStudent['student_type'] == 'local_student' ? 'selected' : ''}} >Local Student</option>
                    <option value="foreign_student" {{$editStudent['student_type'] == 'foreign_student' ? 'selected' : ''}} >Foreign Student</option>
                </select>
                
                
              <br><label for="id_number">Id_number</label><br>
              <input class="input-form" type="text" name="id_number" id="id_number" placeholder="Id Number" value="{{ $editStudent['id_number'] }}">
            

              <label for="name">Name</label><br>
              <input class="input-form" type="text" name="name" id="name" placeholder="Name" value="{{$editStudent['name']}}">
              
              <label for="age">Age</label><br>
              <input class="input-form" type="number" name="age" id="age" placeholder="Age" value="{{$editStudent['age']}}"><br>
            
              <label for="gender">Gender</label><br><br>
                <select name="gender" id="gender">
                    <option value="none" {{$editStudent['gender'] == null ? 'selected' : ''}}>Gender Reveal</option>
                    <option value="male" {{$editStudent['gender'] == 'male' ? 'selected' : ''}}>Male</option>
                    <option value="female" {{$editStudent['gender'] == 'female' ? 'selected' : ''}}>Female</option>
                </select><br>
              
              <label for="city">City</label><br>
              <input class="input-form" type="text" name="city" id="city" placeholder="City" value="{{$editStudent['city']}}">
           
              <label for="mobile_number">Mobile Number</label><br>
              <input class="input-form" type="text" name="mobile_number" id="mobile_number" placeholder="Mobile Number" value="{{$editStudent['mobile_number']}}">
            
              <label for="grades">Grades</label><br>
              <input class="input-form" type="number" name="grades" id="grades" step="0.01" placeholder="Grades" value="{{number_format($editStudent['grades'], 2)}}">
              
              <label for="email">Email</label><br>
              <input class="input-form" type="email" name="email" id="email" placeholder="Email" value="{{$editStudent['email']}}">
           
              <button type="submit" class="btn btn-primary">Add</button>
          </div>
      </div>
  </form>
</div>
@endsection