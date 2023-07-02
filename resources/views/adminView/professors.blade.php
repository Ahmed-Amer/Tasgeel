@extends('layouts.adminLayout')

@section('page title')
Professors
@endsection

@section('content')

<div class="row">
    <div class="col-md-10 mx-auto mt-2">
        {{-- messages --}}
        @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif

        @if (session('delete'))
        <div class="alert alert-danger">{{session('delete')}}</div>
        @endif
    </div>
</div>

<div class="col-sm-7 mt-2">
    <a href="/admin/add-professor" class="btn btn-primary btn-md">Add Professor</a>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                        <button onclick="downloadTableAsPdf()" class="btn btn-sm btn-outline-secondary ml-3">Export
                            PDF</button>
                    </div>

                    <div class="card-body">
                        <table id="bootstrap-data-table-export-prof" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Phone number</th>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $c = 1;
                                    ?>
                                @foreach ($professors as $prof)
                                <tr>
                                    <td>{{ $c++ }}</td>
                                    <td>Dr.{{ $prof->first_name }} {{ $prof->last_name }}</td>
                                    <td>{{ $prof->email }}</td>
                                    <td>{{ $prof->username }}</td>
                                    <td>{{ $prof->phone_number }}</td>

                                    <td>
                                        <a class="btn btn-info btn-sm"
                                            href="/admin/professor/{{ $prof->id }}/edit">Edit</a> |

                                        <a onclick="return confirm('Are you sure to delete Dr.{{ $prof->first_name }}  {{ $prof->last_name }}')"
                                            class="btn btn-danger btn-sm"
                                            href="/admin/delete-professor/{{ $prof->id }}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    function downloadTableAsPdf() {
            // Retrieve the table element
            var originalTable = document.getElementById("bootstrap-data-table-export-prof");

            // Clone the table element
            var clonedTable = originalTable.cloneNode(true);

            // Exclude the last column in the cloned table
            var lastColumnIndex = clonedTable.rows[0].cells.length - 1;
            for (var i = 0; i < clonedTable.rows.length; i++) {
                clonedTable.rows[i].deleteCell(lastColumnIndex);
            }

            // Create configuration options for html2pdf
            var options = {
                filename: 'all-professors.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            // Use html2pdf to generate the PDF from the modified cloned table
            html2pdf().from(clonedTable).set(options).save();
        }
</script>