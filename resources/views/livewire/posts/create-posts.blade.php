<div>
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createPost">
   Add Post
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="createPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$title}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='cancel'></button>
        </div>
        <div class="modal-body">
            <form wire:submit='savePost'>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label" >Header</label>
                <input type="text" class="form-control @error('header') is-invalid   @else  @if(!empty($header)) is-valid  @endif @enderror" placeholder="header" wire:model.live='header'>
                @error('header')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Write Something to say</label>
                <textarea class="form-control @error('post') is-invalid   @else  @if(!empty($post)) is-valid  @endif @enderror"" id="exampleFormControlTextarea1" rows="3" placeholder="write something..." wire:model.live='post'></textarea>
                @error('post')
                <span class="text-danger">{{ $message }}</span>
            @enderror
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click='cancel'>Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>