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
                          <form method="post" action="/addPackage" enctype="multipart/form-data">
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
                              <select name="choosePkg" class="form-class">
                              <option>Choose package</option>
                              <option value="Basic">Basic</option>
                              <option value="Standard">Standard</option>
                              <option value="Premium">Premium</option>
                            </select>
                            </div>
                            <!-- <div class="col-lg-2">
                            <input type="text" name="packageName" class="form-control" placeholder="Package Name">
                            </div> -->
                            <div class="col-lg-2">
                            <input type="text" name="packageCost" class="form-control" placeholder="Package Cost">
                            </div>
                            <div class="col-lg-2">
                            <input type="text" name="packageLimit" class="form-control" placeholder="Package Limit">
                            </div>
                            <div class="col-lg-2">
                            <input type="text" name="valueone" class="form-control" placeholder="Value One">
                            </div>
                            <div class="col-lg-2">
                            <input type="text" name="valuetwo" class="form-control" placeholder="Value Two">
                            </div>
                            <div class="col-lg-2">
                            <input type="text" name="valuethree" class="form-control" placeholder="Value Three">
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
                             <th>Package Name</th>
                             <th>Price</th>
                             <th>Limits</th>
                             <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($addPackage as $addPackage)
                              <tr>
                               <td> {{$addPackage->packageName}} </td>
                                <td> {{$addPackage->packageCost}} </td>
                                <td> {{$addPackage->packageLimit}} </td>
                                <td>
                                  <button class="btn btn-flat btn-success">Edit</button>
                                  <button class="btn btn-flat btn-danger">Delete</button>
                                 </td>
                              </tr>
                              @endforeach
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
