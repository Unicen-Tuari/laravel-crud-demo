<x-tasks>

  <!--
    Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
    Read the documentation to get started: https://tailwindui.com/documentation
  -->
  <div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Tarea {{ $task->id }}
      </h3>
      <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">

      </p>
    </div>
    <div>
      <dl>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Título
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $task->name }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Descripción
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $task->description }}
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Usuario asignado
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $task->assignee->name }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Creador
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $task->author->name }}
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Fecha
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $task->created_at }}
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Estado
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            @if($task->done) Resuelta @else Pendiente @endif
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
              Attachment
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
              <ul class="border border-gray-200 rounded-md">
                  <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                      @if($task->file_is_image)
                          <img src="{{ $task->public_file_path }}" alt="">
                      @else

                          <div class="w-0 flex-1 flex items-center">
                              <!-- Heroicon name: paper-clip -->
                              <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                              </svg>
                              <span class="ml-2 flex-1 w-0 truncate">
                            {{ basename($task->public_file_path) }}
                            </span>
                          </div>
                          <div class="ml-4 flex-shrink-0">
                              <a href="{{ $task->public_file_path }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                                  Download
                              </a>
                          </div>
                      @endif
                  </li>
              </ul>
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            <a href="{{ route('tasks.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
              Volver
            </a>
          </dt>
        </div>
      </dl>
    </div>
  </div>


</x-tasks>
