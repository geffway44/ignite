<div class="row mb-5">
    <div class="col-md-8 mb-4">
        <input type="text" class="bg-white text-lg font-bold text-gray-900 py-2 px-4 outline-none focus:outline-none w-full" id="title" name="title" placeholder="Give your thread a title" value="{{ old('title') ?? ($thread->title ?? null) }}" required>
    </div>

    <div class="col-md-4 mb-4">
        <select class="block appearance-none bg-white py-2 px-4 outline-none focus:outline-none border border-gray-400 rounded-lg w-full pr-8 leading-tight" id="channel_id" name="channel_id" placeholder="Choose a channel..." required>
            @foreach ($channels as $channel)
                <option value="{{ $channel->id }}" @if (($thread->channel->id ?? null) == $channel->id) selected @endif>{{ $channel->name }}</option>
            @endforeach
        </select>

        <div class="pointer-events-none absolute inset-y-0 right-0 mr-4 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
    </div>

    <div class="col">
        <div class="border-b border-gray-400 h-2 bg-transparent"></div>
    </div>
</div>
