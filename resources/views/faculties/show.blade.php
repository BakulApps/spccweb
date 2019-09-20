@extends('layouts.app', ['title' => 'Faculty'])

@section('styles')
<link href="{{ asset('vendor/footable/footable.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@push('js')
<script src="{{ asset('vendor/footable/footable.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.footable').footable();
  });
</script>
@endpush

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">

      <div class="row mt-5">
        <div class="col-12 col-xl-5 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        @if($user->gender == 'F')
                            <img alt="Image placeholder" src="https://res.cloudinary.com/spccweb/profile_pictures/default-female.png" class="rounded-circle">
                        @else
                            <img alt="Image placeholder" src="https://res.cloudinary.com/spccweb/profile_pictures/default-male.png" class="rounded-circle">
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body mt-8 pt-md-4">
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <h2>
                                {{ $user->getName() }}
                            </h2>
                            <div class="h4 font-weight-300">
                                Employee No. {{ $user->employee->employee_no }}
                            </div>
                            <div class="h4 font-weight-300 mt-3">
                                {{ $user->email }}
                            </div>
                            <div class="h5 font-weight-300">
                                {{ $degree }}
                            </div>
                        </div>

                        <hr class="my-4">

                        <dl class="row text-sm">
                          <dt class="col-5 text-right">
                              Username:
                          </dt>
                          <dd class="col-7">
                              {{ $user->username }}
                          </dd>

                          <dt class="col-5 text-right">
                              Status:
                          </dt>
                          <dd class="col-7">
                              {{ $user->employee->getStatus() }}
                          </dd>

                          <dt class="col-5 text-right">
                              Date Employed:
                          </dt>
                          <dd class="col-7">
                              {{ $user->employee->getDateEmployed() }}
                          </dd>

                          <h6 class="col-12 heading-small text-muted mt-3">
                              Personal Information
                          </h6>

                          @if($user->getGender() != null)
                          <dt class="col-5 text-right">
                              Gender:
                          </dt>
                          <dd class="col-7">
                              {{ $user->getGender() }}
                          </dd>
                          @endif

                          <dt class="col-5 text-right">
                              Birthdate:
                          </dt>
                          <dd class="col-7">
                              {{ $user->birthdate }}
                          </dd>

                          @if($user->contact_no != null)
                          <dt class="col-5 text-right">
                              Contact No:
                          </dt>
                          <dd class="col-7">
                              {{ $user->contact_no }}
                          </dd>
                          @endif

                          <dt class="col-5 text-right">
                              Address:
                          </dt>
                          <dd class="col-7">
                              {{ $user->address }}
                          </dd>
                        </dl>

                        @role('admin')
                        <div class="row">
                            <div class="col text-center">
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="javascript:history.back()">Return</button>

                                <a href="/faculties/{{ $user->id }}/edit" class="btn btn-outline-info btn-sm">
                                Edit Faculty
                                </a>

                                <form method="POST" action="{{ action('FacultyController@destroy', $user->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete Faculty</button>
                                </form>
                            </div>
                        </div>
                        @endrole
                    </div>
                </div>
            </div>

          </div>
        </div>

        <div class="col-12 col-xl-7 mb-5 mb-xl-0">
          <div class="card shadow">
          @if($totalClasses > 0)
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Schedule</h3>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                @if(count($m_class) > 0)
                <table class="table footable align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Monday</th>
                            <th></th>
                            <th data-breakpoints="all" class="bg-white">Credits:</th>
                            <th data-breakpoints="all" class="bg-white">Room:</th>
                            <th data-breakpoints="all" class="bg-white">Total Students:</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($m_class as $sclass)
                        <tr class="bg-white">
                            <td scope="row">{{ $sclass->getTime() }}</td>
                            <td>{{ $sclass->getCourse() }}</td>
                            <td>{{ $sclass->course->getCredits() }}</td>
                            <td>{{ $sclass->room }}</td>
                            <td>{{ $sclass->getTotalStudents() }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @endif

                @if(count($t_class) > 0)
                <table class="table footable align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Monday</th>
                            <th></th>
                            <th data-breakpoints="all" class="bg-white">Credits:</th>
                            <th data-breakpoints="all" class="bg-white">Room:</th>
                            <th data-breakpoints="all" class="bg-white">Total Students:</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($t_class as $sclass)
                        <tr class="bg-white">
                            <td scope="row">{{ $sclass->getTime() }}</td>
                            <td>{{ $sclass->getCourse() }}</td>
                            <td>{{ $sclass->course->getCredits() }}</td>
                            <td>{{ $sclass->room }}</td>
                            <td>{{ $sclass->getTotalStudents() }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @endif

                @if(count($w_class) > 0)
                <table class="table footable align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Monday</th>
                            <th></th>
                            <th data-breakpoints="all" class="bg-white">Credits:</th>
                            <th data-breakpoints="all" class="bg-white">Room:</th>
                            <th data-breakpoints="all" class="bg-white">Total Students:</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($w_class as $sclass)
                        <tr class="bg-white">
                            <td scope="row">{{ $sclass->getTime() }}</td>
                            <td>{{ $sclass->getCourse() }}</td>
                            <td>{{ $sclass->course->getCredits() }}</td>
                            <td>{{ $sclass->room }}</td>
                            <td>{{ $sclass->getTotalStudents() }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @endif

                @if(count($th_class) > 0)
                <table class="table footable align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Monday</th>
                            <th></th>
                            <th data-breakpoints="all" class="bg-white">Credits:</th>
                            <th data-breakpoints="all" class="bg-white">Room:</th>
                            <th data-breakpoints="all" class="bg-white">Total Students:</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($th_class as $sclass)
                        <tr class="bg-white">
                            <td scope="row">{{ $sclass->getTime() }}</td>
                            <td>{{ $sclass->getCourse() }}</td>
                            <td>{{ $sclass->course->getCredits() }}</td>
                            <td>{{ $sclass->room }}</td>
                            <td>{{ $sclass->getTotalStudents() }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @endif

                @if(count($f_class) > 0)
                <table class="table footable align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Monday</th>
                            <th></th>
                            <th data-breakpoints="all" class="bg-white">Credits:</th>
                            <th data-breakpoints="all" class="bg-white">Room:</th>
                            <th data-breakpoints="all" class="bg-white">Total Students:</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($f_class as $sclass)
                        <tr class="bg-white">
                            <td scope="row">{{ $sclass->getTime() }}</td>
                            <td>{{ $sclass->getCourse() }}</td>
                            <td>{{ $sclass->course->getCredits() }}</td>
                            <td>{{ $sclass->room }}</td>
                            <td>{{ $sclass->getTotalStudents() }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                @endif
            </div>

            @role('admin')
            <div class="card-footer text-center">
                <div class="row">
                    <div class="col">
                        <a href="/faculties/{{ $user->id }}/load" class="btn btn-outline-info btn-sm">
                        View Faculty Load
                        </a>
                    </div>
                </div>
            </div>
            @endrole
          @else
            <div class="row mt-3 mb-5">
                <div class="col text-center">
                    <p class="lead">No Faculty Load at the moment.</p>
                </div>
            </div>
          @endif
          </div>
        </div>
      </div>

      @include('layouts.footers.auth')
    </div>
@endsection