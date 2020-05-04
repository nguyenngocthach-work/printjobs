@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-12">
                <table class="col-12">
                    <tr class="header" style="border-style:solid; border-color: #fff; height: 70px; background-color: #304b9b; color: #b4b3b3; font-size: 16px">
                        <th width="5%" align="center">&nbsp;&nbsp;<input type="button" value="+" data-toggle="modal" data-target=".bd-example-modal-lg"></th>
                        <th width="5%" align="center">&nbsp;&nbsp;Auftragsnummer</th>
                        <th width="10%" align="center">&nbsp;&nbsp;Kunde</th>
                        <th width="15%" align="center">Projektname</th>
                        <th width="7%" align="center">Lieferant</th>
                        <th width="5%" align="center">Auflage</th>
                        <th width="7%" align="center">Liefertermin</th>
                        <th width="10%" align="center">Lagerort</th>
                        <th width="5%" align="center">Angekommen</th>
                    </tr>
                    @if( !empty($listJob))

                        @foreach($listJob  as $job)
                            @if($job['parent_id']==0 && !empty($job['subjob'][0]) )
                                @if ($job['status'] == 1)
                                    <?php
                                        $bg= "#6887e3";
                                        $check = "checked";
                                    ?>
                                @else
                                    <?php
                                        $bg= "#717170";
                                        $check = "";
                                    ?>
                                @endif
                                <tr class="pt-1" style="color:#fff; background-color: {{ $bg }}; height: 40px; border-style:solid; border-color: #fff;" >
                                    <td width="5%" align="center"><input type="button" value="Add" name="addsub" data-toggle="modal" data-target=".bd-example-modal-lg-sub">&nbsp;&nbsp; <input type="button" id="edit-master" value="Edit" name="editmaster" data-toggle="modal" data-target=".bd-example-modal-lg-sub"></td>
                                    <td align="center">{{ $job['order_number'] }}</td>
                                    <td>{{ $job['customer'] }}</td>
                                    <td>{{ $job['project_name'] }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="center"><input type="checkbox" name="status" value="1" checked disabled ></td>
                                </tr>
                                @foreach($job['subjob'] as $subjob)
                                     @if ($subjob['status'] == 1)
                                         <?php
                                            $bgsub= "#6887e3";
                                            $checksub ="checked";
                                         ?>
                                         @else
                                        <?php
                                            $bgsub= "#fff";
                                            $checksub ="";
                                            ?>
                                    @endif
                                    <tr class="pt-1" style="color:#1d1d1b; background-color: {{$bgsub}}; height: 40px; font-size: 16px border-style:solid; border-color: #fff;" >
                                        <td align="center" bgcolor="#fff">&nbsp;</td>
                                        <td align="center" bgcolor="#fff">&nbsp;</td>
                                        <td bgcolor="#fff" align="right"><input type="button" id= "edit-sub" value="Edit" name="editsub" data-toggle="modal" data-target=".bd-example-modal-lg-sub"> &nbsp;&nbsp; </td>
                                        <td>&nbsp;&nbsp;{{ $subjob['project_name'] }}</td>
                                        <td>{{ $subjob['supplier'] }}</td>
                                        <td align="center">{{ $subjob['quantity'] }}</td>
                                        <td>{{ $subjob['delivery_date'] }}</td>
                                        <td>{{ $subjob['storage'] }}</td>
                                        <td align="center"><input type="checkbox" name="status" value="{{ $subjob['status'] }}" {{ $checksub }}  ></td>
                                    </tr>
                                    <tr style="height: 5"><td colspan="9"></td></tr>
                                @endforeach
                            @else
                                @if ($job['status'] == 1)
                                    <?php
                                    $bg= "#6887e3";
                                    $check = "checked";
                                    ?>
                                @else
                                    <?php
                                    $bg= "#717170";
                                    $check = "";
                                    ?>
                                @endif
                                <tr class="pt-1" style="height: 40px; font-size: 16px border-style:solid; color:#fff;  border-color: #fff;" bgcolor="#717170">
                                    <td width="5%" align="center"><input type="button" value="Add" name="addsub" id="add-sub" data-toggle="modal" data-target=".bd-example-modal-lg-sub">&nbsp;&nbsp; <input type="button" value="Edit" name="editmaster" id ="editmaster" data-toggle="modal" data-target=".bd-example-modal-lg-sub"> </td>
                                    <td align="center">{{ $job['order_number'] }}</td>
                                    <td>{{ $job['customer'] }}</td>
                                    <td>{{ $job['project_name'] }}</td>
                                    <td>{{ $job['supplier'] }}</td>
                                    <td align="center">{{ $job['quantity'] }}</td>
                                    <td>{{ $job['delivery_date'] }}</td>
                                    <td>{{ $job['storage'] }}</td>
                                    <td align="center"><input type="checkbox" name="status" value="{{$job['status']}}" {{ $check }}  ></td>
                                </tr>
                                    <tr style="height: 5"><td colspan="9"></td></tr>
                            @endif
                        @endforeach
                    @endif

                </table>
            </div>
            <div class="pt-4 ">{{$parentJobs->links()}}</div>
        </div>
    </div>


    <!----Modal Add Project----!>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content m-2 p-3">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Create Project</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('home') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type = "hidden" name ="cmd" value="add" />
                                        <input type = "hidden" name ="parent_id" value="0" />
                                        <div class="form-group row">
                                            <label for="order_number" class="col-md-4 col-form-label text-md-right">Auftragsnummer</label>

                                            <div class="col-md-6">
                                                <input id="order_number" type="text" class="form-control @error('order_number') is-invalid @enderror" name="order_number" value="" placeholder="Auftragsnummer" required autofocus>

                                                @error('order_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="customer" class="col-md-4 col-form-label text-md-right">Kunde</label>

                                            <div class="col-md-6">
                                                <input id="customer" type="text" class="form-control @error('customer') is-invalid @enderror" name="customer" value="" placeholder="Kunde" required autofocus>

                                                @error('customer')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="project_name" class="col-md-4 col-form-label text-md-right">Projektname</label>

                                            <div class="col-md-6">
                                                <input id="project_name" type="text" class="form-control @error('project_name') is-invalid @enderror" name="project_name" value="" placeholder="Projektname" required autofocus>

                                                @error('project_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="supplier" class="col-md-4 col-form-label text-md-right">Lieferant</label>
                                            <div class="col-md-6">
                                                <input id="supplier" type="text" class="form-control @error('supplier') is-invalid @enderror" name="supplier" value="" placeholder="Lieferant"  autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="quantity" class="col-md-4 col-form-label text-md-right">Auflage</label>
                                            <div class="col-md-6">
                                                <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="" placeholder="Auflage"  autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="delivery_date" class="col-md-4 col-form-label text-md-right">Liefertermin</label>
                                            <div class="col-md-6">
                                                <input id="datetimepicker" type="text" class="datetimepicker input-append date" name="delivery_date" value="" placeholder="Liefertermin"  autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="storage" class="col-md-4 col-form-label text-md-right">Lagerort</label>
                                            <div class="col-md-6">
                                                <select name="stogare">
                                                    <option value = 0> --- </option>
                                                    <option value =1>Fertigwarenregal</option>
                                                    <option value =2>Halbfertigregal</option>
                                                    <option value =3>Keller</option>
                                                    <option value =4>Quarantäne</option>
                                                    <option value =5>Serverraum</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="status" id="status" value="0">

                                                    <label class="form-check-label" for="status">
                                                        Angekommen
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---end of modal add->
@endsection
