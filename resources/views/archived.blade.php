@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <table class="col-12">
                    <tr class="header" style="border-style:solid; border-color: #fff; height: 70px; background-color: #304b9b; color: #b4b3b3; font-size: 16px">

                        <th width="5%" align="center">&nbsp;&nbsp;Auftragsnummer</th>
                        <th width="10%" align="center">&nbsp;&nbsp;Kunde</th>
                        <th width="15%" align="center">Projektname</th>
                        <th width="7%" align="center">Lieferant</th>
                        <th width="5%" align="center">Auflage</th>
                        <th width="7%" align="center">Liefertermin</th>
                        <th width="10%" align="center">Lagerort</th>
                        <th width="5%" align="center">Angekommen</th>
                    </tr>
                    @if( !empty($archived))

                        @foreach($archived  as $archive)
                            @if($archive['parent_id']==0 && !empty($archive['subjob'][0]) )
                                <tr class="pt-1" style="color:#fff; background-color: #717170; height: 30px; border-style:solid; border-color: #fff;" >
                                    <td align="center">{{ $archive['order_number'] }}</td>
                                    <td>{{ $archive['customer'] }}</td>
                                    <td>{{ $archive['project_name'] }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="center"><input type="checkbox" name="status" value="1" checked disabled ></td>
                                </tr>
                                @foreach($archive['subjob'] as $subjob)
                                 <tr class="pt-1" style="color:#1d1d1b; background-color: #c7c7c6; height: 30px; font-size: 16px border-style:solid; border-color: #fff;" >
                                        <td align="center" bgcolor="#fff">&nbsp;</td>
                                        <td bgcolor="#fff">&nbsp;</td>
                                        <td>&nbsp;&nbsp;{{ $subjob['project_name'] }}</td>
                                        <td>{{ $subjob['supplier'] }}</td>
                                        <td align="center">{{ $subjob['quantity'] }}</td>
                                        <td>{{ $subjob['delivery_date'] }}</td>
                                        <td>{{ $subjob['storage'] }}</td>
                                        <td align="center"><input type="checkbox" name="status" value="1" checked disabled ></td>
                                 </tr>
                                    <tr style="height: 5"><td colspan="8"></td></tr>
                                @endforeach
                            @else
                                <tr class="pt-1" style="height: 30px; font-size: 16px border-style:solid; color:#fff;  border-color: #fff;" bgcolor="#717170">
                                    <td align="center">{{ $archive['order_number'] }}</td>
                                    <td>{{ $archive['customer'] }}</td>
                                    <td>{{ $archive['project_name'] }}</td>
                                    <td>{{ $archive['supplier'] }}</td>
                                    <td align="center">{{ $archive['quantity'] }}</td>
                                    <td>{{ $archive['delivery_date'] }}</td>
                                    <td>{{ $archive['storage'] }}</td>
                                    <td align="center"><input type="checkbox" name="status" value="1" checked disabled ></td>
                                </tr>
                            @endif
                        @endforeach
                    @endif

                </table>
            </div>
            <div class="pt-4 ">{{parentJobs->links()}}</div>
        </div>
    </div>
@endsection
