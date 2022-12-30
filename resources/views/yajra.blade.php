<!DOCTYPE html>
<html>
<head>
    <title>Laravel DataTables ajax</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Laravel USER DataTables with Ajax</h1>
    <table class="table table-bordered data-table">
        <thead>
        <tr>
            <th>İD</th>
            <th>Name</th>
            <th>email</th></tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('usersFetch')}}',
        columns:[
            {data:'id' , name:'id'},
            {data:'name' , name:'name'},
            {data:'email' , name:'email'},
        ]
    });

</script>
</body>
</html>
