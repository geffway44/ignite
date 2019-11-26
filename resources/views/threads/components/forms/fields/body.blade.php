<div class="row mb-5">
    <div class="col">
        <textarea class="bg-white py-2 px-4 border-none outline-none focus:outline-none w-full mb-4 " name="body" id="body" placeholder="What is on your mind?" rows="7" required>{{ old('body') ?? ($thread->body ?? null) }}</textarea>

        <span class="text-xs text-gray-500">
            * You may use Markdown with <a class="text-indigo-500 hover:text-indigo-400" target="_blank" href="https://help.github.com/articles/creating-and-highlighting-code-blocks/">GitHub flavored</a> code blocks.
        </span>
    </div>
</div>
