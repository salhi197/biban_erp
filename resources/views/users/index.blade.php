@extends('layouts.admin')



@section('content')

<div class="container-fluid">

                        <h1 class="mt-4">
                            <h4 class="page-title">
                                La Liste des Utilsiateurs
                            </h4>

                        </h1>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a class="btn btn-primary" href="{{route('user.show.create')}}">
                                        <i class="fa fa-plus"></i>
                                        Ajouter 
                                    </a>
                            </div>

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>

                                                <th>ID Commercial</th>

                                                <th>Nom et Prénom  </th>
                                                <th>Login</th>

                                                <th>actions</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @if(count($users) > 0)

                                                @foreach($users as $user)                                            

                                                <tr>

                                                    <td>{{$user->id ?? ''}}</td>

                                                    <td>{{$user->nom_prenom ?? ''}}</td>


                                                    <td>{{$user->email ?? ''}}</td>


                                                    <td >

                                                        <div class="table-action">  

                                                        <a  

                                                        href="{{route('user.destroy',['id_user'=>$user->id])}}"

                                                        onclick="return confirm('etes vous sure  ?')"

                                                        class="btn btn-danger">

                                                                <i class="fa fa-edit"></i> supprimer 

                                                        </a>

                                                        <a 

                                                        href="{{route('user.edit',['id_user'=>$user->id])}}"

                                                        class="btn btn-primary">

                                                                <i class="fa fa-edit"></i> Modifer 

                                                        </a>

                                                        </div>

                                                    </td>



                                                </tr>

                                                @endforeach

                                            

                                            @else

                                            <tr>

                                                <td colspan="7" class="text-center">

                                                <p>la liste des commerciaux est vide </p>



                                                </td>

                                            </tr>



                                            @endif





                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>





@endsection