@extends('layouts.app')

@section('content')




<div id="content">
    <div class="wrap">
        <div class="head">
            <div class="info">
                <h1>Add New Category</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Top level</a>
                    </li>
                    <li class="active">Current level</li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">

                        <div class="content">
                          <form method="post" action="/aiChat" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              {{-- <div class="col-lg-2">
                                <select class="form-control" name="chatCategroy">
                                  <option>Select...</option>
                                  <option value="Normal">Normal</option>
                                  <option value="UnderWeight">UnderWeight</option>
                                  <option value="OverWeight">OverWeight</option>
                                  <option value="Obesity">Obesity</option>

                                </select>
                              </div> --}}
                            <div class="col-lg-2">
                            <input type="text" name="aiQuestion" class="form-control" placeholder="Ai Question">
                            </div>
                            <div class="col-lg-2">
                              <small>Accordind to your question user'll reply , so here yo provide action to help him in reply.<br> like :   [input], [btn],  [Yes/No] </small> <i title="for example :  Question : How are you , then users will reply as text so we need to choose [Text] option.

                              Question : Have you any problem ? then choose [Yes/No]
                              ">Help?</i>
                             <select name="aiAction" class="form-control" required>
                               <option>Choose action...</option>
                               <option value="submit">Add Button</option>
                               <option value="text">Input Box</option>
                               <option value="[Y,N]">Yes/No Option</option>
                             </select>
                            </div>
                            <div class="col-lg-2">
                            <input type="text" name="aiAnswer" class="form-control" placeholder="Ai Answer">
                            </div>
                            <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </div>
                          </form>
                        </div>
                        <br>

                        <div class="content">
                         <table style="width:100%;">
                           <thead>
                             <th>Question Image</th>
                             <th>Category Name</th>
                             <th>Category</th>
                             <th>Action</th>
                            </thead>
                            <tbody>
                              {{-- @foreach($question as $question)
                              <tr>
                                <td><img src="{{$question->questionImage}}" height="40" width="40"></td>
                                <td> {{$question->question}} </td>
                                <td> {{$question->questionCategory}} </td>
                                <td>
                                  <button class="btn btn-flat btn-success">Edit</button>
                                  <button class="btn btn-flat btn-danger">Delete</button>
                                 </td>
                              </tr>
                              @endforeach --}}
                            </tbody>
                         </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
