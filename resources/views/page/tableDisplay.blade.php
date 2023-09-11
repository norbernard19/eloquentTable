@extends('layouts.app')

@section('content')

<div class="container-table">
    <div class = "add-search">
        <form action="{{ route('search') }}" method="GET" >
            @csrf
            
            <select name="student_type" id="student_type" class="search">
                <option value="">All Students</option>
                <option value="local_student">Local Student</option>
                <option value="foreign_student">Foreign Student</option>
            </select>
            
            <button type="submit" class="search">Search</button>
        </form>


        <div class="button-add">
            
            <div class="button1">
                <a href="{{ route('add') }}" class="btn btn-secondary" id="button2">Add new Students</a>
            </div>
        </div>
    </div>
    <div class="title">
        <h2 class="title">Students</h2>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Student Type</th>
                    <th scope="col">Id_number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">City</th>
                    <th scope="col">Mobile Number</th>
                    <th scope="col">Grades</th>
                    <th scope="col">Email</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody id="mytable">
                
                @foreach ($myArray as $student)
                <tr>
                    <td class="content">{{ $student['student_type']}}</td>
                    <td class="content">{{ $student['id_number'] }}</td>
                    <td class="content">{{ $student['name'] }}</td>
                    <td class="content">{{ $student['age']}}</td>
                    <td class="content">{{ $student['gender'] }}</td>
                    <td class="content">{{ $student['city'] }}</td>
                    <td class="content">{{ $student['mobile_number']  }}</td>
                    <td class="content">{{ number_format($student['grades'], 2) }}</td>
                    <td class="content">{{ $student['email'] }}</td>
                    
                    <td>
                        <a href="{{route('edit', $student['id_number'])}}" class="edit-delete-button">Edit</a>
                    </td>
                   
                    <td class="delete-td">
                         
                        <form action="{{ route('delete', $student['id_number']) }}" method="POST" class="delete-form">
                            @csrf 
                            @method('DELETE')                   
                            <input class="edit-delete-button" id="delete-button" type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this record?');">
                        </form>
                        
                    </td>
                </tr>
                @endforeach

              
            </tbody>
        </table>
    </div>
    
</div>
@endsection
