@extends('layout.userInterface')
     @section('resource')
            <div class="row gx-3">
               <div class="col-md-12 my-2">
                    <h4 class="text-center">My adverts</h4>
                    
               </div>
               
               @isset($ads)
                   @foreach ($ads as $ad)
                    <div class="col-md-3">
                         <div class=" m-2 ad">
                              <div><img src="/storage/{{$ad->filename}}" alt="" class="img-fluid"></div>
                              <div class="p-2">
                                   <p class="my-1"><b>&#8358; {{number_format($ad->price, 2, '.',',')}}</b></p>
                                   <p class="my-1" style="font-size: large">{{$ad->title}}</p>
                                   <p  class="text-muted" style="font-size: small">{{substr($ad->description,0,100)}}</p>
                                   <p style="font-size: x-small" class="text-muted mb-0"><i class="fa-solid fa-location-dot"></i> {{$ad->lga->name.', '.$ad->lga->state->name}}</p>
                                   {{-- <p role="button" data-bs-toggle="dropdown" aria-expanded="false" class="text-end my-0 pt-0 pe-1 dropdown-toggle"><i class="fa-solid fa-ellipsis-vertical" style="font-size: 1.2em"></i></p> --}}
                                   <div class="dropdown dropleft">
                                        <p role="button" data-bs-toggle="dropdown" aria-expanded="false" class="text-end my-0 pt-0 pe-1"><i class="fa-solid fa-ellipsis-vertical" style="font-size: 1.2em"></i></p>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="/famarket/p_addpics/{{$ad->id}}">Add pictures</a></li>
                                          <li><a class="dropdown-item" href="{{route('editad',$ad->id)}}">Edit</a></li>
                                          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</a></li>
                                        </ul>
                                      </div>
                                      <p style="font-size: small" class="text-muted mb-0">{{$ad->status}}</p>
                              </div>
                         </div>
                    </div>
                         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                              <div class="modal-content">
                              <div class="modal-header">
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <p style="font-size: large" class="text-center">Are sure you want to delete ad ?</p>
                              </div>
                              <div class="modal-footer">
                                   <form action="{{route('myads.destroy')}}" method="POST">
                                        @csrf
                                   <input type="hidden" value="{{$ad->id}}" name="delid">
                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                   <button type="submit" class="btn btn-primary">Yes</button>
                               </form>
                              </div>
                              </div>
                              </div>
                         </div>
                   @endforeach
               @endisset
               
               @isset($eqads)
               @foreach ($eqads as $ad)
                <div class="col-md-3">
                     <div class=" m-2 ad">
                          <div><img src="/storage/{{$ad->filename}}" alt="" class="img-fluid"></div>
                          <div class="p-2">
                               <p class="my-1"><b>&#8358; {{number_format($ad->price, 2, '.',',')}}</b></p>
                               <p class="my-1" style="font-size: large">{{$ad->title}}</p>
                               <p  class="text-muted" style="font-size: small">{{substr($ad->description,0,100)}}</p>
                               <p style="font-size: x-small" class="text-muted mb-0"><i class="fa-solid fa-location-dot"></i> {{$ad->lga->name.', '.$ad->lga->state->name}}</p>
                               {{-- <p role="button" data-bs-toggle="dropdown" aria-expanded="false" class="text-end my-0 pt-0 pe-1 dropdown-toggle"><i class="fa-solid fa-ellipsis-vertical" style="font-size: 1.2em"></i></p> --}}
                               <div class="dropdown dropleft">
                                    <p role="button" data-bs-toggle="dropdown" aria-expanded="false" class="text-end my-0 pt-0 pe-1"><i class="fa-solid fa-ellipsis-vertical" style="font-size: 1.2em"></i></p>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="/famarket/e_addpics/{{$ad->id}}">Add pictures</a></li>
                                      <li><a class="dropdown-item" href="{{route('editeq.show',$ad->id)}}">Edit</a></li>
                                      <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</a></li>
                                    </ul>
                                  </div>
                                  <p style="font-size: small" class="text-muted mb-0">{{$ad->status}}</p>
                          </div>
                     </div>
                </div>
                     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                          <div class="modal-content">
                          <div class="modal-header">
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <p style="font-size: large" class="text-center">Are sure you want to delete ad ?</p>
                          </div>
                          <div class="modal-footer">
                               <form action="{{route('myads.destroy')}}" method="POST">
                                    @csrf
                                   <input type="hidden" name="check" value="{{$ad->condition}}">
                               <input type="hidden" value="{{$ad->id}}" name="delid">
                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                               <button type="submit" class="btn btn-primary">Yes</button>
                           </form>
                          </div>
                          </div>
                          </div>
                     </div>
               @endforeach
           @endisset
            </div>
     @endsection