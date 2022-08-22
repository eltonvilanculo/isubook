@extends('layouts.app', ['page' => 'Sistema Acervo Académico Brazão Mazula', 'pageSlug' => 'centrals', 'section' => 'logistic'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Gestão de centrais</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('centrals.create') }}" class="btn btn-sm btn-primary">Nova centrais</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Nome</th>
                                <th scope="col">Província</th>
                                <th scope="col">Região</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Email</th>

                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($centrals as $central)
                                    <tr>
                                        <td>{{ $central->name }}</td>

                                        <td>{{ $central->province->name}}</td>
                                        <td>{{ $central->province->region }}</td>
                                        <td>{{  $central->phone }}</td>
                                        <td>{{  $central->email }}</td>

                                        <td class="td-actions text-right">
                                            {{-- <a href="{{ route('centrals.show', $central) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Mais detalhed">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a> --}}
                                            <a href="{{ route('centrals.edit', $central) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Category">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('centrals.destroy', $central) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Category" onclick="confirm('Are you sure you want to delete this category? All products belonging to it will be deleted and the records that contain it will not be accurate.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                 </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $centrals->links() }}
                    </nav>


                </div>


            </div>
            <div class="map" id="map" > </div>

        </div>
    </div>
@endsection


@push('js')
<script>

    var centrals = {!! json_encode($centrals) !!}

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat:-25.953724, lng:  32.588711},
        zoom: 6,
        mapId: '7d0e2d497b4e14b4'
      });

      centrals.data.map((item)=>{
          console.log(item)
        new google.maps.Marker({
            position:{lat:Number(item.province.lat), lng:Number(item.province.lng)},
            map,
            title:item.name
        })
      })
</script>



@endpush



