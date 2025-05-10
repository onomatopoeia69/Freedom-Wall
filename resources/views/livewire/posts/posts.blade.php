

<table class="table table-bordered mb-0">
    <thead class="table-light">
        <tr>
            <th class="text-start">Header</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    @forelse ($all_post as $posts)
        <tbody wire:key='key-{{$posts->id}}'>
            <tr>
                <td class="text-start">{{$posts->header}}</td>
                
                <td class="text-center">
                    
                    <button type="button" class="btn btn-danger btn-sm" wire:click="$dispatch('deleteOpt', { id: {{ $posts->id }}, name: '{{ $posts->header }}' })">
                        Delete
                    </button> 
                   
    
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editpost" wire:click="$dispatch('edit', { id: {{ $posts->id }} })">
                        Edit
                     </button>
                     
                        @include('livewire.posts.edit-post')
                     

                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#viewpost" wire:click="viewUserPosts({{$posts->id}})">
                        View
                    </button>

                    @include('livewire.posts.view')

                </td>
    
            </tr>
        </tbody>
    @empty
        <tr>
            <td colspan="2" class="text-center">empty</td>
        </tr>
    @endforelse
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