<table class="table table-bordered text-center mb-0">
    <thead class="table-light">
        <tr>
            <th>Header</th>
            <th>Action</th>
        </tr>
    </thead>
    @forelse ( $post as $posts)
    <tbody wire:key='key-{{$posts->id}}'>
        <tr>
            <td>{{$posts->header}}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" wire:click="$dispatch('deleteOpt', { id: {{ $posts->id }}, name: '{{ $posts->header }}' })">
                    Delete
                </button>

                <button type="button" class="btn btn-info btn-sm">
                    Edit
                </button>

                <button type="button" class="btn btn-success btn-sm">
                    View Post
                </button>

            </td>
        </tr>
        @empty

        <tr>
            <td colspan="3" class="text-center">empty</td>
        </tr>

        @endforelse
    </tbody>
</table>


@script
<script>

$wire.on('deleteOpt', (data) => {
	
     Swal.fire({
    title: "Are you sure, you want to delete '"+  `${data.name}` +"' ?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    cancelButtonColor: "#3085d6",
    confirmButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
    }).then((result) => {

    if (result.isConfirmed) {
        $wire.dispatch('confDelete', {id:data.id});
        Swal.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success"
        });
    }
    });

}); 

</script>
@endscript