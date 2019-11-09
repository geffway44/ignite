<section class="py-12">
    <div class="mb-4">
        <h2 class="text-2xl text-gray-800 font-bold m-0">General Links</h2>

        <span class="text-gray-500">
            To make it easy for you to navigate around the site.
        </span>
    </div>

    <ul class="unstyled">
        <li class="block py-3">
            <a href="/threads" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                All threads
            </a>
        </li>

        <li class="block py-3">
            <a href="/threads?popular=1" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                Popular threads
            </a>
        </li>

        <li class="block py-3">
            <a href="/threads?unsolved=1" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                Unsolved threads
            </a>
        </li>

        <li class="block py-3">
            <a href="/threads?solved=1" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                Solved threads
            </a>
        </li>

        <li class="block py-3">
            <a href="/threads?by={{ auth()->user()->username }}" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                My threads
            </a>
        </li>
    </ul>
</section>
