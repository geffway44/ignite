<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('threads.update', ['channel' => $thread->channel->slug, 'thread' => $thread->slug]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    @include('threads.components.forms.fields.title', ['channels' => $channels, 'thread' => $thread])

                    @include('threads.components.forms.fields.body', ['thread' => $thread])

                    <div class="row">
                        <div class="col flex items-center justify-between">
                            <div class="flex items-center">
                                <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">Update Thread</button>
                            </div>

                            <button type="button" class="whitespace-no-wrap text-indigo-500 hover:text-indigo-400" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
