<div>
    <br>
    <h2>Employers</h2>

    <a href="{{ route('create.employer') }}">Add an Employer</a>

    <table id="employersTable" class="display compact" style="width:100%">
        <thead>
            <tr>
                <th>Walter ID</th>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

@section('employerScripts')
<script defer>
    $(document).ready(function () {
        
        $('#employersTable').DataTable({
            processing: true,
            ajax: "{{ route('index.employers') }}",
            columns: [
                {data: 'walter_id', name: 'walter_id'},
                {data: 'name', name: 'name'},
                {data: 'company', name: 'company'},
                {data: 'email', name: 'email'},
                {
                    data: null, 
                    name: 'actions',
                    orderable: false,
                    render: function (data, type, row) {
                        return '<button class="btn btn-success btn-sm btn-block font-weight-bold email-employer" data-toggle="modal" data-target="#email-employer-modal" data-employer-id="'+data.id+'">Email <br>'+data.name+'</button>'
                        +`<a class="btn btn-info btn-sm btn-block edit-employer" href="/dashboard/employers/${data.id}/edit-employer">Edit ${data.name}</a>`;
                    }
                }
            ]
        });

        $('#email-employer-modal').on('show.bs.modal', function (event) {
            var modal = $(this);
            var empId = $(event.relatedTarget).data('employer-id');

            $.ajax({
                url: `dashboard/employers/${empId}`,
                async: true,
                success: function(response) {
                    modal.find('h5#email-employer-modal-title').text('Email ' + response.email);
                    
                    $("#emailPreviewButton").click(function() {
                        var action = `dashboard/previewEmailEmployer/${empId}`;
                        modal.find("#emailPreviewForm").attr('action', action);

                        var inputs = $("#candidatesTableModal tr.selected td input");
                        inputs.each(function() {
                            $(this).appendTo(modal.find("#emailPreviewForm"));
                        });

                        if (inputs.length > 0){
                            modal.find("#emailPreviewForm").submit();
                        }
                        else {
                            console.log("nothing selected");
                        }
                    });
                }
            });
            
            
        });
    });
</script>
@endsection