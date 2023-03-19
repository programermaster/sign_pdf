@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table id="pdfs" class="display">
                    <thead>
                    <tr>
                        <th>Original Pdf</th>
                        <th>Created Date</th>
                        <th>Download original pdf</th>
                        <th>Download signed pdf</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#pdfs').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route("list")}}',
                columns: [
                    {data: 'original_pdf', name: 'original_pdf'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'download_original_pdf', name: 'download_original_pdf', fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                       $(nTd).html("<a href='"+sData+"'>Download Original Pdf</a>");
                    }},
                    {data: 'download_signed_pdf', name: 'download_signed_pdf', fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                       $(nTd).html("<a href='"+sData+"'>Download Signed Pdf</a>");
                    }},
                ]
            });
        });
    </script>
@endsection
