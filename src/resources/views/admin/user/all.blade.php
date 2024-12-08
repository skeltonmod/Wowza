<div class="row">
    <div class="col-12">
        <div class="col-lg-12">
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">All {{$title}}</h4>
                </div>

                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($users as $employee)
                                <tr>
                                    <td>{{ $employee['first_name'] }}</td>
                                    <td>{{ $employee['last_name'] }}</td>
                                    <td>{{ $employee['email'] }}</td>
                                    <td>{{ $employee['phone'] }}</td>
                                    <td>{{ $employee['address'] }}</td>
                                    <td>
                                        <a href="{{ route('employee.delete', ['id' => $employee['id']]) }}" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                            <i class="fa fa-trash-o" style="font-size:16px"></i>
                                        </a>
                                        <a href="{{ route('admin.user.edit', ['id' => $employee['id']]) }}" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Dishes</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
